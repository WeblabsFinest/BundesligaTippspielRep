<?php	
		function connect(){
			$mysqli = new mysqli("localhost", "root", "", "bundesligatippspieldatabase");
			return $mysqli;
		}
?>