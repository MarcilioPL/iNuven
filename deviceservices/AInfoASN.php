<?php


	//
	//
	if ( isset ( $_POST [ 'activation-info' ] ) ) {

		$DeviceARecv = array_key_exists('activation-info', $_POST) ? $_POST['activation-info'] : $_POST [ 'activation-info' ];
	}


	//
	//
	if( !$DeviceARecv ) {

		header ( CONTENT_TEXT );
		header ( "HTTP/1.1 404 Not Found" );
		echo "File Not Found";
		die ( );
	}


	//
	//
	$Msg->Info( "iTunes Post = Belllow iOS 8.0", "deviceActivation" );



	//
	//










	?>