<?php
	
	$dbconnect = mysqli_connect("localhost", "root", "", "taschenrechner");
	if($dbconnect->connect_errno)
	{
		echo "Verbindung zur DB fehlgeschlagen: ". $dbconnect-connect_errno;
		
		exit;
	}

	echo '<b>Verbindung zur DB erfolgreich!<b><br> ';
?>