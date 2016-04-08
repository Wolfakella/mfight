<?php

namespace App\Jobs;

use App\Jobs\Job;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Situation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetSituationsJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $year;
    protected $competition;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($year, $competition)
    {
        $this->year = $year;
        $this->competition = $competition;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	$data = array();
    	$matches = array();
    	$client = new Client();
    	 
    	$response = $client->request(
    			'GET',
    			$this->competition
    			);
    	//$text = iconv('cp1251', 'utf-8', $response->getBody());
    	$text = $response->getBody();
    	 
    	$pattern = "@<h2><a name=\"\d+\"></a>\d+\.&nbsp;(.*)</h2>@U";
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match)
    	{
    		$data[$i]['title'] = iconv('cp1251', 'utf-8', $match);
    		$data[$i]['link'] = "http://www.poedinki.ru/competitions/".$this->year."/".$this->competition."/situations/#".($i+1);
    		//$data[$i]['created_at'] = Carbon::create($year, null, null, null, null, null);
    		$i++;
    	}
    	 
    	$pattern = "^class=\"Situation\">(.*)</div>^Us";
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match) $data[$i++]['body'] = iconv('cp1251', 'utf-8', $match);
    	 
    	foreach($data as $record)
    	{
			$situation = Situation::firstOrCreate(['title' => $record['title']]);
			$situation->body = $record['body'];
			$situation->link = $record['link'];
    		$time = Carbon::create($this->year, null, null, null, null, null);
    		if($situation->created_at > $time) $situation->created_at = $time;
    		$situation->save();
    	}        
    }
}
