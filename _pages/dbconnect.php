<?php
	
	$mysqli = mysqli_connect("localhost", "root", "", "taschenrechner");
	if($mysqli->connect_errno)
	{
		echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
		
		exit;
	}

	echo "Verbindung zur DB erfolgreich!";
?>