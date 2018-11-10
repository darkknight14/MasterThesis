<?php

  session_start();

  // check to see if the user is logged in
  if ($_SESSION['loggedin']) 
  {

      include('header.php');
      include('nav.php');

      include('connection.php');

      $query = "SELECT DISTINCT batch FROM student";
      $data = mysqli_query($conn , $query);

      $records = mysqli_num_rows($data);
     
      if ($records != 0) {
        ?>
         <nav class="col d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav nav-tabs">
                  <li><h4 class="lead" style="padding: 7px;">Status Batch-></h4></li>
                  <?php 
                    while($fetch = mysqli_fetch_assoc($data)){
              $temp = $fetch['batch'];
            ?>
                  <li class="nav-item">
                    <a class="nav-link " href="updateStatusbyBatch.php?batch=<?php echo $temp ?>">
                      <span data-feather="home"></span>
                      <?php echo $temp;?> 
                      <span class="sr-only">(current)</span>
                    </a>
                  </li>
                    <?php 
                  }
                    ?>
              </div>
            </nav>
    <?php 
      }
      else{
         echo'<div class="alert alert-light container lead"><h3 class="h3" >Batch <h3></div>';
         echo "<div class='alert alert-info' style='margin-top:30px;'>No record has been found.</div>";
      }
        
  
  } 
else 
{
  // user is not logged in, send the user to the login page

  echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
  header('Location: adminIOE.html');
}

?>