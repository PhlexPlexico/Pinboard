<?php
// get the q parameter from URL
session_start();
$servername = "localhost";
$username = "root";
$dbname = "";
$password = "";
$email = $_SESSION["email"];

$title = $_POST["title"];
$address = $_POST["address"];
$lat = (double)$_POST["lat"];
$lng = (double)$_POST["lng"];
$desc = $_POST["description"];
$isVisited = $_POST["isVisited"];
$timesVisited = $_POST["timesVisited"];

//create connection to the database
try{
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$stmt = $conn->prepare("INSERT INTO pin_table (email, title, address, lat, lng, description, isVisited, timesVisited) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
//$stmt->execute([$email,$title,$address,$lat,$lng,$desc,$isVisited,$timesVisited]);
//select all the pin information for this user
if (empty($timesVisited))
{
	$timesVisited = 0;
}
$sql = "INSERT INTO pin_table (email, title, address, lat, lng, description, isVisited, timesVisited) VALUES ('".$email."', '".$title."', '".$address."', ".$lat.", ".$lng.", '".$desc."', ".$isVisited.", ".$timesVisited.");";
$result = $conn->query($sql);
echo $sql;
}
catch(PDOException $e)
{
	echo "xplosive failz " . $e;
}

?>
