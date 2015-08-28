<?php


	//
	//
	class ShowMsg {


		//
		//
		private $ListString;


		//
		//
		function ShowMsg() {
		}

		
		//
		//
		function getLString() {
			
			return $this->ListString;
		}


		//
		//
		function Log( $ErrorLevel = 'INFO', $String = '', $Tag ) {

			$this->ListString = sprintf( "%s%s - %s - %s\r\n", $this->getLString(), $ErrorLevel, $Tag, $String );
		}


		//
		//
		function Save( $Path = "" ) {

			if ( file_exists ( $Path ) && is_file ( $Path ) ) {
	
				$Contents = file_get_contents ( $Path );
				$Contents .= $this->getLString();

				file_put_contents ( $Path, $Contents );

			} else {

				file_put_contents ( $Path, $this->getLString() );
			}
		}


		//
		//
		function Info( $String = "", $Tag = "" ) {
			
			self::Log( "INFO", $String, $Tag );
		}


		//
		//
		function Warning( $String = "", $Tag = "" ) {
			
			self::Log( "WARNING", $String, $Tag );
		}


		//
		//
		function Error( $String = "", $Tag = "" ) {
			
			self::Log( "ERROR", $String, $Tag );
		}


		//
		//
		function Debug( $String = "", $Tag = "" ) {
			
			self::Log( "DEBUG", $String, $Tag );
		}


	}


	//
	//


	?>