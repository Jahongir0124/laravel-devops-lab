<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


Route::get('/', function () {
    return "Deploy test 15-08-2026";
});
Route::get('/health', function () {

	$database = 'ok';
	$redis = 'ok';

	try {

	     DB::connection()->getPdo();
	     } catch (\Throwable $e) {
		$database = 'failed';}

        try {
	     Redis::ping();
	    } catch(\Throwable $e) {
		$redis = 'failed';}


	$healthy = $database === 'ok' && $redis === 'ok';


	return response()->json(
		[
		  'status' => $healthy ? 'ok' : 'unhealthy',
		  'app' => 'laravel-devops-lab',
		  'database' => $database',
		  'redis' => $redis
			],$healthy ? 200 : 503);

});


});
