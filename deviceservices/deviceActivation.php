<?php


	//
	//
	session_start();


	//
	//
	require_once ( '../Init/Init.php' );


	// Enable Scam Filter Support
	//
	if ( $Init_Scamming_Filter == true ) {

	}


	// Enable Maintenance Support
	//
	if ( $iNuven_Maintenance == true ) {

	}


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


	//
	//


	?>