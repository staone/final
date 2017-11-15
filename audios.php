<?php  

session_start();

$email = $_SESSION['email'];
include 'dbconfig.php';


$collection = $db->files;

if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $regex = new MongoRegex("/".$key."/");
  $cursor = $collection->find(array("email" => $email,"ftype"=>"audio","tags" => $regex));
}

else
{

  $cursor = $collection->find(array("email" => $email,"ftype"=>"audio"));
}

//$dir = "users/".$email."/audios";

echo '
<script type="text/javascript">

$("#delete").click(function(){
      id = $("#delete").data("id");
      furl = $("#delete").data("furl");
      $.get("delete.php?id="+id+"&furl="+furl);
      $(".container").load("audios.php");
     });

var mp3 = new Audio();
function play_audio(audio)
{
	furl = audio.getAttribute("data-furl");
	mp3.src = furl;
	mp3.play();
}

  $("#search").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("audios.php?key="+$(this).val());  
    }    
    
  });

</script>  

<input type="text" class="form-control" id="search" placeholder="Search audios...">
<br><br><br>

<table class="table">
        <thead>
          <tr>
              <th>File Name</th>
              <th>Type</th>
              <th>Play</th>
              <th>Delete</th>
          </tr>
        </thead>

        <tbody>';

foreach ($cursor as $document) {
  


        echo '

     
          <tr>
            <td><a href="javascript:void(0)">'.$document['filename'].'</a></td>
            <td>'.$document['ftype'].'</td>
            <td><a href="javascript:void(0)" onclick="play_audio(this)" data-furl="'.$document['furl'].'"><i class="material-icons">play_circle_filled</i></a></td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

        ';

}   
echo ' </tbody>
      </table>';
?>