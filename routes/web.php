<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Deploy test 15-08-2026";
});
Route::get('/health', function () {
	    return response()->json([
			'status' => 'ok',
			'app' => 'laravel-devops-lab'

]);

});
