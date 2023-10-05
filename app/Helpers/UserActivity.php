<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Request;

/**
 * UserActivity
 * 
 * Track the user certain activities in this project
 */

class UserActivity
{
	/**
	 * addToLog
	 * 
	 * Call this method when the users are doing:
	 * - User (store, delete)
	 * - Criteria (store, update, delete)
	 * - Criminal Perpetrator (store, update, delete)
	 * - Evidence (store, update, delete, show)
	 * - Evidence Photo (store, delete)
	 * - Evidence Transaction (store)
	 */

	public static function addToLog($activity)
	{
		$log = [];
		$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
		$log['activity'] = $activity;
		$log['user_agent'] = Request::header('user-agent');
		$log['url'] = Request::fullUrl();

		ActivityLog::create($log);
	}
	
	public static function userActivityLists($userId)
	{
		return ActivityLog::where('user_id', $userId)->latest()->get();
	}
}
