<?php

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\Routing\Collection;

App::router()->serve('http://localhost:{port}', static function (Collection $routes) {
	$routes->namespace('App\Controllers', [
		$routes->get('/', 'Home::index', 'home'),
	]);
});

App::router()->setDefaultRouteNotFound(static function (
	array $params,
	Request $request,
	Response $response
) {
	$response->setStatusLine(404);
	if ($request->isJSON()) {
		return $response->setJSON([
			'error' => [
				'code' => 404,
				'reason' => 'Not Found',
			],
		]);
	}
	return $response->setBody('<h1>Error 404</h1><p>Page not found</p>');
});