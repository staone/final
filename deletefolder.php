<?php 

include 'dbconfig.php';
session_start();
$email = $_SESSION['email'];
$id = $_GET['id'];
$furl = $_GET['furl'];

$collection = $db->folders;
$collection->remove(array("email"=>$email , "_id"=> new MongoID($id)));

rmdir($furl);
?>