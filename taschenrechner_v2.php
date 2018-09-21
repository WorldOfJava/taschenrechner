<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>testen</title>
  <link rel="stylesheet" type="text/css" href="taschenrechner.css">

</head>
<body>

<?php 
ini_set('display_errors', 0); 

$ersteZahl = $_POST['number1'];
$zweiteZahl = $_POST['number2'];
 
if(isset($_POST['zahlschicken']))
	{
		$num1= $_POST['number1'];
		$num2= $_POST['number2'];
		if(is_numeric['num1'] && is_numeric['num2'])
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
					$result=$num1/$num2;
					break;
					
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
	}

// funktioniert
function fillDatabaseBillig()
{
	include("dbconnect.php");
	
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$email = $_POST['email'];

	
	if(isset($_POST['anBilligSchicken']))
	{
	 if(empty($vorname) || empty($nachname) || empty($email))
	{
		echo 'Bitte füllen sie alle Felder aus <br>';
	} else 
	 { 
		$sql2 = "INSERT INTO billig(Vorname, Nachname, Email) VALUES ('$vorname', '$nachname', '$email')";
		$tragEsEinMann = mysqli_query($mysqli, $sql2) or die('Konnte wieder nicht die tabelle füllen :o');
	 }
	}
}

	
// in arbeit
function fillDatabaseBerechnungen()
{
	include("dbconnect.php");
	if(isset($_POST['']))
	{
	$dbid = "SELECT Id FROM berechnungen ";
	$operator = $_GET['g'];
	
	
	if(empty($ersteZahl) || empty($operator) || empty($zweiteZahl) || empty($result))
	{
		echo "Bitte füllen sie alle Felder aus";
    }else 
	{
	$sql = "INSERT INTO berechnungen (Erste Zahl, Operator, Zweite Zahl, Ergebnis) VALUES ('$ersteZahl', '$operator', '$zweiteZahl', '$result')";
	$eintragen = mysqli_query($mysqli, $sql) or die('Konnte die Tabelle nicht füllen');
    }
	}
}

// nicht funktionsfähig
function printDatabaseBerechnungen()
{
	if(isset($_POST['zahlschicken']))
	{
	$abfrage = "SELECT * FROM billig";
    $ergebnis = mysqli_query($mysqli, $abfrage);
    if(! $ergebnis)
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	echo '<table border="1">';
	while($row = mysql_fetch_array($ergebnis))
	{
		echo '<tr>';
		echo '<td>'. $row['Id'] . "</td>";
		echo '<td>'. $row['ersteZahl'] . "</td>";
		echo '<td>'. $row['oper'] . "</td>";
		echo '<td>'. $row['email'] . "</td>";
		echo '</tr>';
	}
	echo '</table>';
	
	mysql_close($mysqli);
	}
}


// nicht funktionsfähig
/* function printDatabaseBillig()
{
	
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$email = $_POST['email'];
	$id = "SELECT Id FROM billig";
	
	if(isset($_POST['printBillig']))
	{
	$abfrage = "SELECT Id, Vorname, Nachname, Email FROM billig ";
    $ergebnis = mysqli_query($mysqli, $abfrage);
    if(! $ergebnis)
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	echo '<table border="1">';
		
		while($row = mysql_fetch_array($ergebnis))
		{
			echo "<tr>";
			echo "<td>". $row["Id"] . "</td>";
			echo "<td>". $row["Vorname"] . "</td>";
			echo "<td>". $row["Nachname"] . "</td>";
			echo "<td>". $row["Email"] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		mysql_close($mysqli);
	
	}
}
*/
function gearSecondo()
{
	if(isset($_POST['printBillig']))
	{
		mysql_select_db('taschenrechner');
		
		$sql3 = "SELECT * FROM billig";
		$myData = mysql_query($sql3);
		echo "<table border=1>
		<tr>
		<th>ID</th>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>Email</th>
		</tr>";
	while($record = mysql_fetch_array($myData))
	{
		echo "<tr>";
		echo "<td>" . $record['ID'] . "</td>";
		echo "<td>" . $record['Vorname'] . "</td>";
		echo "<td>" . $record['Nachname'] . "</td>";
		echo "<td>" . $record['Email'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	mysql_close($mysqli);
	}
}

fillDatabaseBillig();
	

// printDatabaseBillig();	
?>

<div id="form1">
<h1>PhP Taschenrechner mit DB-Anbindung</h1>
<form action="taschenrechner_v2.php" method="POST">
  <input name="number1" title="Zahl" pattern="^[0-9]+$"  >
  <select name="g">
    <option name="g" value="+" >PLUS</option>
    <option name="g" value="-" >MINUS</option>
    <option name="g" value="*" >MAL</option>
    <option name="g" value="/">GETEILT</option>
    <option name="g" value="^">POTENZ</option>
	<option name="g" value="%">REST</option>
  </select>
  <input name="number2" title="Zahl" pattern="^[0-9]+$"  >
	<br>
  <input type="submit" name="zahlschicken" id="absendenForm1">
  <h2 style="color: red">Ergebnis:  <?php if(isset($_POST['zahlschicken'])) {echo $result;}  ?> </h2>

</form>
</div>

<br>

<div id="form2">
<h1>Schreiben in die Datenbank funktioniert:</h1>
<h2 style="color: lightgreen">Hier unten</h2>
<form action="taschenrechner_v2.php" method="POST">
		Vorname:  <input type="text" name="vorname" > <br>
		Nachname: <input type="text" name="nachname"> <br>
		Email:    <input type="email" name="email"> 
		<input type="submit" name="anBilligSchicken">
		<br><br>
		<input type="button" name="printBillig" value="DB ausgeben">
		 
</form>
</div>
<br>
<br>

<table width="600" border="1" cellpadding="1" cellspacing="1">
<tr>

<th>Vorname</th>
<th>Nachname</th>
<th>Email</th>
</tr>

<?php

	while($zeile=mysql_fetch_assoc($myData)) {
		
		echo "<tr>";
		
		echo "<td>".$zeile['vorname']."</td>";
		
		echo "<td>".$zeile['nachname']."</td>";
		
		echo "<td>".$zeile['email']."</td>";
		
		echo "</tr>";
	}
?>

</table>

</body>
</html>



