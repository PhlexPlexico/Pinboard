<?php
// get the q parameter from URL
session_start();
$servername = "localhost";
$username = "root";
$dbname = "";
$password = "";
$id =(int)$_POST["id"];
$title = $_POST["title"];
$desc = $_POST["description"];
$isVisited = $_POST["isVisited"];
$timesVisited = (int)$_POST["timesVisited"];
//echo "Title: " . $title . " Desc: " . $desc . " Visited: " . $Is . " Times: " . $timesVisited . " ID: " . $id ."";
//create connection to the database
try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$stmt = $conn->prepare("UPDATE pin_table SET title=?, description=?, isVisited=?, timesVisited=? WHERE id=?");
	$ti = ifEmptySetNull($title);
	$de = ifEmptySetNull($desc);
	$Is = $isVisited;

	//$stmt->execute(array($title,$desc,$Is,$timesVisited,$id));
	$sql = "UPDATE pin_table SET title='".$title."', description='" .$desc. "', isVisited=" .$Is. ", timesVisited=" .$timesVisited. " WHERE id=" .$id. ";";
	$result = $conn->query($sql);
	echo $sql;
}
catch(PDOException $e)
{
	echo "xplosive failz" . $e;
}
function ifEmptySetNull($data)
{
	if(empty($data))
	{
		return NULL;
	}
	else
	{
		return $data;
	}
}