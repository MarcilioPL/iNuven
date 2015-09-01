<?php


function Check_Signature ( $AccountTokenCertificate, $AccountTokenSignature, $AccountToken ) {

	$TokenCertificate			= base64_decode ( $AccountTokenCertificate );
	$TokenCertificate_Details	= openssl_pkey_get_details ( openssl_pkey_get_public ( $TokenCertificate ) );
	$TokenPublicKey				= $TokenCertificate_Details [ 'key' ];
	$TokenSignature				= base64_decode ( $AccountTokenSignature );
	$Token						= base64_decode ( $AccountToken );
	$TokenVerify				= openssl_verify ( $Token, $TokenSignature, $TokenPublicKey, "sha1WithRSAEncryption" );
	
	if ( $TokenVerify == true ) {
		$Results = " AccountTokenSignature is Okay, (as it should be) !" . "\n";

	} elseif ( $TokenVerify == false ) {
		$Results = " AccountTokenSignature is bad, (there's something wrong) ?" . "\n";

	} else {

		$Results = " AccountTokenSignature is ugly, (error checking signature) ." . "\n";
	}
	
	return $Results;
}


	?>