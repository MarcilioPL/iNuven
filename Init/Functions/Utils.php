<?php

function str_replace_json ( $search, $replace, $subject )
{
	return json_decode ( str_replace ( $search, $replace, json_encode ( $subject ) ) );
}

function xssafe ( $data, $encoding = 'UTF-8' )
{
	return htmlspecialchars ( $data, ENT_QUOTES | ENT_HTML401, $encoding );
}

function xecho ( $data )
{
	echo xssafe ( $data );
}

	?>