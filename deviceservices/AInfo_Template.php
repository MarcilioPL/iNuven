<?php



	
	// ActivationInfoXML & CertificateInfoXML Template.
	//
	$Request_Albert = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	$Request_Albert .= '<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">' . "\n";
	$Request_Albert .= '<plist version="1.0">' . "\n";
	$Request_Albert .= '<dict>' . "\n";
	$Request_Albert .= '	<key>ActivationRandomness</key>' . "\n";
	$Request_Albert .= '	<string>' . $ActivationRandomness . '</string>' . "\n";
	$Request_Albert .= '	<key>ActivationRequiresActivationTicket</key>' . "\n";
	$Request_Albert .= '	<true/>' . "\n";
	$Request_Albert .= '	<key>ActivationState</key>' . "\n";
	$Request_Albert .= '	<string>' . $ActivationState . '</string>' . "\n";
	if ( array_key_exists ( 'BasebandActivationTicketVersion', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>BasebandActivationTicketVersion</key>' . "\n";
		$Request_Albert .= '	<string>' . $BasebandActivationTicketVersion . '</string>' . "\n";
	}
	if ( array_key_exists ( 'BasebandChipID', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>BasebandChipID</key>' . "\n";
		$Request_Albert .= '	<integer>' . $BasebandChipID . '</integer>' . "\n";
	}
	if ( array_key_exists ( 'BasebandMasterKeyHash', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>BasebandMasterKeyHash</key>' . "\n";
		$Request_Albert .= '	<string>' . $BasebandMasterKeyHash . '</string>' . "\n";
	}
	if ( array_key_exists ( 'BasebandSerialNumber', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>BasebandSerialNumber</key>' . "\n";
		$Request_Albert .= '	<data>' . $BasebandSerialNumber . '</data>' . "\n";
	}
	if ( array_key_exists ( 'BasebandThumbprint', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>BasebandThumbprint</key>' . "\n";
		$Request_Albert .= '	<string>' . $BasebandThumbprint . '</string>' . "\n";
	}
	$Request_Albert .= '	<key>BuildVersion</key>' . "\n";
	$Request_Albert .= '	<string>' . $BuildVersion . '</string>' . "\n";
	$Request_Albert .= '	<key>DeviceCertRequest</key>' . "\n";
	$Request_Albert .= '	<data>' . $DeviceCertRequest . '</data>' . "\n";
	$Request_Albert .= '	<key>DeviceClass</key>' . "\n";
	$Request_Albert .= '	<string>' . $DeviceClass . '</string>' . "\n";
	if ( array_key_exists ( 'DeviceVariant', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>DeviceVariant</key>' . "\n";
		$Request_Albert .= '	<string>' . $DeviceVariant . '</string>' . "\n";
	}
	if ( array_key_exists ( 'FMiPAccountExists', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>FMiPAccountExists</key>' . "\n";
		$Request_Albert .= '	<false/>' . "\n";
	}
	if ( array_key_exists ( 'IntegratedCircuitCardIdentity', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>IntegratedCircuitCardIdentity</key>' . "\n";
		$Request_Albert .= '	<string>' . $IntegratedCircuitCardIdentity . '</string>' . "\n";
	}
	if ( array_key_exists ( 'InternationalMobileEquipmentIdentity', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>InternationalMobileEquipmentIdentity</key>' . "\n";
		$Request_Albert .= '	<string>' . $InternationalMobileEquipmentIdentity . '</string>' . "\n";
	}
	if ( array_key_exists ( 'InternationalMobileSubscriberIdentity', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>InternationalMobileSubscriberIdentity</key>' . "\n";
		$Request_Albert .= '	<string>' . $InternationalMobileSubscriberIdentity . '</string>' . "\n";
	}
	$Request_Albert .= '	<key>ModelNumber</key>' . "\n";
	$Request_Albert .= '	<string>' . $ModelNumber . '</string>' . "\n";
	$Request_Albert .= '	<key>ProductType</key>' . "\n";
	$Request_Albert .= '	<string>' . $ProductType . '</string>' . "\n";
	$Request_Albert .= '	<key>ProductVersion</key>' . "\n";
	$Request_Albert .= '	<string>' . $ProductVersion . '</string>' . "\n";
	if ( array_key_exists ( 'RegionCode', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>RegionCode</key>' . "\n";
		$Request_Albert .= '	<string>' . $RegionCode . '</string>' . "\n";
	}
	if ( array_key_exists ( 'RegionInfo', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>RegionInfo</key>' . "\n";
		$Request_Albert .= '	<string>' . $RegionInfo . '</string>' . "\n";
	}
	if ( array_key_exists ( 'RegulatoryModelNumber', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>RegulatoryModelNumber</key>' . "\n";
		$Request_Albert .= '	<string>' . $RegulatoryModelNumber . '</string>' . "\n";
	}
	if ( array_key_exists ( 'ReleaseType', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>ReleaseType</key>' . "\n";
		$Request_Albert .= '	<string>' . $ReleaseType . '</string>' . "\n";
	}
	if ( array_key_exists ( 'SIMGID1', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>SIMGID1</key>' . "\n";
		$Request_Albert .= '	<data>' . $SIMGID1 . '</data>' . "\n";
	}
	if ( array_key_exists ( 'SIMGID2', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>SIMGID2</key>' . "\n";
		$Request_Albert .= '	<data>' . $SIMGID2 . '</data>' . "\n";
	}
	if ( array_key_exists ( 'SIMStatus', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>SIMStatus</key>' . "\n";
		$Request_Albert .= '	<string>' . $SIMStatus . '</string>' . "\n";
	}
	$Request_Albert .= '	<key>SerialNumber</key>' . "\n";
	$Request_Albert .= '	<string>' . $SerialNumber . '</string>' . "\n";
	if ( array_key_exists ( 'SupportsPostponement', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>SupportsPostponement</key>' . "\n";
		$Request_Albert .= '	<true/>' . "\n";
	}
	if ( array_key_exists ( 'UniqueChipID', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>UniqueChipID</key>' . "\n";
		$Request_Albert .= '	<integer>' . $UniqueChipID . '</integer>' . "\n";
	}
	if ( array_key_exists ( 'UniqueDeviceID', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>UniqueDeviceID</key>' . "\n";
		$Request_Albert .= '	<string>' . $UniqueDeviceID . '</string>' . "\n";
	}
	if ( array_key_exists ( 'kCTPostponementInfoPRIVersion', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>kCTPostponementInfoPRIVersion</key>' . "\n";
		$Request_Albert .= '	<string>' . $kCTPostponementInfoPRIVersion . '</string>' . "\n";
	}
	if ( array_key_exists ( 'kCTPostponementInfoPRLName', get_defined_vars ( ) ) )
	{
		$Request_Albert .= '	<key>kCTPostponementInfoPRLName</key>' . "\n";
		$Request_Albert .= '	<integer>' . $kCTPostponementInfoPRLName . '</integer>' . "\n";
	}
	$Request_Albert .= '</dict>' . "\n";
	$Request_Albert .= '</plist>';


	// activation-info-base64 decoded version template , activation-info & certify-me-info template.
	//
	$Request_Info = '<?xml version="1.0"?>' . "\n";
	$Request_Info .= '<dict>' . "\n";
	$Request_Info .= '	<key>ActivationInfoComplete</key>' . "\n";
	$Request_Info .= '	<true/>' . "\n";
	$Request_Info .= '	<key>ActivationInfoXML</key>' . "\n";
	$Request_Info .= '	<data>' . "\n";
	$Request_Info .= '	' . chunk_split ( base64_encode ( $Request_Albert ), 68, "\r\n\t" );
	$Request_Info .= '</data>' . "\n";
	$Request_Info .= '	<key>FairPlayCertChain</key>' . "\n";
	$Request_Info .= '	<data>' . "\n";
	$Request_Info .= '	' . chunk_split ( base64_encode ( $FairPlayCertChain ), 68, "\r\n\t" );
//	$Request_Info .= '	' . chunk_split ( base64_encode ( $AccountCertificate ), 68, "\r\n\t" );
	$Request_Info .= '</data>' . "\n";
	$Request_Info .= '	<key>FairPlaySignature</key>' . "\n";
	$Request_Info .= '	<data>' . $FairPlaySignature . '</data>' . "\n";
	$Request_Info .= '</dict>';


	// Save Modified Requests.
	//
	file_put_contents ( $DevicePath . DS . "ActivationInfoXML_modified.plist", $Request_Albert );
	file_put_contents ( $DevicePath . DS . "ActivationInfo_modified.plist", $Request_Info );


	?>