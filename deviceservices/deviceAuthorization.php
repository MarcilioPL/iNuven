<?php


	//
	//
	session_start();


	//
	//
	require_once ( '../Init/Init.php' );


	// Enable Maintenance Support
	//
	if ( $Init_Maintenance == true ) {

		//
		require_once ( DEVICE_SERVICES . 'deviceMaintenance.php' );
	}


	// Check the User Agent and lets do it :)
	//
	if ( isset ( $_SERVER [ 'HTTP_USER_AGENT' ] ) ) {


		//
		//
		if ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], USER_AGENT_INIT ) !== false ) {


			//
			//
			if ( isset ( $_GET [ 'auth' ] ) && ( $_GET [ 'auth' ] != null ) ) {


				// Check the User Agent and lets do it :)
				//
				$iNuven_Get_Auth = base64_decode ( $_GET [ 'auth' ] );

				//
				if ( @Check_File ( INIT_AUTH_DIRECTORY . $iAuth ) ) {

					// will be json :)
					// Setting the Default Header Type.
					header ( CONTENT_TEXT );
					header ( "HTTP/1.1 200 OK" );
					echo "Success";

				} else {

					// will be json :)
					// Setting the Default Header Type.
					//
					header ( CONTENT_TEXT );
					header ( "HTTP/1.1 200 OK" );
					echo "Denied";
				}

			} else {

				// Setting the Default Header Type and Error Message.
				//
				header ( CONTENT_TEXT );
				header ( "HTTP/1.1 403 Forbidden" );
				echo "GA. Service Access Denied";
			}

		} else {


			// Setting the Default Header Type and Error Message.
			//
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 403 Forbidden" );
			echo "UA. Service Access Denied";
		}

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