<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = "agecalcsql1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$name = mysqli_real_escape_string($conn, $_POST['name']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$ageRecorded = mysqli_real_escape_string($conn, $_POST['ageRecorded']);
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

$sql = "INSERT INTO record_of_request (Name, BirthDate, EntryDate, AgeRecorded) Values('$name','$birthdayStr','$timestampStr','$ageRecorded')";


$conn->query($sql);

$conn->close();

//echo "done";
?>