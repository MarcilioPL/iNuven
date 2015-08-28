<?php



function cURLcheckBasicFunctions ( )
{
	if ( ! function_exists ( "curl_init" ) && ! function_exists ( "curl_setopt" ) && ! function_exists ( "curl_exec" ) && ! function_exists ( "curl_close" ) )
	{
		return false;
	}
	else
	{
		return true;
	}
}


function cURLgetData ( $Request_Url, $User_Agent, $Method = "POST", $Plist_FILE = "", $Get_Infos = false )
{
	$Url_Encoded = "";
	$Respond = "";
	$Headers = false;
	
	if ( ! cURLcheckBasicFunctions ( ) )
	{
		$Respond .= "UNAVAILABLE: cURL Basic Functions";
	}
	
	$cURL = curl_init ( );
	if ( ! $cURL )
	{
		$Respond .= "FAIL: curl_init() " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	
	// include GET as well as POST variables; your needs may vary.
	if ( $Method == "GET" )
	{
		foreach ( $_GET as $name => $value )
		{
			$Url_Encoded .= urlencode ( $name ) . '=' . urlencode ( $value ) . '&';
		}
		$Substr = true;
	}
	elseif ( $Method == "POST" )
	{
		if ( $Plist_FILE == "" )
		{
			global $iTunes_Headers;
			
			if ( $User_Agent != USER_AGENT_CERTIFYME )
			{
				$Headers = CONTENT_MULTIPART;
				$Headers .= CHACHE_CONTROL;
				$Headers .= $iTunes_Headers;
			}
			else
			{
				$Headers = CONTENT_MULTIPART_B;
				$Headers .= ACCEPT_LANGUAGE;
				// $Headers .= CONTENT_LENGHT."";
				$Headers .= "Accept: */*";
			}
			
			foreach ( $_POST as $name => $value )
			{
				$Url_Encoded .= urlencode ( $name ) . '=' . urlencode ( $value ) . '&';
			}
			$Substr = true;
		}
		else
		{
			// $Url_Encoded .= file_get_contents ( IOS_CUS_BUNDLES . $Plist_FILE
			// );
			$Headers = CONTENT_DATA;
			$Headers .= CHACHE_CONTROL;
			$Headers .= CONTENT_EXPECT;
			$Url_Encoded = $Plist_FILE;
			$Substr = false;
		}
	}
	
	// chop off last ampersand
	if ( $Substr == true )
	{
		$Url_Post = substr ( $Url_Encoded, 0, strlen ( $Url_Encoded ) - 1 );
	}
	
	// curl_setopt( $cURL, CURLOPT_DEBUGFUNCTION, true );
	if ( ! curl_setopt ( $cURL, CURLOPT_CUSTOMREQUEST, 'POST' ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_CUSTOMREQUEST) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_URL, $Request_Url ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_URL) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_HEADER, $Headers ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_HEADER) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_VERBOSE, false ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_VERBOSE) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_POST, true ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_POST) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_USERAGENT, $User_Agent ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_USERAGENT) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_POSTFIELDS, $Url_Encoded ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_POSTFIELDS) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_FOLLOWLOCATION, true ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_FOLLOWLOCATION) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_TIMEOUT, 60 ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_TIMEOUT) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_RETURNTRANSFER, true ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_RETURNTRANSFER) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_SSLVERSION, 3 ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_SSLVERSION) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_SSL_VERIFYHOST, false ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_SSL_VERIFYHOST) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	if ( ! curl_setopt ( $cURL, CURLOPT_SSL_VERIFYPEER, false ) )
	{
		$Respond .= "FAIL: curl_setopt(CURLOPT_SSL_VERIFYPEER) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	
	$cURL_Content = curl_exec ( $cURL );
	
	if ( ! $cURL_Content )
	{
		$Respond .= "FAIL: curl_exec($cURL) " . curl_error ( $cURL ) . " - No: " . curl_errno ( $cURL );
	}
	
	if ( $Get_Infos != false )
	{
		$Respond .= json_encode ( curl_getinfo ( $cURL ), JSON_PRETTY_PRINT );
	}
	
	if ( $Respond != null )
	{
		print $Respond;
	}
	
	$Respond_Infos = curl_getinfo ( $cURL, CURLINFO_HTTP_CODE );
	
	if ( $Respond_Infos )
	{
		
		if ( $Respond_Infos == 4000 )
		{
			// Setting the Default Header Type.
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 400 Bad Request" );
			$Error = "doulCi Bad Request";
			die ( $Error );
		}
		elseif ( $Respond_Infos == 4040 )
		{
			// Setting the Default Header Type.
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 404 Not Found" );
			$Error = "doulCi File Not Found";
			die ( $Error );
		}
		elseif ( $Respond_Infos == 5000 )
		{
			// Setting the Default Header Type.
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 500 Internal Error" );
			$Error = "doulCi Internal Error";
			die ( $Error );
		}
		elseif ( $Respond_Infos == 5010 )
		{
			// Setting the Default Header Type.
			header ( CONTENT_TEXT );
			header ( "HTTP/1.1 501 Not Implemented" );
			$Error = "doulCi Method not implemented";
			die ( $Error );
		}
	}
	
	curl_close ( $cURL );
	
	return $cURL_Content;
}



	?>