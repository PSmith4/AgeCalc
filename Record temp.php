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


$data=$conn->query($callState) or die("Query $callState failed ".mysqli_error($conn));

$conn->close();

if ($data->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       	echo "_";	
		echo $row['Name'];
		echo $row['BirthDate'];
		echo $row['EntryDate'];
		echo $row['AgeRecorded'];
		echo "\r\n";
    }
}
else{
	echo "nothing recived";
}

	echo "done\r\n";
$data->close();

 ?>