<?php
$servername =  "localhost";
$username = "ageCalc";
$password = "password";
$dbname =  "ageCalcRecords";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$callState = "SELECT Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;";


$data=$conn->query($callState) or trigger_error($conn->error);
$numRows = mysql_num_rows($data);
echo $numRows;
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if(empty($data)){
	echo "nothing recived";
}

$conn->close();


foreach ($data as $row){
	echo $row['1']
	echo $row['Name'];
	echo $row['BirthDate'];
	echo $row['EntryDate'];
	echo $row['AgeRecorded'];
	echo "\r\n";
}
	echo "done\r\n";
echo "</table>";
 ?>