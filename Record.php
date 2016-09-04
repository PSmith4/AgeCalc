<?php
echo "hello";
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname =  substr($url["path"], 1);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$callState = "SELECT Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;";


$data=$conn->query($callState);

$conn->close();

echo "<table> 
	<tr>
    <th>Name</th>
    <th>Entered Birtday</th> 
    <th>Date Entered</th>
	<th>Age Reported</th>
	</tr>";

foreach ($data as $row){
	echo "<tr> <td>" . $row['Name'] . "</td> <td> " . $row['BirthDate'] . "</td> <td>" . $row['EntryDate'] . "</td> <td>" . $row['AgeRecorded'] . "</td> </tr>";
}
	
echo "</table>";
 ?>