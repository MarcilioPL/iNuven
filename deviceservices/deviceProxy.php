<?php


	//
	//
	if ( $_SERVER [ 'REQUEST_METHOD' ] == "POST" ) {


		// Check the User Agent and lets do it :)
		//
		if ( isset ( $_SERVER [ 'HTTP_USER_AGENT' ] ) ) {


			//
			//
			if ( ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'AppleTV' ) !== false )
					or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPhone' ) !== false )
					or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPod' ) !== false )
					or ( strpos ( $_SERVER [ 'HTTP_USER_AGENT' ], 'iPad' ) !== false ) ) {

				// Make it Freeze and he we go :)
				// Setting the Default Header & User Agent Type.
				//
				header ( CONTENT_XML );
				$Unbrick = file_get_contents ( TEMPLATES . 'iDevices' . DS . 'Ubrick_iDevice.xml' );
				die ( $Unbrick );
			}


		} else {


			// Setting the Default Header Type.
			//
			header ( CONTENT_TEXT );
			header ( "HTTP/1.0 404 Not Found" );
			echo "DP File Not Found";
			die ( );


		}


	} else {


		// Setting the Default Header Type.
		//
		header ( CONTENT_TEXT );
		header ( "HTTP/1.1 501 Not Implemented" );
		echo "DP Method Not Implemented";
		die ( );


	}


	//
	//


	?>