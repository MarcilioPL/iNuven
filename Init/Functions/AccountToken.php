<?php


function Clean_AccountToken ( $AccountTokenTemplate, $AccountTockenBase64Decode = false )
{
	$AccountTokenTemplate = str_replace_json ( "\\n\\\";", "\\\"", $AccountTokenTemplate );
	$AccountTokenTemplate = str_replace_json ( ";", ",", $AccountTokenTemplate );
	$AccountTokenTemplate = str_replace_json ( " = ", " : ", $AccountTokenTemplate );

	if ( $AccountTockenBase64Decode == true)
	{
		$AccountTokenTemplate = json_decode ( $AccountTokenTemplate, true );
	}
	else
	{
		$AccountTokenTemplate = $AccountTokenTemplate;
	}

	return $AccountTokenTemplate;
}


	function doAccountToken ( $IMEI, $Randomness, $UDID, $Ticket ) {
	
		$AccountTokenTemplate = "".
"{
	\"InternationalMobileEquipmentIdentity\" = \"$IMEI\";
	\"ActivityURL\" = \"https://albert.apple.com/deviceservices/activity\";
	\"ActivationRandomness\" = \"$Randomness\";
	\"UniqueDeviceID\" = \"$UDID\";
	\"CertificateURL\" = \"https://albert.apple.com/deviceservices/certifyMe\";
	\"PhoneNumberNotificationURL\" = \"https://albert.apple.com/WebObjects/ALUnbrick.woa/wa/phoneHome\";
	\"WildcardTicket\" = \"$Ticket\";
}";


		return $AccountTokenTemplate;
	}

	?>