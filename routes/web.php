<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


Route::get('/', function () {
    return "Deploy test 15-08-2026";
});


Route::get('/health', function () {

	   $database = true;
	   $redis = true;

	   try {
		DB::connection()->getPdo();
		} catch (\Throwable $e) {
		      $redis = false;
		}

	   try {
		Redis::ping();
		} catch (\Throwable $e){
			$redis = false;}


	   $healthy = $database && $redis;

	    return response()->json([

		    'status' => $healthy ? 'ok' : 'unhealthy',
		    'database' => $database,
		    'redis' => $redis
	    ], $healthy ? 200 : 503);
});

