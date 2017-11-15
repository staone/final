<?php 

session_start();
unset($_SESSION["uname"]);
unset($_SESSION["email"]);

header('location:http://localhost:8012/MoodSync3');

 ?>