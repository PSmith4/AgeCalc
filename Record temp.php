<?php
$servername =  "localhost";
$username = "ageCalc";
$password = "password";
$dbname =  "ageCalcRecords";

$conn = mysql_connect($servername, $username, $password);
mysql_select_db($dbname, $conn);


$callState = "SELECT Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;";


$data=mysql_query($callState,$conn) or die("Query $callState failed ".mysql_error($conn));
$numRows = mysql_num_rows($data) or die ('couldnt count rows'.mysql_error($conn));
echo $numRows;
if(empty($data)){
	echo "nothing recived";
}

$conn->close();


foreach ($data as $row){
	echo $row['1'];
	echo $row['Name'];
	echo $row['BirthDate'];
	echo $row['EntryDate'];
	echo $row['AgeRecorded'];
	echo "\r\n";
}
	echo "done\r\n";
echo "</table>";
 ?>