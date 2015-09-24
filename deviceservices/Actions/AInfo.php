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
	$Msg->Info( "iTunes Post = doulCi Hack", "deviceActivation" );


	//
	//
	$DeviceEncoded = new DOMDocument;
	$DeviceEncoded->loadXML( $DeviceARecv );

	//
	$DeviceDActivation = base64_decode( $DeviceEncoded->getElementsByTagName('data')->item(0)->nodeValue );

	//
	$DeviceDecoded = new DOMDocument;
	$DeviceDecoded->loadXML( $DeviceDActivation );

	//
	$Nodes = $DeviceDecoded->getElementsByTagName('dict')->item(0)->getElementsByTagName('*');


	//
	//
	for ($i = 0; $i < $Nodes->length - 1; $i=$i+2) {
	
	
		//
		//
		switch ( $Nodes->item($i)->nodeValue ) {

			case "ActivationRandomness":
				$ActivationRandomness = $Nodes->item($i + 1)->nodeValue;
				break;

			case "DeviceCertRequest":
				$DeviceCert = $Nodes->item($i + 1)->nodeValue;
				break;
	
			case "DeviceClass":
				$DeviceClass = $Nodes->item($i + 1)->nodeValue;
				break;
	
			case "SerialNumber":
				$SerialNumber = $Nodes->item($i + 1)->nodeValue;
				break;
	
			case "UniqueDeviceID":
				$UDID = $Nodes->item($i + 1)->nodeValue;
				break;

			case "InternationalMobileEquipmentIdentity":
				$IMEI = $Nodes->item($i + 1)->nodeValue;
				break;

			case "InternationalMobileSubscriberIdentity":
				$IMSI = $Nodes->item($i + 1)->nodeValue;
				break;

			case "IntegratedCircuitCardIdentity":
				$ICCID = $Nodes->item($i + 1)->nodeValue;
				break;

			case "UniqueChipID":
				$UCID = $Nodes->item($i + 1)->nodeValue;
				break;

			case "ProductType":
				$ProductType = $Nodes->item($i + 1)->nodeValue;
				break;

			case "ActivationState":
				$ActivationState = $Nodes->item($i + 1)->nodeValue;
				break;

			case "ProductVersion":
				$ProductVersion = $Nodes->item($i + 1)->nodeValue;
				break;

			case "BuildVersion":
				$BuildVersion = $Nodes->item($i + 1)->nodeValue;
				break;
		}
	}


	// Prepare to Path
	//
	$DevicePath = DEVICE_ACTIVATION . $SerialNumber . "_" . $ProductType . "_" . $BuildVersion;


	// Check Path
	//
	$isDevicePath = Create_Dir ( $DevicePath, $Mode = 0755 );


	// Prepare iTunes Request POST Data.
	//
	file_put_contents ( $DevicePath . DS . "TicketRequest.json", json_encode ( $_POST ) );
	file_put_contents ( $DevicePath . DS . "TicketRequest.serialized", serialize ( $_POST ) );
#	file_put_contents ( $DevicePath . DS . "TicketRequest.txt", $_POST );


	//
	//
	$FairPlayCertChain = $DeviceEncoded->getElementsByTagName('data')->item(1)->nodeValue;
	$FairPlaySignature = $DeviceEncoded->getElementsByTagName('data')->item(2)->nodeValue;


	//
	file_put_contents ( $DevicePath . DS . "FairPlayCertChain.der", $FairPlayCertChain );
	file_put_contents ( $DevicePath . DS . "FairPlaySignature.key", $FairPlaySignature );


	//
	$DeviceEncoded->save( $DevicePath . DS . 'ActivationInfo.xml');
	$DeviceDecoded->save( $DevicePath . DS . 'ActivationInfoXML.xml');


	//
	//
	$FairPlayCertChain_Der_Content = file_get_contents ( $DevicePath . DS . "FairPlayCertChain.der" );
	$FairPlayCertChain_Pem_Content = '-----BEGIN CERTIFICATE-----' . PHP_EOL . chunk_split ( base64_encode ( $FairPlayCertChain_Der_Content ), 64, PHP_EOL ) . '-----END CERTIFICATE-----' . PHP_EOL;


	//
	file_put_contents ( $DevicePath . DS . "FairPlayCertChain.pem", $FairPlayCertChain_Pem_Content );


	// Prepare ActivationInfoXML.plist File.
	//
	$ActivationInfoDEC = file_get_contents ( $DevicePath . DS . "ActivationInfoXML.xml" );
	$ActivationInfoDEC = $PParser->parse ( $ActivationInfoDEC );


	// Get And Store DeviceCertRequest Public Key.
	//
	$iPhoneDeviceCR = base64_decode ( $DeviceCert );
	$iPhoneDeviceVect = openssl_pkey_get_details ( openssl_csr_get_public_key ( $iPhoneDeviceCR ) );
	$iPhoneDevicePublicKey = $iPhoneDeviceVect [ 'key' ];

	//
	file_put_contents ( $DevicePath . DS . "DeviceCertRequest.csr", $iPhoneDeviceCR );
	file_put_contents ( $DevicePath . DS . "DeviceCertRequest.key", $iPhoneDevicePublicKey );


	// Extra
	//
	extract ( $ActivationInfoDEC );


	?>