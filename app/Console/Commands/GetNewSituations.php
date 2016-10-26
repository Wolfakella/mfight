<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Situation;
use Carbon\Carbon;

class GetNewSituations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'situations:get {--year=} {--champ=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$data = array();
    	$matches = array();
    	$client = new Client();
    	
    	$competition = $this->option('champ');
    	$year = $this->option('year');
    	
    	$response = $client->request(
    			'GET',
    			"http://www.poedinki.ru/competitions/".$year."/".$competition."/situations/"
    			);
    	//$text = iconv('cp1251', 'utf-8', $response->getBody());
    	$text = $response->getBody();
    	//echo $text;
    	
    	$pattern = "@<h2><a name=\"\d+\"></a>\d+\.&nbsp;(.*)</h2>@U";
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match)
    	{
    		//$data[$i]['title'] = iconv('cp1251', 'utf-8', $match);
    		$data[$i]['title'] = $match;
    		$data[$i]['link'] = "http://www.poedinki.ru/competitions/".$year."/".$competition."/situations/#".($i+1);
    		//$data[$i]['created_at'] = Carbon::create($year, null, null, null, null, null);
    		$i++;
    	}
    	
    	$pattern = "^class=\"Situation\">(.*)(<h3>.*</h3><dl class=\"Roles\">(.*)</dl>)?</div>^Us";
    	//preg_match($pattern, $text, $matches);
    	//print_r($matches);
    	
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match) $data[$i++]['body'] = $match;//iconv('cp1251', 'utf-8', $match);
    	
    	$i = 0;
    	foreach($matches[3] as $match) $data[$i++]['roles'] = $match;//iconv('cp1251', 'utf-8', $match);
    	   
    	foreach($data as $record)
    	{
    		$situation = new Situation();
    		//$situation = Situation::create(['title' => $record['title']]);
    		$situation->title = $record['title'];
    		$situation->body = $record['body'];
    		$situation->roles = ($record['roles'] != "" ? $record['roles'] : NULL);
    		$situation->link = $record['link'];
    		$time = Carbon::create($year, null, null, null, null, null);
    		if($situation->created_at > $time) $situation->created_at = $time;
    		
    		if(Situation::where('title', 'LIKE', '%'.$record['title'].'%')->exists()) echo "Situation exists: ".$record['title'].PHP_EOL;
    		else {
    			$situation->save();
    			echo "Situation saved: ".$record['title'].PHP_EOL;
    		}
    	}
    	
    }
}
