<?php

include 'dbconfig.php';

session_start();

$email = $_SESSION['email'];
$fname = $_GET['fname'];
$furl = $_GET['furl'];

$collection = $db->folders;
mkdir($furl);
$collection->insert(array("fname"=>$fname,"furl"=>$furl,"email"=>$email));


?>