<?php


	//
	//
	require_once ( 'Init.Core.php' );
	require_once ( 'Init.Directory.php' );
	require_once ( 'Init.Config.php' );
	require_once ( 'Init.DoulCi.php' );
	require_once ( 'Init.Apple.php' );
	require_once ( 'Init.Agent.php' );
	require_once ( 'Init.Meta.php' );


	//
	//
	require_once ( INIT . 'Functions' . DS . 'Functions.php' );
	require_once ( INIT . 'Functions' . DS . 'Curl.php' );
	require_once ( INIT . 'Functions' . DS . 'File.php' );
	require_once ( INIT . 'Functions' . DS . 'Plist.php' );
	require_once ( INIT . 'Functions' . DS . 'AccountToken.php' );
	require_once ( INIT . 'Functions' . DS . 'Signature.php' );
	require_once ( INIT . 'Functions' . DS . 'IP.php' );
	require_once ( INIT . 'Functions' . DS . 'Utils.php' );


	//
	//
	require_once ( INIT . 'Classes' . DS . 'PlistParser.php' );
	require_once ( INIT . 'Classes' . DS . 'ShowMsg.php' );

	//
	//
	$PParser = new PlistParser ( );
	$Msg =  new ShowMsg();


	?>