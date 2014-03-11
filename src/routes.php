<?php

if ($route_path = Storage::config('route_path')) {
	// Register storage route.
	\Route::get($route_path.'{path}', function ($path) {
		try {
			$file = Storage::get($path);
		} catch (\Exception $e) {
			\App::abort(404, 'File not found');
		}
		
		$type = Storage::type($path);
		
		$response = \Response::make($file, 200, array(
			'Content-Type' => $type,
		));
		
		return $response;
	});
}