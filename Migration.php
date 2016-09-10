<?php
echo "start";
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname =  substr($url["path"], 1);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$SQLStatment =
"DROP TABLE IF EXISTS `record_of_request2`;

CREATE TABLE `record_of_request2` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FName` mediumtext,
  `SName` mediumtext,
  `BirthDate` datetime DEFAULT NULL,
  `EntryDate` datetime DEFAULT NULL,
  `AgeRecorded` int DEFAULT NULL,
  `MarsAgeRecorded` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

insert into record_of_request2 (FName, BirthDate, EntryDate, AgeRecorded)
Select Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;"
echo $SQLStatment
$conn->query($SQLStatment);
echo "Tabel Recreation done";

?>