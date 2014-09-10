<?php
/** Skript zur Überprüfung ob ein Benutzer angemeldet ist um einen Bereich sehen zu können.
	 Falls der Benutzer nicht angemeldet ist wird er auf die Startseite zurück geleitet. **/ 
require_once "constant.php";
if(!isset($_SESSION['user'])){
	$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
	header("Location: http://$host/BuLiTippspiel/index.php");
}
?>