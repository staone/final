<?php  

session_start();

$email = $_SESSION['email'];
include 'dbconfig.php';


$collection = $db->files;

if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $regex = new MongoRegex("/".$key."/");
  $cursor = $collection->find(array("email" => $email,"ftype"=>"video","tags" => $regex));
}

else
{

  $cursor = $collection->find(array("email" => $email,"ftype"=>"video"));
}
//$dir = "users/".$email."/audios";

echo '
<script type="text/javascript">
$("#delete").click(function(){
      id = $("#delete").data("id");
      furl = $("#delete").data("furl");
      $.get("delete.php?id="+id+"&furl="+furl);
      $(".container").load("videos.php");
     });

var videoplayer = document.getElementById("videoplayer");
function play_video(video,fname)
{
  var header = document.getElementsByTagName("h4");
  vurl = video.getAttribute("data-furl");
  header[0].innerHTML = fname;
  videoplayer.src = vurl;
  videoplayer.play();
}

function pause_video()
{
  videoplayer.pause();
}

$("#search").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("videos.php?key="+$(this).val());  
    }    
    
  });

</script>

<input type="text" class="form-control" id="search" placeholder="Search videos...">
<br><br><br>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close" class="close" onclick="pause_video()" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <video id="videoplayer" width="870" controls>
            <source src="" type="video/mp4">    
            Your browser does not support HTML5 video.
          </video>
        </div>
      </div>
    </div>
  </div>
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
            <td><a href="javascript:void(0)" id="play">'.$document['filename'].'</a></td>
            <td>'.$document['ftype'].'</td>
            <td><a href="javascript:void(0)" data-toggle="modal" onclick="play_video(this,'."'".$document['filename']."'".')" data-target="#myModal" data-furl="'.$document['furl'].'"><i class="material-icons">play_circle_filled</i></a></td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

        ';

}   
echo ' </tbody>
      </table>';
?>