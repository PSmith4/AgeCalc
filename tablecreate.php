<?php
echo "start\r\n";
$servername =  "localhost";
$username = "ageCalc";
$password = "password";
$dbname =  "ageCalcRecords";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "connected<br>";

$creat ="CREATE TABLE `record_of_request` (`ID` int(11) NOT NULL AUTO_INCREMENT,`Name` mediumtext,`BirthDate` datetime DEFAULT NULL,`EntryDate` datetime DEFAULT NULL,`AgeRecorded` int(11) DEFAULT NULL,PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";
if ($conn->query($creat) === TRUE){ echo "Tabel Recreation don<br>";} 
else {echo "Error recreating " . $conn->error;}

$insertState = "INSERT INTO record_of_request (Name, BirthDate, EntryDate, AgeRecorded) Values('Test name','$birthdayStr','2016-08-10 00:00:00','66')";

$conn->close();
?>