<?php
$servername =  "localhost";
$username = "ageCalc";
$password = "password";
$dbname =  "ageCalcRecords";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$callState = "SELECT FName, SName, BirthDate, EntryDate, AgeRecorded, MarsAgeRecorded FROM record_of_request2;";


$data=$conn->query($callState);
echo $data;

$conn->close();
echo '<link rel="stylesheet" type="text/css" href="css/style.css"/>';
echo "<table> 
	<tr>
    <th>First Name</th>
	 <th>Surname</th>
    <th>Entered Birtday</th> 
    <th>Date Entered</th>
	<th>Age Reported</th>
	<th>Mars Age Reported</th>
	</tr>";

foreach ($data as $row){
	echo "<tr> <td>" . $row['FName'] . "</td>  <td>" . $row['SName'] . "</td> <td> " . $row['BirthDate'] . "</td> <td>" . $row['EntryDate'] . "</td> <td>" . $row['AgeRecorded'] . "</td>  <td>" . $row['MarsAgeRecorded'] . "</td></tr>";
}

echo "</table>";
 ?>