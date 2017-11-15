<?php 

session_start();

$email = $_SESSION['email'];
$key=$_GET['key'];
$regex = new MongoRegex("/".$key."/");
include("dbconfig.php");
$array = array();

if (strlen($key) >= 3) 
{
	
	$collection = $db->files;

	$cursor = $collection->find(array("email" => $email,"tags" => $regex));

	foreach ($cursor as $document) 
	{
		 $array[] = $document["filename"]."	".$document["furl"]."	".$document['ftype'];
	}
	
	echo json_encode($array);   
}
?>