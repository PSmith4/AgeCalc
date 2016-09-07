<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname =  substr($url["path"], 1);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
$Sname = mysqli_real_escape_string($conn, $_POST['Sname']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$ageRecorded = mysqli_real_escape_string($conn, $_POST['ageRecorded']);
$MarsageRecorded = mysqli_real_escape_string($conn, $_POST['MarsageRecorded']);
$timestamp = mysqli_real_escape_string($conn, $_POST['timestamp']);

//echo $name;
//echo "<br>";
//echo $timestamp;
//echo "<br>";
//echo $birthday;
//echo "<br>";
//echo $ageRecorded;
//echo "<br>";


//convert to sql date formate

$timestampSQL= new DateTime("@$timestamp");
$timestampSQL->setTimezone(new DateTimeZone('Australia/Sydney'));

$birthdaySQL= new DateTime("@$birthday");
$birthdaySQL->setTimezone(new DateTimeZone('Australia/Sydney'));


$timestampStr=$timestampSQL->format('Y-m-d H:i:s');
$birthdayStr=$birthdaySQL->format('Y-m-d H:i:s');
//echo timestampStr;
//echo "<br>";
//echo $birthdayStr;
//echo "<br>";

$insertState = "INSERT INTO record_of_request2 (FName, SName, BirthDate, EntryDate, AgeRecorded, MarsAgeRecorded) Values('$Fname','$Sname','$birthdayStr','$timestampStr','$ageRecorded','$MarsageRecorded')";


$conn->query($insertState);

$conn->close();

echo "done";
?>