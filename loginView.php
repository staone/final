<h2 class="col-sm-offset-6 col-sm-12">Login</h2>
  <form class="form-horizontal" action="http://localhost:8012/MoodSync3/login.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="password" placeholder="Enter password">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-6 col-sm-12">
        <button type="submit" class="btn btn-default">Login</button>
      </div>
    </div>
  </form>
<p class="col-sm-offset-6 col-sm-12">OR</p>
  <div class="form-group">        
      <div class="col-sm-offset-6 col-sm-12">
        <button type="button" class="btn btn-default" id="signupView">Signup</button>
      </div>
    </div>