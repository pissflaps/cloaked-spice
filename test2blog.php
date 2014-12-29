<?php
// index.php

// load and initialize any global libraries
require_once 'model.php';
require_once 'controller.php';

// route the request internally
$uri = $_SERVER['REQUEST_URI'];
	if( $uri == '/index.php') {
		list_action();
	} elseif ($uri == '/index.php/show' && isset($GET['id'])) {
		show_action($GET['id']);
	} else {
		header('STATUS: 404 Not Found');
			echo '<HTML><body><h1>Page Not Found</h1></body></html>';
	}
	
/* CONTROLLERS .PHP	*/

	function list_action()
	{	
		$posts = get_all_posts();
		require 'templates/list.php';
	}
	
	function show_action()
	{
		$post = get_post_by_id($id);
		require 'templates/show.php';
	}