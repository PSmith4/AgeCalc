<?php
echo "start\r\n";
$servername =  "localhost";
$username = "ageCalc";
$password = "password";
$dbname =  "ageCalcRecords";
echo $servername;
echo $username;
echo $password;
echo $dbname;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "connected<br>";

$drop = "DROP TABLE IF EXISTS `record_of_request2`;"; 
if ($conn->query($drop) === TRUE){ echo "Drop Done<br>";} 
else {echo "Error dropping " . $conn->error;}
$creat ="CREATE TABLE `record_of_request2` (  `ID` int NOT NULL AUTO_INCREMENT,  `FName` mediumtext,  `SName` mediumtext,  `BirthDate` datetime DEFAULT NULL,  `EntryDate` datetime DEFAULT NULL,  `AgeRecorded` int DEFAULT NULL,  `MarsAgeRecorded` int DEFAULT NULL,  PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
if ($conn->query($creat) === TRUE){ echo "Tabel Recreation don<br>";} 
else {echo "Error recreating " . $conn->error;}

$insert ="INSERT INTO record_of_request2 (FName, BirthDate, EntryDate, AgeRecorded) Select Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;";
if ($conn->query($insert) === TRUE){ echo "Tabel population don<br>";} 
else {echo "Error Populating " . $conn->error;}

$callState = "SELECT ID, FName FROM record_of_request2;";
$data=$conn->query($callState);

echo '<link rel="stylesheet" type="text/css" href="css/style.css"/>';
echo "<table>";
foreach ($data as $row){
	echo "<tr> <td>" . $row['FName'] . "</td>  <td>" . $row['ID'] . "</td></tr>";
	
}
echo "</table>";

foreach ($data as $row){
	echo $row['FName'];
	echo "<br>";
	echo $row['ID'];
	$names= explode(" ", $row['FName']);
	echo $names[0];
	echo "<br>";
	if ( count($names)>1)
	{
		echo $names[1];
		echo "<br>";
		$updte = "UPDATE record_of_request2 SET FName='" . $names[0] . "' , SName= '". $names[1] ."' WHERE ID= ". $row['ID'] . ";";
		echo $updte;
		if ($conn->query($updte) === TRUE){ echo "Update done";} 
		else {echo "Error updateing " . $conn->error;}
		
	}
}

$callState2 = "SELECT ID, FName, SName FROM record_of_request2;";
$data2=$conn->query($callState2);
echo "<table>";
foreach ($data2 as $row){
	echo "<tr> <td>" . $row['FName'] . "</td>  <td>" . $row['SName'] . "</td>  <td>" . $row['ID'] . "</td></tr>";
}
echo "</table>";

$conn->close();
?>