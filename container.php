<div class="container">


<?php 

  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];  
  
  
    include 'dbconfig.php';

    $collection = $db->files;
    $collectionf = $db->folders;

    $audios = $collection->find(array("email"=>$email,"ftype"=>"audio"))->count();
    $videos = $collection->find(array("email"=>$email,"ftype"=>"video"))->count();
    $docs = $collection->find(array("email"=>$email,"ftype"=>"docs"))->count();
    $images = $collection->find(array("email"=>$email,"ftype"=>"image"))->count();
    $links = $collection->find(array("email"=>$email,"ftype"=>"link"))->count();
    $folders = $collectionf->find(array("email"=>$email))->count();
  }
	if (isset($_SESSION['uname'])) 
	{
		echo '


    <input type="text" class="form-control" id="search" placeholder="Search anything...">
    <br><br><br>
    <div id="searchResults">
    <table class="table">
        <thead>
          <tr>
              <th>File Name</th>
              <th>Type</th>
          </tr>
        </thead>

        <tbody>
    </div>
			<div class="row text-center">
 <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/folders.png">
      <p><strong>Folders</strong></p>
      <p>Folders : '.$folders.'</p>
      <button class="btn" id="folder">Open</button>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/videos.png">
      <p><strong>Videos</strong></p>
      <p>Files : '.$videos.'</p>
      <button class="btn" id="folderv">Open</button>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/audios.png">
      <p><strong>Audios</strong></p>
      <p>Files : '.$audios.'</p>
      <button class="btn" id="foldera">Open</button>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/images.png">
      <p><strong>Images</strong></p>
      <p>Files : '.$images.'</p>
      <button class="btn" id="folderi">Open</button>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/docs.png">
      <p><strong>Docs</strong></p>
      <p>Files : '.$docs.'</p>
      <button class="btn" id="folderd">Open</button>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="thumbnail">
      <img src="images/links.png">
      <p><strong>Links</strong></p>
      <p>Links : '.$links.'</p>
      <button class="btn" id="folderl">Open</button>
    </div>
  </div>
</div>


<script type="text/javascript">
  var files;
  $("#search").keyup(function(){
    
    $.ajax({
    type: "GET",
    url: "search.php",
    data:"key="+$(this).val(),
    success: function(data){
      
      files = data;
        
    }
    });
    alert(files);
  });

</script>

		';
	}

	else
	{
		include 'loginView.php'; 
	}

?>
</div>