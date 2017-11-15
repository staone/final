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
      $.get("delete.php?id="+id);
      $(".container").load("links.php");
     });

$("#search").keypress(function(e){
    
  if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("links.php?key="+$(this).val());  
  }    
    
});

</script>  

<input type="text" class="form-control" id="search" placeholder="Search links...">
<br><br><br>

<table class="table">
        <thead>
          <tr>
              <th>Link</th>
              <th>Delete</th>
          </tr>
        </thead>

        <tbody>';

foreach ($cursor as $document) {
  


    		echo '

     
          <tr>
            <td>'.$document['filename'].'</td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

    		';

}   
echo ' </tbody>
      </table>';
?>