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
	$Msg->Info( "iTunes Post = iOS 8.0 and Up", "AInfo" );


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
	$DeviceEncoded->save( $DevicePath . DS . "ActivationInfo.plist");
	$DeviceDecoded->save( $DevicePath . DS . "ActivationInfoXML.plist");


	//
	//
	$FairPlayCertChain_Der_Content = file_get_contents ( $DevicePath . DS . "FairPlayCertChain.der" );
	$FairPlayCertChain_Pem_Content = '-----BEGIN CERTIFICATE-----' . PHP_EOL . chunk_split ( base64_encode ( $FairPlayCertChain_Der_Content ), 64, PHP_EOL ) . '-----END CERTIFICATE-----' . PHP_EOL;


	//
	file_put_contents ( $DevicePath . DS . "FairPlayCertChain.pem", $FairPlayCertChain_Pem_Content );


	// Prepare ActivationInfoXML.plist File.
	//
	$ActivationInfoDEC = file_get_contents ( $DevicePath . DS . "ActivationInfoXML.plist" );
	$ActivationInfoDEC = $PParser->parse ( $ActivationInfoDEC );


	// Get And Store DeviceCertRequest Public Key.
	//
	$Certificate = base64_decode ( $DeviceCert );
	$Certificate_Details = openssl_pkey_get_details ( openssl_csr_get_public_key ( $Certificate ) );
	$Certificate_PublicKey = $Certificate_Details[ 'key' ];

	//
	file_put_contents ( $DevicePath . DS . "DeviceCert.csr", $Certificate );
	file_put_contents ( $DevicePath . DS . "DeviceCertPublic.key", $Certificate_PublicKey );


	// Extra
	//
	extract ( $ActivationInfoDEC );



	// This is an extremely needed check :).
	//
	$Check_iDevice = Check_iDevice ( $ProductType );
	$Check_iDevice_Type = Check_iDevice ( $ProductType, true );
	$Check_iDevice_Name = Check_iDevice ( $ProductType, true, true );


	//
	//
	if ( $Check_iDevice === true ) {

		$Msg->Info( "Check_iDevice = Look for SIMStatus\r\n", "AInfo" );
		$Has_SIM = true;
			
		if ( array_key_exists ( 'SIMStatus', get_defined_vars ( ) ) ) {

			$Msg->Info( "SIMStatus = Checked " . $SIMStatus, "AInfo" );

			if ( Check_SIMStatus ( $SIMStatus ) === true ) {

				$Msg->Info( "SIMStatus = Normal " . $SIMStatus, "AInfo" );
				$SIM_OK = true;

			} else {

				$Msg->Info( "SIMStatus = Warning " . $SIMStatus, "AInfo" );
				$SIM_OK = false;

			}

		} else {

			$Msg->Info( "SIMStatus = Error " . $SIMStatus, "AInfo" );
			$SIM_OK = false;
		}

	} else {

		$Msg->Info( "SIMStatus = Default SIM Status to Normal " . $SIMStatus, "AInfo" );
		$Has_SIM = false;
		$SIM_OK = false;
	}


	//
	//
	if ( ( $ProductType == "iPod1,1" )
			or ( $ProductType == "iPod2,1" )
			or ( $ProductType == "iPod3,1" )
			or ( $ProductType == "iPod4,1" )
			or ( $ProductType == "iPod5,1" )
//			or ( $ProductType == "iPhone3,1" )
//			or ( $ProductType == "iPhone3,2" )
//			or ( $ProductType == "iPhone3,3" )
			or ( $ProductType == "iPad2,1" )
			or ( $ProductType == "iPad2,2" )
			or ( $ProductType == "iPad2,3" )
			or ( $ProductType == "iPad2,4" ) ) {

		$Has_SIM = false;
	}



	// Get Device Type.
	//
	if ( $Check_iDevice_Name != null ) {

		$Msg->Info( "Check_iDevice_Name = Normal", "AInfo" );
		$iDeviceType = $Check_iDevice_Name;

	} else {

		$Msg->Info( "Check_iDevice_Name = Unknown", "AInfo" );
		$iDeviceType = "Unknown iDevice";
	}


	// Check SAM & Get Started :).
	//
	if ( $Has_SIM == true ) {

		require_once ( DEVICE_SERVICES . 'AInfo_Template.php' );
	}

	$activationbase64 = base64_encode( $Request_Info );


	header( CONTENT_HTML );

	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="keywords" content="iTunes Store" />
		<meta name="description" content="iTunes Store" />
		<title>iPhone Activation</title>
		<link href="https://static.ips.apple.com/deviceservices/stylesheets/auth_styles.css" charset="utf-8" rel="stylesheet" />
		<script src = "https://static.ips.apple.com/deviceservices/scripts/spinner_reload.js">
		</script><script>var protocolElement = document.getElementById("protocol");var protocolContent = protocolElement.innerText;iTunes.addProtocol(protocolContent);</script>
		<style>.spinner { background-image: url("https://static.ips.apple.com/deviceservices/images/spinner_reload_16px.png"); }</style>
	</head>
	<body>
		<div class="page">
			<div class="content">

				<section class="headline">
					<h1 class="title"><span class="title-text">Ative o iPhone</span></h1>
					<p class="subtitle">Inicie a sessão com o para configurar este iPhone.</p>
					<label><a tabindex="-1" target="_blank" class="activationhelp" href="http://support.apple.com/kb/TS4515?viewlocale=pt_BR">Ajuda de Ativação</a></label>
				</section>


				<form method="post" id="auth_form" action="https://192.168.1.2/deviceservices/deviceActivation">

					<section class="sectioned-content">
						<label>ID Apple <input type="text" name="login" value="" placeholder="" spellcheck="false"/></label>

						<label>Senha <input type="password" name="password" /></label>

						<p class="form-error" id="form-error">ID Apple ou Senha Incorretos</p>
					</section>

					<section>

						<button id="btn-continue" name="btn-continue" class="btn-continue" type="submit" onclick="submitActivate();">Continuar</button>

						<div id="submitted-spinner" class="spinner" style="display:none;"></div>

					</section>
						
					<input type="hidden" name="isAuthRequired" value="true" />

					<input type="hidden" name="activation-info-base64" value="<?php echo $activationbase64; ?>" />

				</form>
			</div>

		</div>
	</body>
</html>
