<?php 
  session_start();
  error_reporting(0);

  // check to see if the user is logged in
  if ($_SESSION['loggedin']) 
  {
    
        include('header.php');
        error_reporting(0); 
        ?>  
        <div>
            <img src="icon/logo.png" style="position: relative; top: 11px; left: 20px">
        </div>
        <hr>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Supervisor
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="insertSupervisor.php">Insert</a>
                  <a class="dropdown-item" href="showSupervisor.php">Display</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Student
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="insertStudent.php">Insert</a>
                  <a class="dropdown-item" href="updateStudent.php">Display</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Thesis
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="showWrites.php">Display</a>
                </div>
              </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Area
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="insertArea.php">Insert</a>
                  <a class="dropdown-item" href="showArea.php">Display</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Status
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="statusbyBatch.php">Display</a>
                </div>
              </li>
              <li class="nav nav-item">
                <a href="searchCompletedBy.php" class="btn btn-link">User Home</a>
              </li> 
              <li class="nav nav-item">
                <a href="uploadcsv.php" class="btn btn-link">Upload CSV</a>
              </li> 
          </div>
        </nav>
        <div style="padding-top: 20px;">

        <form enctype="multipart/form-data" method="POST" role="form" action="handlecsv.php">
          <div class="form-group">

            <div class="alert alert-warning" role="alert">
              Upload CSV
            </div>
           
            <input type="file" class="form-control-file" id="file" name="file" required> 
            <button type="submit" class="btn btn-primary" style="margin: 2px;  " name="submit" value="submit">Upload</button>
             
          </div>
        </form>
        </div>

<?php 
} 
  else 
  {
    // user is not logged in, send the user to the login page

    echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
    header('Location: adminIOE.html');
  }
?>