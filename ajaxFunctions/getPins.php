<?php
// get the q parameter from URL
session_start();
$servername = "localhost";
$username = "root";
$dbname = "";
$password = "";
$email = $_SESSION["email"];
//create connection to the database
 try
 {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//select all the pin information for this user.
	$sql = $conn->prepare("SELECT * FROM pin_table WHERE email = ?");
	$sql->execute([$email]);
	$fetch = $sql->fetchAll();
	$markers = array(); 
	foreach($fetch as $row)
	{		
		//build up a set of associative arrays that are representative of marker data
		$markerRow = array(
			"id" => (int)$row["id"],
			"title" => $row["title"],
			"address" => $row["address"],
			"lat" => (double)$row["lat"],
			"lng" => (double)$row["lng"],
			"description" => $row["description"],
			"isVisited" => (bool)$row["isVisited"],
			"timesVisited" => (int)$row["timesVisited"]
		);
		array_push($markers, $markerRow);
	}
	echo json_encode($markers);
}
catch(PDOException $e)
{
	echo "failz for DB";
}
?>
