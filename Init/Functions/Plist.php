<?php


function Plist_Wrapper ( $activation_info )
{
	$Parse_File = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . "\n";
	$Parse_File .= "<!DOCTYPE plist PUBLIC \"-//Apple//DTD PLIST 1.0//EN\" \"http://www.apple.com/DTDs/PropertyList-1.0.dtd\">" . "\n";
	$Parse_File .= "<plist version=\"1.0\">" . "\n";
	$Parse_File .= $activation_info . "\n";
	$Parse_File .= "</plist>";
	
	return $Parse_File;
}


function XML_Wrapper ( $activation_info )
{
	$Parse_File = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . "\n";
	$Parse_File .= "<!DOCTYPE plist PUBLIC \"-//Apple//DTD PLIST 1.0//EN\" \"http://www.apple.com/DTDs/PropertyList-1.0.dtd\">" . "\n";
	$Parse_File .= $activation_info;
	
	return $Parse_File;
}


	?>