<h2 class="col-sm-offset-6 col-sm-12">Signup</h2>
  <form class="form-horizontal" action="signup.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="uname" placeholder="Enter Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="pass" placeholder="Enter password">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Mobile No:</label>
      <div class="col-sm-10">          
        <input type="" class="form-control" name="mno" placeholder="Enter contact no">
      </div>
    </div>
    <!-- /////////////////////////////////////////////// -->

<div class="form-group">
      <label class="control-label col-sm-2" for="email">Gender:</label>
      <div class="col-sm-10">
      <label class="radio-inline"><input type="radio" name="gender" value="M">Male</label>
      <label class="radio-inline"><input type="radio" name="gender" value="F">Female</label>
      </div>
    </div>


    <div class="form-group">        
      <div class="col-sm-offset-6 col-sm-12">
        <button type="submit" class="btn btn-default">Signup</button>
      </div>
    </div>
  </form>