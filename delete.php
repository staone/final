<?php 

$id = $_GET['id'];
$furl = $_GET['furl'];

include 'dbconfig.php';

$collection = $db->files;

$collection->remove(array("_id" => new MongoID($id)));

unlink($furl);

?>