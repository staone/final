$(document).ready(function() {
     
     $("#signup").click(function(){
        $(".container").load("signupView.php");
     });

     $("#logout").click(function(){

      $.get("logout.php");
      window.location = "http://localhost:8012/MoodSync3";
     });  
    

     $("#home").click(function(){
      window.location = "http://localhost:8012/MoodSync3";
     });

	$("#follow").click(function(){
      $(".container").load("follow_form.php");
     });

     $("#folder").click(function(){
      $(".container").load("folders.php");
     });

     $("#folderv").click(function(){
      $(".container").load("videos.php");
     }); 

     $("#folderi").click(function(){
      $(".container").load("images.php");
     });

     $("#foldera").click(function(){
      $(".container").load("audios.php");
     }); 

     $("#folderd").click(function(){
      $(".container").load("docs.php");
     }); 

     $("#folderl").click(function(){
      $(".container").load("links.php");
     }); 

     $("#signupView").click(function(){
      $(".container").load("signupView.php");
     });

     $("#uploadView").click(function(){
      $(".container").load("uploadView.php");
     });
     
     
});