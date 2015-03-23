<?php
    //TODO: make error reporting a configuration option
	error_reporting(E_ALL);
	ini_set('display_errors',1);

	$BASE_DIR = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');

	require_once( $BASE_DIR . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'config.class.php' );
	ConfigLib::parse( $BASE_DIR . DIRECTORY_SEPARATOR . 'config.ini');

	KernelLib::start();