<?php

require('../core/helpers.php');
require('../controllers/PagesController.php');
require('../core/Router.php');

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$requestType = $_SERVER['REQUEST_METHOD'];

Router::load( baseDir('routes.php') )->direct($uri, $requestType);