<?php

	function Check_File ( $File_Name, $File_Size = 0 )
	{
		if ( file_exists ( $File_Name ) && is_file ( $File_Name ) && filesize ( $File_Name ) != $File_Size )
		{
			$Ret = true;
		} else {
			$Ret = false;
		}
		return $Ret;
	}


	function Create_Dir ( $path, $mode = 0755 )
	{
		$path = rtrim ( preg_replace ( array (
												"/\\\\/",
												"/\/{2,}/" 
		), "/", $path ), "/" );
		$e = explode ( "/", ltrim ( $path, "/" ) );
		if ( substr ( $path, 0, 1 ) == "/" )
		{
			$e [ 0 ] = "/" . $e [ 0 ];
		}
		$c = count ( $e );
		$cp = $e [ 0 ];
		for ( $i = 1; $i < $c; $i ++ )
		{
			if ( ! is_dir ( $cp ) && ! @mkdir ( $cp, $mode ) )
			{
				return false;
			}
			$cp .= "/" . $e [ $i ];
		}
		$protect = "<!DOCTYPE html>" . "\n";
		$protect .= "<html>" . "\n";
		$protect .= "	<head>" . "\n";
		$protect .= "		<title>" . "</title>" . "\n";
		$protect .= "	</head>" . "\n";
		$protect .= "	<body>" . "\n";
		// $protect .= " <div>".$doulCi_Adsense."</div>"."\n";
		$protect .= "	</body>" . "\n";
		$protect .= "</html>";
		
		@mkdir ( $path, $mode );
		@file_put_contents ( $path . "/index.php", $protect );
		
		return true;
	}


	?>