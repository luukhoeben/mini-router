<?php

class Router 
{

	protected $routes = [
		'GET' => [],
		'POST' => []
	];

	public static function load($file) {
		$route = new static;

		require $file;

		return $route;
	}

	public function direct($uri, $requestType) {
		if( ! array_key_exists($uri, $this->routes[$requestType]) ) {
			throw new Exception("No route defined for this URI", 1);
		}

		return $this->callAction(
			...explode('@', $this->routes[$requestType][$uri])
		);
	}

	public function get($uri, $controller) {
		$this->routes['GET'][$uri] = $controller;
	}

	public function post($uri, $controller) {
		$this->routes['POST'][$uri] = $controller;
	}

	public function controller($uri, $controller) {
		$controller_instance = new $controller;

		$methods = get_class_methods($controller_instance);

		$this->parseControllerRoutes($uri, $controller, $methods);
	}

	protected function callAction($controller, $action) {
		$controller = new $controller;

		if( ! method_exists($controller, $action) ) {
			throw new Exception("{$controller} did not respond to the {$action} action.", 1);
		}

		return $controller->$action();
	}

	protected function parseControllerRoutes($uri, $controller, $methods) {
		foreach( $methods as $method ) {
			$parts = preg_split('/(?=[A-Z])/', $method);

			$part_uri = $this->parseControllerUri($uri, $parts);

			$this->routes[strtoupper($parts[0])][$part_uri] = $controller . '@' . $method;
		}
	}

	protected function parseControllerUri($uri, $parts) {
		$parts[1] = ($parts[1] == 'Index') ? '' : $parts[1];

		if( $uri != '' ) {
			return trim($uri .'/'. strtolower($parts[1]), '/');
		}

		return trim(strtolower($parts[1]), '/');
	}

}