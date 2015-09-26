<?php


	//
	//
	session_start();


	//
	//
	require_once ( '../Init/Init.php' );



	//
	//
	if ( $_SERVER [ 'REQUEST_METHOD' ] == "POST" ) {





	} else {


		// Setting the Default Header Type.
		//
		header ( CONTENT_TEXT );
		header ( "HTTP/1.1 404 Not Found" );
		echo "File Not Found";
		die ( );

	}


	//
	//
	ob_end_flush ( );


	?>