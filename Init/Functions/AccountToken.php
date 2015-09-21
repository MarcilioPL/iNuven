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


	?>