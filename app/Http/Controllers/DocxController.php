<?php

namespace App\Http\Controllers;

use Cookie;
use Storage;
use ZipArchive;
use App\Situation;

class DocxController extends Controller
{
	/* creates a compressed zip file */
	private function create_zip($files = array(),$destination = '',$overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }
		//vars
		$valid_files = array();
		//if files were passed in...
		
		if(is_array($files)) {
			//cycle through each file
			foreach($files as $file) {
				//make sure the file exists
				$file = storage_path().'/'.$file;
				if(file_exists($file)) {
					$valid_files[] = $file;					
				}
			}
		}
		//if we have good files...
		if(count($valid_files)) {
			//create the archive
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			//add the files
			foreach($valid_files as $file) {
				$localname = str_replace(storage_path('situations').'/', "", $file);
				//dd( $localname );
				$zip->addFile($file,$localname);
			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
	
			//close the zip -- done!
			$zip->close();
	
			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}
    public function anyIndex()
    {
    	if(Cookie::has('cart'))
    	{
    		$IDs = Cookie::get('cart');
    		$situations = Situation::whereIn('id', $IDs)->get();
    		
	    	Storage::disk('local')->deleteDirectory('situations');
	    	$command = 'cp -r '.base_path('resources/docx/template'). ' '.storage_path('situations'); 
			exec( $command );
			
			$document = Storage::disk('base')->get('resources/docx/parts/document.part');
			$title = Storage::disk('base')->get('resources/docx/parts/title.part');
			$paragraph = Storage::disk('base')->get('resources/docx/parts/paragraph.part');
			$regular = Storage::disk('base')->get('resources/docx/parts/regular.part');
			$bold = Storage::disk('base')->get('resources/docx/parts/bold.part');
			$phrase = Storage::disk('base')->get('resources/docx/parts/phrase.part');
			$title2 = Storage::disk('base')->get('resources/docx/parts/title2.part');
			$role_paragraph = Storage::disk('base')->get('resources/docx/parts/role_paragraph.part');
			
			//dd( $situations );		
			$documentText = "";
			$count = 1;
			foreach($situations as $situation)
			{
				//Первым делом обрабатываем заголовок ситуации и добавляем его в документ
				$paragraphText = 'Ситуация №'.$count++.'. '.htmlspecialchars(html_entity_decode($situation->title), ENT_XML1);
				$documentText .= preg_replace('/%TEXT%/', $paragraphText, $title);
				
				//Далее сразу вырезаем и сохраняем заключительную фразу для экспресс-поединка
				if(!isset($situation->roles))
				{
					if(preg_match('%<br.*?>.*?<strong>(.*)</strong>.*%s', $str, $matches))
					{
						$end = htmlspecialchars(html_entity_decode($matches[1]), ENT_XML1);
						$str = preg_replace('%<br.*?>.*?<strong>(.*)</strong>.*%s', "", $str);
					}
				}
				
				//Начинаем обработку основного текста ситуации
				$str = $situation->body;
				
				$matches = array();
				
				//Находим все абзацы
				if(preg_match_all('%(<p.*?>(.*?)</p>)%s', $str, $matches))				
				{
					foreach($matches[2] as $match)
					{
						//В каждом абзаце ищем кусочки текста, состоящие из обычного текста
						//и идущего сразу за ним полужирного куска
						$results = array();
						$paragraphText = "";
						 
						while(preg_match('%(.*?)<strong.*?>(.*?)</strong>%s', $match, $results))
						{
							$paragraphText .= preg_replace('/%TEXT%/', htmlspecialchars(html_entity_decode($results[1]), ENT_XML1), $regular);
							$paragraphText .= preg_replace('/%TEXT%/', htmlspecialchars(html_entity_decode($results[2]), ENT_XML1), $bold);
							
							$match = preg_replace('%(.*?)<strong.*?>(.*?)</strong>%s', "", $match, 1);
						}
						//В конце обрабатываем оставшийся кусочек обычного текста, не содержащий выделений
						$paragraphText .= preg_replace('/%TEXT%/', htmlspecialchars(html_entity_decode($match), ENT_XML1), $regular);
						$documentText .= preg_replace('/%TEXT%/', $paragraphText, $paragraph);
					}
					//Если мы имеем дело с экспресс-поединком, то записываем заключительную фразу и завершаем итерацию
					if(!isset($situation->roles)) $documentText .= preg_replace('/%TEXT%/', $end, $phrase);
					else 
					{
						//Если у нас классические поединок, то добавляем заголовок "Роли и интересы"
						$documentText .= $title2;
						$str = $situation->roles;
						$matches = array();
						
						//Находим все абзацы с ролями и обрабатываем каждый из них
						while(preg_match('%<p.*?><em.*?>(.*?)</em>(.*?)</p>%s', $str, $matches))
						{
							$paragraphText = "";
							$paragraphText .= preg_replace('/%TEXT%/', htmlspecialchars(html_entity_decode($matches[1]), ENT_XML1), $bold);
							$paragraphText .= preg_replace('/%TEXT%/', htmlspecialchars(html_entity_decode($matches[2]), ENT_XML1), $regular);
							
							$str = preg_replace('%<p.*?><em.*?>(.*?)</em>(.*?)</p>%s', "", $str, 1);
							$documentText .= preg_replace('/%TEXT%/', $paragraphText, $paragraph);
						}
					}
				}
			}
		
			$output = preg_replace('/%TEXT%/', $documentText, $document);
			
			$res = Storage::disk('local')->put('situations/word/document.xml', $output);
			
			$files = Storage::disk('local')->allFiles('situations');
			
			$res = $this->create_zip($files, storage_path('situations.zip'), true);
			
			if(Storage::disk('local')->has('situations.docx'))
				Storage::disk('local')->delete('situations.docx');
			Storage::disk('local')->move('situations.zip', 'situations.docx');
			
	    	//return response()->download(storage_path('situations/word/document.xml'));
	    	return response()->download(storage_path('situations.docx'));
    	}
    }
}
