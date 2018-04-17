<?php

class RoutesCollection{

	public $routes;

	public function __construct(){

		$this->routes= [];

	}

	public function add($nombre ,Route $route){

		$this->routes[$nombre]= $route;

	}

}

class Route{

	public $nombre;
	public $uri;
	public $controlador;

	public function __construct($uri, $controlador){

		$this->uri= $uri;
		$this->controlador= $controlador;

		if($this->uri != '/'){

			$this->uri= '/'. $this->uri;
			$this->uri= str_replace('//', '/', $this->uri);

		}

	}

}

class controlador1{

	public function saludo($nombre, $horario){

		printf("Hola %s Feliz %s", $nombre, $horario);

	}

}

class controlador2{

	public function despedida($nombre, $horario){

		printf("Adios %s Feiz %s", $nombre, $horario);

	}

}

function emparejar($routeRequest, $routesCollection){

	foreach($routesCollection->routes as $routeCollection){

		if($routeCollection->uri == $routeRequest){

			$controlador= explode('@', $routeCollection->controlador);
			
			call_user_func_array([$controlador[0], $controlador[1]], ['Anthony', 'Dia']);

		}

	}

}

$uri= $_SERVER['REQUEST_URI'];
$method= $_SERVER['REQUEST_METHOD'];
$root= dirname($_SERVER['PHP_SELF']);
$routeRequest= str_replace($root, '', $uri);

$routesCollection= new RoutesCollection();
$routesCollection->add('nuevaRuta', new Route('/ruta1', 'controlador1@saludo'));
$routesCollection->add('nuevaRuta2', new Route('/ruta2', 'controlador2@despedida'));

emparejar($routeRequest, $routesCollection);