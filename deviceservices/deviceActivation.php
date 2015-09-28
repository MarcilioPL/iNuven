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
				$Msg->Info( "We have a proxy here", "deviceActivation" );

				//
				require_once ( DEVICE_SERVICES . 'deviceProxy.php' );
				die ( );

			} else {

				//
				$Msg->Info( "Set the correct User-Agent", "deviceActivation" );

				//
				ini_set ( 'user_agent', USER_AGENT_ACTIVATION );

			}
		}








		//
		//
		if ( isset ( $_POST [ 'activation-info-base64' ] ) ) {

			//
			require_once ( DEVICE_SERVICES . "AInfoB64.php" );

		} elseif ( isset ( $_POST [ 'activation-info' ] ) ) {

			//
			require_once ( DEVICE_SERVICES . "AInfo.php" );

		} elseif ( isset ( $_POST [ 'AppleSerialNumber' ] ) ) {

			//
			require_once ( DEVICE_SERVICES. "AInfoASN.php" );

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
		header ( "HTTP/1.1 404 Not Found" );
		echo "File Not Found";
		die ( );

	}


	//
	//
	ob_end_flush ( );


	?>