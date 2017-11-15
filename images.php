<?php  

session_start();

$email = $_SESSION['email'];
include 'dbconfig.php';


$collection = $db->files;

if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $regex = new MongoRegex("/".$key."/");
  $cursor = $collection->find(array("email" => $email,"ftype"=>"image","tags" => $regex));
}

else
{

  $cursor = $collection->find(array("email" => $email,"ftype"=>"image"));
}
//$dir = "users/".$email."/audios";

echo '
<script type="text/javascript">
$("#delete").click(function(){
      id = $("#delete").data("id");
      furl = $("#delete").data("furl");
      $.get("delete.php?id="+id+"&furl="+furl);
      $(".container").load("images.php");
     });

function show_image(imgurl,imgname)
{
  header = document.getElementsByTagName("h4");
  header[0].innerHTML = imgname;
  imageView = document.getElementById("imageView");
  imageView.src = imgurl;
}


$("#search").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("images.php?key="+$(this).val());  
    }    
    
  });

</script> 

<input type="text" class="form-control" id="search" placeholder="Search images...">
<br><br><br>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <img src="" id="imageView" width="870">
        </div>
      </div>
    </div>
  </div> 
<table class="table">
        <thead>
          <tr>
              <th>File Name</th>
              <th>Type</th>
              <th>Delete</th>
          </tr>
        </thead>

        <tbody>';

foreach ($cursor as $document) {
  


    		echo '

     
          <tr>
            <td><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="show_image('."'".$document['furl']."','".$document['filename']."'".')">'.$document['filename'].'</a></td>
            <td>'.$document['ftype'].'</td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

    		';

}   
echo ' </tbody>
      </table>';
?>