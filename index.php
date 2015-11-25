<?php

$parsedUrl = parse_url($_SERVER["REQUEST_URI"]);

$paths   = explode('/', $parsedUrl['path']);
$queries = array();

if (isset($parsedUrl['query']))
	parse_str($parsedUrl['query'], $queries);

array_shift($paths);

$whitelist = array('', 'admin', 'vote', 'votes');


switch ($paths[0]) {
	case '':
		$incl = 'home';
		break;
	case 'vote':
	case 'votes':
		$incl = 'voter';
		break;

	case 'admin':
		$incl = 'admin';
		break;

	default: 
		$incl = 'home';
		break;
}

include($incl . '.php');