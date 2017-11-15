<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="javascript:void(0)">MyBook</a>
    </div>
    <?php 
    session_start();
      if (isset($_SESSION['uname'])) {
        echo '
        <ul class="nav navbar-nav navbar-right">
      <li><a href="javascript:void(0)" id="home">Home</a></li>
      <li><a href="javascript:void(0)" id="follow">Follow</a></li>
      <li><a href="javascript:void(0)" id="uploadView">Upload</a></li>
      <li><a href="javascript:void(0)">'.$_SESSION['uname'].'</a></li>
      <li><a href="javascript:void(0)" id="logout">Logout</a></li>
    </ul>';
      }

    ?>
    
  </div>
</nav>