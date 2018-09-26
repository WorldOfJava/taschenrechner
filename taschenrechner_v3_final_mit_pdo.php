<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>v3_final_mit_pdo</title>
  <link rel="stylesheet" type="text/css" href="taschenrechner.css">
</head>
<body>

<?php 
ini_set('display_errors', 0); 

// DB Verbindung herstellen
    $pdo = new PDO('mysql:host=localhost;dbname=taschenrechner', 'root', '');
	$pdo->exec("set names utf8");
	echo '<br><b> Verbindung zur DB erfolgreich</b><br>';
	


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
					echo "<br>Teilen durch null nicht möglich ";
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
		echo ' Ohne Eingabe isset halt leer <br/>';
	}

// funktioniert
function fillDatabaseBillig($pdo)
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
		$sql2 = $pdo->prepare("INSERT INTO billig(Vorname, Nachname, Email) VALUES (:vorname, :nachname, :email)");
		$sql2->bindParam(':vorname', $vorname);
		$sql2->bindParam(':nachname', $nachname);
		$sql2->bindParam(':email', $email);
		$sql2->execute();
		echo 'Eintrag wurde in der Datenbank gespeichert';
	}
	
	
}

// funktioniert
function printDatabaseBillig($pdo)
{
	$pdoSQL2 = "SELECT * FROM billig";
	echo '<table width="600" border="1" cellpadding="1" cellspacing="1">';
	    echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>Vorname</th>";
		echo "<th>Nachname</th>";
		echo "<th>Email</th>";
		echo "<th>Aktion</th>";
	foreach ($pdo->query($pdoSQL2) as $row) 
	{
		echo "</tr>";
		echo "<tr>";
		echo "<td>" .$row['ID']."<br/> </td>";
		echo "<td>" .$row['Vorname']."<br/> </td>";
		echo "<td>" .$row['Nachname']."<br/> </td>";
		echo "<td>" .$row['Email']."<br/> </td>";
		echo "<td>" . '<button name="killRow" >Löschen</button>' . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}



// funktioniert
function fillDatabaseBerechnungen($result, $pdo)
{
	$num1 = $_POST['number1'];
	$num2 = $_POST['number2'];
	$operation = $_POST['g'];
			
	$sql3 = $pdo->prepare("INSERT INTO berechnungen(Erste_Zahl, Operator, Zweite_Zahl, Ergebnis) VALUES (:num1, :operation, :num2, :result)");
	$sql3->bindParam(':num1', $num1);
	$sql3->bindParam(':operation', $operation);
	$sql3->bindParam(':num2', $num2);
	$sql3->bindParam(':result', $result);
	$sql3->execute();
	echo $num1 . $operation . $num2 . '=' . $result;
	echo '<br>Eintrag wurde in der Datenbank gespeichert';
	
} 

// funktioniert
function printDatabaseBerechnungen($pdo)
{
	// DB Inhalt ausgeben
	$pdoSQL3 = "SELECT * FROM berechnungen";
	echo '<table width="600" border="1" cellpadding="1" cellspacing="1" >';
	    echo "<tr>";
	    echo "<th>ID</th>";
		echo "<th>Erste Zahl</th>";
		echo "<th>Operator</th>";
		echo "<th>Zweite Zahl</th>";
		echo "<th>Ergebnis</th>";
	    echo "<th>Aktion</th>";
	foreach ($pdo->query($pdoSQL3) as $row2)
	{
		echo "</tr>";
		echo "<tr>";
		echo '<td>' .$row2['ID'] . "</td>";
		echo '<td>' .$row2['Erste_Zahl'] . "</td>";
		echo '<td>' .$row2['Operator'] . "</td>";
		echo "<td>" .$row2['Zweite_Zahl']. "</td>";
		echo "<td>" .$row2['Ergebnis']. "</td>";
		echo "<td>" . '<button name="killRow2" >Löschen</button>' . "</td>";
		echo "</tr>";
	}
	echo '</table>';
	
}
// instabil
function deleteRow($pdo)
{
	$sqldel = "DELETE FROM taschenrechner WHERE ID = ?";
	$pdo->exec($sqldel);
	echo "Eintrag erfolgreich gelöscht";
}

// funktioniert
function checkSet($pdo, $result)
{
	if(isset($_POST['zahlschicken']))
    {
		
		fillDatabaseBerechnungen($result, $pdo);
    }
	
	if (isset($_POST['printBerechnungen']))
	{
		printDatabaseBerechnungen($pdo);
	}
	
	if(isset($_POST['anBilligSchicken']))
	{	
		fillDatabaseBillig($pdo);
	}
	
	if (isset($_POST['printBillig']))
	{
		printDatabaseBillig($pdo);
	}

	//geht nicht, der im button(z. 117) gesetzte Name kann nicht angesprochen werden
	if(isset($_POST['killRow']))
	{
		echo 'geht xD';
	}
}

checkSet($pdo, $result);

?>

<div id="form1">
<h1>PhP Taschenrechner mit DB-Anbindung</h1>
<form action="taschenrechner_v3_final_mit_pdo.php" method="POST">
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
<form action="taschenrechner_v3_final_mit_pdo.php" method="POST">
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



