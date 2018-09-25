<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>v3_final_mit_mysqli</title>
  <link rel="stylesheet" type="text/css" href="taschenrechner.css">
</head>
<body>

<?php 
//ini_set('display_errors', 0); 

// DB Verbindung herstellen
    $dbconnect = mysqli_connect("localhost", "root", "", "taschenrechner");
	$dbconnect->set_charset('utf8');
	if($dbconnect->connect_errno)
	{
		echo "Verbindung zur DB fehlgeschlagen: ". $dbconnect-connect_errno;
		
		exit;
	}

	echo '<br><b>Verbindung zur DB erfolgreich!<b><br> ';


	$num1= $_POST['number1'];
	$num2= $_POST['number2'];
		
	if(is_numeric($num1) && is_numeric($num2))
	{
		if(isset($_POST['g']))
		{
			$operation = $_POST['g'];
				
			switch($operation)
			{
				case '+';
				$result=$num1+$num2;
				break;
					
				case '-';
				$result=$num1-$num2;
				break;
					
				case '*';
				$result=$num1*$num2;
				break;
					
				case '/';
				if($num2 == 0)
				{
					echo "<br>Teilen durch null nicht möglich";
				}
				else
				{
					$result=$num1/$num2;
					break;
				}
					
				case '^';
				$result=pow($num1, $num2);
			    break;
					
			    case '%';
				$result=$num1%$num2;
				break;
					
			}
				
		}
		else 
		{
			echo "Bitte wähle einen Operator aus";
		}
	}
	else 
	{
		echo "Bitte geben Sie nur numerische Werte ein";
	}

	
	


// funktioniert
function fillDatabaseBillig($dbconnect)
{
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$email = $_POST['email'];
		
	if(empty($vorname) || empty($nachname) || empty($email))
	{
		echo 'Bitte füllen sie alle Felder aus <br>';
	} 
	else 
	{ 
		$sql2 = "INSERT INTO billig(Vorname, Nachname, Email) VALUES ('$vorname', '$nachname', '$email')";
		$tragEsEinMann = mysqli_query($dbconnect, $sql2) or die('Konnte wieder nicht die tabelle füllen :o');
		echo 'Eintrag wurde in der Datenbank gespeichert';
	}
	
	// DB Inhalt auslesen
	
	$erg = $dbconnect->query("SELECT * FROM billig") or die($dbconnect->error);
	echo "<br><h1> Inhalt von der billig Tabelle: <br></h1>";
	print_r($erg);
	if($erg->num_rows)
	{
		echo "<br>Daten vorhanden: Anzahl ";
		echo $erg->num_rows ;
		echo '<br>';
	}	
	
	
}

// funktioniert
function printDatabaseBillig($dbconnect)
{
	// DB Inhalt ausgeben
	$erg = $dbconnect->query("SELECT * FROM billig") or die($dbconnect->error);
	
	echo '<table width="600" border="1" cellpadding="1" cellspacing="1">';
	    echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>Vorname</th>";
		echo "<th>Nachname</th>";
		echo "<th>Email</th>";
	while ($datensatz = $erg->fetch_assoc())
	{
		
		echo "</tr>";
		echo "<tr>";
		echo '<td>' . $datensatz['ID'] . "</td>";
		echo '<td>' .$datensatz['Vorname'] . "</td>";
		echo '<td>'.$datensatz['Nachname'] . "</td>";
		echo "<td>".$datensatz['Email']. "</td>";
		echo "</tr>";
	}
	echo '</table>';
	
}


