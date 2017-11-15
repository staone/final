<?php 

session_start();
include 'dbconfig.php';

$email = $_SESSION['email'];
$fname = $_POST['fname'];
$ftype = $_POST['ftype'];
$tags = $_POST['tag'];
$fsize = $_FILES['file']['size']/1024;
$ftemp = $_FILES['file']['tmp_name'];


 if ($fname=="") {
   $fname = $_FILES['file']['name'];
 }

  if ($ftype=="image") {
   $furl = "users/".$email."/images/".$fname;
 }
if ($ftype=="video") {
   $furl = "users/".$email."/videos/".$fname;
 }
 if ($ftype=="docs") {
   $furl = "users/".$email."/docs/".$fname;
 }
 if ($ftype=="audio") {
   $furl = "users/".$email."/audios/".$fname;
 }

echo $ftype;
echo $furl;

$collection = $db->files;
      $document = array( 
      "filename" => pathinfo($fname)['filename'], 
      "tags" => $tags, 
      "email" => $email,
      "ftype" => $ftype,
      "furl" => $furl,
      "fsize" => $fsize,
   );
   

   try {  

   	$collection->insert($document);
}
catch (MongoCursorException $e) {
    
   //header("location:http://localhost:8012/MoodSync3");
         break;
}

echo $ftemp;
	move_uploaded_file($ftemp,$furl);
	//header("location:http://localhost:8012/MoodSync3");

?>