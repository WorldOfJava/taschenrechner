<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>testen</title>


</head>
<body>




<h1>Aufgabe 3</h1>
<form action="taschenrechner.php" method="POST">
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
  <input type="submit" name="submit">
  <h2 style="color: red">Ergebnis:  <?php echo $result;  ?> </h2>

	
	<form action="taschenrechner.php" method="POST">
		<input type="text" name="vorname" >
		<input type="text" name="nachname">
		<input type="email" name="email"> 
		<input type="submit" name="submit">
	</form>
	

  
  
</form>



<div id="resultList">


</div>

<?php

include_once("dbconnect.php"); 

	 ini_set('display_errors', 0); 
	if(isset($_POST['submit']))
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


$abfrage = "SELECT * FROM berechnungen";
$ergebnis = mysqli_query($mysqli, $abfrage);
while($row = mysqli_fetch_assoc($ergebnis))
{
	echo $row->id;
}

$ersteZahl = $_POST['number1'];
$operator = $_POST['g'];
$zweiteZahl = $_POST['number2'];
$wahresErgebnis = $_POST[$result];

//$sql = "INSERT INTO berechnungen (Erste Zahl, Operator, Zweite Zahl, Ergebnis) VALUES ('$ersteZahl', '$operator', '$zweiteZahl', '$wahresErgebnis')";

// $eintragen = mysqli_query($mysqli, $sql) or die('Konnte die Tabelle nicht füllen');




$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];


$sql2 = "INSERT INTO billig(Vorname, Nachname, Email) VALUES ('$vorname', '$nachname', '$email')";
$tragEsEinMann = mysqli_query($mysqli, $sql2) or die('Konnte wieder nicht die tabelle füllen :o');


  
?> 



</body>
</html>



