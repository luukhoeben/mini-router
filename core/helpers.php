<?php

function view($file, $data = [])
{
	extract($data);
	return require( baseDir("views/{$file}.view.php") );
}

function redirect($path)
{
	header("Location: /{$path}");
}

function baseDir($path = NULL)
{
	if( $path != NULL ) {
		return dirname(__DIR__) . "/{$path}";
	}
	return dirname(__DIR__);
}