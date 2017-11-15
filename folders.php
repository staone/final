<?php 


include 'dbconfig.php';
session_start();

$email = $_SESSION['email'];
$dir = "users/".$email."/folders";

$collection = $db->folders;
$cursor = null;

echo '
<script type="text/javascript">

$("#delete").click(function(){
      id = $(this).data("id");
      furl = $(this).data("furl");
      $.get("deletefolder.php?id="+id+"&furl="+furl);
      $(".container").load("folders.php");
     });


     $("#deletefile").click(function(){
      id = $("#deletefile").data("id");
      furl = $("#deletefile").data("furl");
      $.get("delete.php?id="+id+"&furl="+furl);
      $(".container").load("folders.php");
     });


  $("#searchfolders").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("folders.php?key="+$(this).val());  
    }    
  
  });



  $("#searchfiles").keypress(function(e){
    
    if ($(this).val().length>=3 && (e.which == 13)) {
      $(".container").load("folders.php?file="+$(this).val());  
    }    
    
  });


 $("#addfolder").click(function(){
    
    foldername = $("#fname").val();
    path = "'.$dir."/".'"+foldername;
    $.get("addfolder.php?fname="+foldername+"&furl="+path);      
    window.location = "http://localhost:8012/MoodSync3";
    
  });

  function folderview(folder)
  {
  	folderurl = $(folder).data("furl");
  	alert(folderurl);
  	$(".container").load("folders.php?folder="+folderurl);
  }


  ///////////////////////////////Upload File////////////////////////////////////////////

var tagval = [];
    document.getElementById("tags").addEventListener("focusout", mFunction);
    
    function mFunction() {
    document.getElementById("tags").value=tagval;
}


function myFunction(event) {
    var x = event.keyCode;               // Get the Unicode value
    tags = document.getElementById("tags");

    
    if(x==13 && tags.value!="" && tags.value!=" " ){
    document.getElementById("taglist").innerHTML=document.getElementById("taglist").innerHTML+"<div class='."'".'chip closebtn'."'".'>"+tags.value+"<span class='."'".'closebtn'."'".' onclick='."'".'this.parentElement.style.display='."'".'none'."'".''."'".'>&times;</span>"+"</div>";
    tagval.push(tags.value);    
    
  tags.value = "";
    }
}




</script>  

<input type="text" class="form-control" id="searchfolders" placeholder="Search folders...">
<br><br><br>

<input type="text" class="form-control" id="searchfiles" placeholder="Search files...">
<br><br><br>

<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add Folder</button>
<br><br><br>

<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">Add File</button>
<br><br><br>


<table class="table">
        <thead>
          <tr>
              ';if (isset($_GET['folder'])) {
                echo "<th>File Name</th><th>Type</th>";
              }

              else
              {
                echo "<th>Folder Name</th>";
              }
              echo
              '
              <th>Delete</th>
          </tr>
        </thead>

        <tbody>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close" class="close" onclick="pause_video()" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Folder</h4>
        </div>
        <div class="modal-body">
        	
        	<br><br><br>
			<input type="text" class="form-control" id="fname" placeholder="Enter folder name...">
			
			<br><br><br>

			<button type="button" data-dismiss="modal" id="addfolder" class="btn btn-primary btn-block">Add Folder</button>
        </div>
      </div>
    </div>
  </div>
        


  <div class="modal fade" id="upload" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close" class="close" onclick="pause_video()" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add File</h4>
        </div>
        <div class="modal-body">
          
          <br><br><br>

          <form action="upload.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">File Name:</label>
    <input type="text" class="form-control" name="fname">
  </div>

  <div class="form-group">
    <label for="tags">Tags:</label>
  <input type="text" class="form-control" onkeypress="myFunction(event)" id="tags" name="tag" required>
  <br><br>
  <div id="taglist"></div>
  </div>

<div class="form-group">
  <label class="radio-inline"><input type="radio" value="image" name="ftype" required>Image</label>
  <label class="radio-inline"><input type="radio" value="video" name="ftype" required>Video</label>
  <label class="radio-inline"><input type="radio" value="audio" name="ftype" required>Audio</label>
  <label class="radio-inline"><input type="radio" value="docs" name="ftype" required>Document</label>
  
</div>

<div class="form-group">
  <label class="control-label">Select File</label>
  <input type="file" class="file" name="file">
</div>

<div class="form-group">        
      <div class="col-sm-offset-5" style="padding-left: 50px;">
        <button type="submit" data-dismiss="modal" class="btn btn-default">Upload</button>
      </div>
    </div>
</form>
        </div>
      </div>
    </div>
  </div>';


///////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['key'])) 
{
  $key = $_GET['key'];
  $regex = new MongoRegex("/".$key."/");
  $cursor= $collection->find(array("email" => $email,"fname" => $regex));
  displayFolders($cursor);
}

else if (isset($_GET['file'])) 
{
	$collectionfiles = $db->files;
	$file = $_GET['file'];
  $regex = new MongoRegex("/".$file."/");
  $cursor = $collectionfiles->find(array("email" => $email,"tags" => $regex));	
  searchfiles($cursor);
}

else if (isset($_GET['folder'])) {

	$collectionfolder = $db->files;
	$folder = $_GET['folder'];
	$cursor = $collectionfolder->find(array("email" => $email,"furl" => $folder));
  displayFiles($cursor);
}

else
{
  $cursor = $collection->find(array("email" => $email));
  displayFolders($cursor);
}

//////////////////////////////////////////////////////////////////////////////////////////        
function displayFiles($cursor)
{
   	foreach ($cursor as $document) {
  
      echo '

     
          <tr>
            <td><a href="javascript:void(0)" data-furl="'.$document['furl'].'">'.$document['filename'].' </a></td>

            <td><a href="javascript:void(0)">'.$document['ftype'].' </a></td>
            <td><a href="javascript:void(0)" id="deletefile" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

        ';

	}   
}

/////////////////////////////////////////////////////////////////////////////////////////

function searchfiles($cursor)
{

  foreach ($cursor as $document) {
  


        echo '

     
          <tr>
            <td><a href="javascript:void(0)" onclick="folderview(this)" data-furl="'.$document['furl'].'">'.$document['filename'].' </a></td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

        ';

  }   

}

//////////////////////////////////////////////////////////////////////////////////////////
function displayFolders($cursor)
{
	foreach ($cursor as $document) {
  


        echo '

     
          <tr>
            <td><a href="javascript:void(0)" onclick="folderview(this)" data-furl="'.$document['furl'].'">'.$document['fname'].' </a></td>
            <td><a href="javascript:void(0)" id="delete" data-id="'.$document['_id'].'" data-furl="'.$document['furl'].'"><i class="material-icons">delete</i></a></td>
          </tr>
       

        ';

	}   
}


/////////////////////////////////////////////////////////////////////////////////////////
echo ' </tbody>
      </table>';


?>