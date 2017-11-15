<?php  

$uname = $_POST['uname'];
$password = $_POST['pass']; 
$email = $_POST['email'];
$gender = $_POST['gender'];
$mno = $_POST['mno'];

include 'dbconfig.php';



$collection = $db->users;
      $document = array( 
      "uname" => $uname, 
      "password" => $password, 
      "email" => $email,
      "gender" => $gender,
      "mno" => $mno,
   );
   

   try {  

   	$collection->insert($document);
}
catch (MongoCursorException $e) {
    
         header("location:http://localhost:8012/MoodSync3");
         break;
}
 

   session_start();
   $_SESSION['email'] = $email;
   $_SESSION['uname'] = $uname;
   
///////////////////////////////////////////////////////////////////

      
      
      	mkdir("users/".$email);
        mkdir("users/".$email."/folders");
      	mkdir("users/".$email."/"."audios");
        mkdir("users/".$email."/"."images");
      	mkdir("users/".$email."/"."videos");
      	mkdir("users/".$email."/"."docs");
 	    	header("location:http://localhost:8012/MoodSync3");       
      
        
  

//////////////////////////////////////////////////////////////////
  // header('Location: http://localhost:8012/MoodSync3');
   
?>

