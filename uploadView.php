<script>

var tagval = [];
    document.getElementById("tags").addEventListener("focusout", mFunction);
    
    function mFunction() {
    document.getElementById("tags").value=tagval;
}


function myFunction(event) {
    var x = event.keyCode;               // Get the Unicode value
    tags = document.getElementById("tags");

    
    if(x==13 && tags.value!='' && tags.value!=' ' ){
    document.getElementById("taglist").innerHTML=document.getElementById("taglist").innerHTML+'<div class="chip closebtn">'+tags.value+
    
    '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>'
    
    +'</div>';
    tagval.push(tags.value);    
    
  tags.value = "";
    }
}
</script>
<h2 class="col-sm-offset-5 col-sm-12">Upload File</h2>

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
	<label class="radio-inline"><input type="radio" value="link" name="ftype" required>Link</label>
</div>

<div class="form-group">
	<label class="control-label">Select File</label>
	<input type="file" class="file" name="file">
</div>

<div class="form-group">        
      <div class="col-sm-offset-5" style="padding-left: 50px;">
        <button type="submit" class="btn btn-default">Upload</button>
      </div>
    </div>
</form>