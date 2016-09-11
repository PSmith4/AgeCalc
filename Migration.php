<?php
echo "start\r\n";
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname =  substr($url["path"], 1);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "connected\r\n";

$DropStatment = "DROP TABLE IF EXISTS `record_of_request2`;";
$conn->query($DropStatment);

$createStatment ="CREATE TABLE `record_of_request2` (  `ID` int NOT NULL AUTO_INCREMENT,  `FName` mediumtext,  `SName` mediumtext,  `BirthDate` datetime DEFAULT NULL,  `EntryDate` datetime DEFAULT NULL,  `AgeRecorded` int DEFAULT NULL,  `MarsAgeRecorded` int DEFAULT NULL,  PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8; INSERT INTO record_of_request2 (FName, BirthDate, EntryDate, AgeRecorded) Select Name, BirthDate, EntryDate, AgeRecorded FROM record_of_request;";
$conn->query($createStatment);

echo "Tabel Recreation done\r\n";
$callState = "SELECT ID, FName FROM record_of_request2;";
$data=$conn->query($callState);

foreach ($data as $row){
	echo $row['FName'];
	echo "|";
	echo $row['ID'];
	$names= explode(" ", $row['FName']);
	echo $names[0];
	echo "|";
	if ( count($names)>1)
	{
		echo $names[1];
		echo "|";
		$SqlStatment ="	UPDATE record_of_request2 SET FName='" . $names[0] . "' , SName= '". $names[1] ."' WHERE ID= ". $row['ID'] . ";";
		echo $SqlStatment;
		$conn->query($SQLStatment);
	}
}
$conn->close();
?>