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


				$Msg->Info( "Set the correct User-Agent", "CertifyMe" );
	// Enable Maintenance Support
	//
	if ( $Init_Maintenance == true ) {

		//
		require_once ( DEVICE_SERVICES . 'deviceMaintenance.php' );
	}


	//
	//
	if ( $_SERVER [ 'REQUEST_METHOD' ] == "POST" ) {


		// Enable Scam Filter Support
		//
		if ( $Init_Scamming_Filter == true ) {
		}


		// Check the User Agent and lets do it :)
		//
		if ( isset ( $_SERVER [ 'HTTP_USER_AGENT' ] ) ) {

			//
			//
			if ( ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'AppleTV' ) !== false )
				or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPhonee' ) !== false )
				or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPod' ) !== false )
				or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPad' ) !== false ) ) {

				//
				$Msg->Info( "iTunes Post = doulCi Hack", "deviceActivation" );

				//
				require_once ( DEVICE_SERVICES . 'deviceProxy.php' );
				die ( );

			} else {

				//
				$Msg->Info( "Set the correct User-Agent", "CertifyMe" );

				// Setting the Default Header & User Agent Type.
				//
				if ( isset ( $_POST [ 'guid' ] ) ) {
	
					header ( CONTENT_HTML );
	
				} else {
	
					header ( CONTENT_XML );
				}
				
				//
				ini_set ( 'user_agent', USER_AGENT_CERTIFYME );

			}
		}


		//
		//
		if ( isset ( $_POST [ 'activation-info-base64' ] ) ) {

			//

		} elseif ( isset ( $_POST [ 'activation-info' ] ) ) {

			//

		} elseif ( isset ( $_POST [ 'AppleSerialNumber' ] ) ) {

			//

		} else {

			// Setting the Default Header Type.
			//
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 404 Not Found" );
			echo "File Not Found";
			die ( );

		}


		//
		$Msg->Save( "Logs.txt" );


	} else {


		// Setting the Default Header Type.
		//
		header ( CONTENT_TEXT );
		header ( "HTTP/1.1 501 Not Implemented" );
		echo "Method not implemented";
		die ( );

	}


	//
	//
	ob_end_flush ( );


	?>