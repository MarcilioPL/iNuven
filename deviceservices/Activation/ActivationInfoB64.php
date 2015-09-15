<?php


	//
	//
	if ( isset ( $_POST [ 'activation-info-base64' ] ) ) {

		$DeviceARecv = base64_decode( $_POST['activation-info-base64'] );
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
	$Msg->Info( "iTunes Post = doulCi Hack", "deviceActivation" );



	//
	//


	?>