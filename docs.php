<?php  

session_start();

$email = $_SESSION['email'];
include 'dbconfig.php';


$collection = $db->files;

if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $regex = new MongoRegex("/".$key."/");
  $cursor = $collection->find(array("email" => $email,"ftype"=>"docs","tags" => $regex));
}

else
{

  $cursor = $collection->find(array("email" => $email,"ftype"=>"docs"));
}

//$dir = "users/".$email."/audios";

echo '
<script type="text/javascript">
$("#delete").click(function(){
      id = $("#delete").data("id");
      $.get("delete.php?id="+id);
      $(".container").load("docs.php");
     });

 $("#search").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("docs.php?key="+$(this).val());  
    }    
    
  });

</script>  

<input type="text" class="form-control" id="search" placeholder="Search docs...">
<br><br><br>

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
            <td><a href="'.$document['furl'].'">'.$document['filename'].'</a></td>
            <td>'.$document['ftype'].'</td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

    		';

}   
echo ' </tbody>
      </table>';
?>