// funktioniert
function fillDatabaseBerechnungen($result, $dbconnect)
{
	$num1 = $_POST['number1'];
	$num2 = $_POST['number2'];
	$operation = $_POST['g'];
			
	$sql3 = "INSERT INTO berechnungen(Erste_Zahl, Operator, Zweite_Zahl, Ergebnis) VALUES ($num1, '$operation', $num2, $result)";
	echo $num1 . $operation . $num2 . '=' . $result;
	$query2 = mysqli_query($dbconnect, $sql3) or die('<br>Die Tabelle wurde nicht gefüllt :o');	
	echo '<br>Eintrag wurde in der Datenbank gespeichert';
    
	// DB Inhalt auslesen
	
	$erg2 = $dbconnect->query("SELECT * FROM berechnungen") or die($dbconnect->error);
	echo "<br><h1> Inhalt von der berechnungen Tabelle: <br></h1>";
	print_r($erg2);
	if($erg2->num_rows)
	{
		echo "<br>Daten vorhanden: Anzahl ";
		echo $erg2->num_rows;
	}	
	
	
} 

// funktioniert
function printDatabaseBerechnungen($dbconnect)
{
	// DB Inhalt ausgeben
	$erg = $dbconnect->query("SELECT * FROM berechnungen") or die($dbconnect->error);
	echo '<table width="600" border="1" cellpadding="1" cellspacing="1" >';
	    echo "<tr>";
	    echo "<th>ID</th>";
		echo "<th>Erste Zahl</th>";
		echo "<th>Operator</th>";
		echo "<th>Zweite Zahl</th>";
		echo "<th>Ergebnis</th>";
	while ($datensatz = $erg->fetch_assoc())
	{
		echo "</tr>";
		echo "<tr>";
		echo '<td>' .$datensatz['ID'] . "</td>";
		echo '<td>' .$datensatz['Erste_Zahl'] . "</td>";
		echo '<td>'.$datensatz['Operator'] . "</td>";
		echo "<td>".$datensatz['Zweite_Zahl']. "</td>";
		echo "<td>".$datensatz['Ergebnis']. "</td>";
		echo "</tr>";
	}
	echo '</table>';
	
}

// funktioniert
function checkSet($dbconnect, $result)
{
	if(isset($_POST['zahlschicken']))
    {
		
		fillDatabaseBerechnungen($result, $dbconnect);
    }
	
	if (isset($_POST['printBerechnungen']))
	{
		printDatabaseBerechnungen($dbconnect);
	}
	
	if(isset($_POST['anBilligSchicken']))
	{	
		fillDatabaseBillig($dbconnect);
	}
	
	if (isset($_POST['printBillig']))
	{
		printDatabaseBillig($dbconnect);
	}

	
}

checkSet($dbconnect, $result);

?>

<div id="form1">
<h1>PhP Taschenrechner mit DB-Anbindung</h1>
<form action="taschenrechner_v3_final_mit_mysqli.php" method="POST">
  <input name="number1" title="Zahl" pattern="^[0-9]+$"  >
  <select name="g">
    <option value="+" >PLUS</option>
    <option value="-" >MINUS</option>
    <option value="*" >MAL</option>
    <option value="/">GETEILT</option>
    <option value="^">POTENZ</option>
	<option value="%">REST</option>
  </select>
  <input name="number2" title="Zahl" pattern="^[0-9]+$"  >
  <?php if(isset($_POST['zahlschicken'])) {echo '=' . $result;}  ?> 
  <br>
  <input type="submit" name="zahlschicken" id="absendenForm1">
  <input type="submit" name="printBerechnungen" value="DB ausgeben">
  <h2 style="color: red">Ergebnis:  <?php if(isset($_POST['zahlschicken'])) {echo $num1 . $operation . $num2 . '=' . $result;}  ?> </h2>
</form>
</div>

<br>

<div id="form2">
<h1>Schreiben in die Datenbank funktioniert:</h1>
<h2 style="color: lightgreen">Hier unten</h2>
<form action="taschenrechner_v3_final_mit_mysqli.php" method="POST">
		Vorname:  <input type="text" name="vorname" > <br>
		Nachname: <input type="text" name="nachname"> <br>
		Email:    <input type="email" name="email"> 
		<input type="submit" name="anBilligSchicken">
		<br><br>
		<input type="submit" name="printBillig" value="DB ausgeben">
</form>
</div>
<br>
<br>


</body>
</html>



