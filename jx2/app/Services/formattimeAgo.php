<?php

namespace App\Services;
use Carbon\Carbon;

class formattimeAgo {
	/**
	     * @param time
	     * 
	     * @return string
	     */
	    
	public static function formatTimeAgo($time)
	{
		return Carbon::parse($time)->diffForHumans();
	}

}

?>






