<?php include ('connection.php ');
error_reporting(0); 
$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st, status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' order by status.final desc limit 20";

  $data = mysqli_query($conn, $query1);
  $records = mysqli_num_rows($data);
      
  $area = "SELECT DISTINCT * FROM area";
  $data1 = mysqli_query($conn , $area);
?>
<div class="container-fluid">
    <img src="icon/logo.png"style="position: relative; top: 11px; left: 20px">
</div>
<!-- end of container fluid -->
 
 <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position: relative; top: 20px">
  <strong>
    <?php 
      echo '<h5> You are logged in as '.  $_SESSION['name'] . ' !</h5>';
    ?>
  </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



<hr>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
       
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">hello</span>
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
          Area
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="insertArea.php">Insert</a>
          <a class="dropdown-item" href="showArea.php">Display</a>
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
          <!-- <a class="dropdown-item" href="insertThesis.php">Insert</a> --> <!-- this is not necessary already done in student insert -->
          <a class="dropdown-item" href="showWrites.php">Display</a>
        </div>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Status
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item" href="insertStatus.php">Insert</a>  --><!--  this is not necessary, already done in student insert-->
          <a class="dropdown-item" href="statusbyBatch.php">Display</a>
        </div>
      </li>
      <li class="nav nav-item">
        <a href="searchCompletedBy.php" class="btn btn-link">User Home</a>
      </li> 
      <li class="nav nav-item">
        <a href="uploadcsv.php" class="btn btn-link">Upload CSV</a>
      </li>
      <!-- <li class="nav nav-item">
        <a href="uploadsql.php" class="btn btn-link">Upload SQL</a>
      </li> -->
      <li class="nav nav-item">
        <a href="deleteAll.php" class="btn btn-link">Drop tables</a>
      </li> 
      <li class="nav nav-item">
        <a href="logout.php" class="btn btn-link">logout</a>
      </li> 
  </div>
</nav>
<style type="text/css">
  li a:hover{
    color:#2c0333;
  }

</style>
