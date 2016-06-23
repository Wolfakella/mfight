<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use App\Duel;
use App\User;
use App\Custom\Rating;

class Build extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuilds the users rating in the system.';

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
        DB::table('users')->update(['rating' => 1600]);
        $duels = Duel::all();
        foreach($duels as $duel)
        {
        	$duel->rating1 = $duel->player1->rating;
        	$duel->rating2 = $duel->player2->rating;
        	if($duel->result1 > $duel->result2)
        	{
        		$duel->player1->rating = Rating::getWinRating($duel->rating1, $duel->rating2);
        		$duel->player2->rating = Rating::getLoseRating($duel->rating1, $duel->rating2);
        	}
        	else
        	{
        		$duel->player1->rating = Rating::getLoseRating($duel->rating2, $duel->rating1);
        		$duel->player2->rating = Rating::getWinRating($duel->rating2, $duel->rating1);
        	}
        	$duel->player1->save();
        	$duel->player2->save();
        	$duel->save();
        }
    }
}
