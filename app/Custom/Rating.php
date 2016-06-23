<?php 
namespace App\Custom;

class Rating {
	public static function getWinRating($winRating, $loseRating)
	{
		$dr = $winRating - $loseRating;
		$We = 1 / (pow(10, -$dr / 400) + 1);
		$delta = 100 * (1 - $We);
		return $winRating + $delta;
	}
	
	public static function getLoseRating($winRating, $loseRating)
	{
		$dr = $loseRating - $winRating;
		$We = 1 / (pow(10, -$dr / 400) + 1);
		$delta = 100 * (0 - $We);
		return $loseRating + $delta;
	}
}
