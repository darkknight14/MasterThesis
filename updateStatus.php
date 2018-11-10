<?php

	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		

				include("header.php");
		include('nav.php');	
		include("connection.php");
		error_reporting(0);	

		$query = "SELECT * FROM thesis";
		$data = mysqli_query($conn, $query);
?>

<form action="" method="POST" style="padding: 10px; ">
	  <div class="form-group">
	    <label>Midterm Date*</label><br>	
	    <input type="date" id="midterm_date" name="midterm_date" value = "<?php echo $_GET['mdl_trm'];?>" required>
	  </div>
	  <div class="form-group">
	    <label>Final Date</label><br>
	    <input type="date" id="final_date" name="final_date" value = "<?php echo $_GET['fnl'];?>">
	  </div>
	  <input type="hidden" name="batch" value = "<?php echo $_GET['batch'];?>">
	  <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
</form>

<?php

		if($_POST['update']){

			$thesis_id = $_GET['thesis_id'];
			$batch = $_POST['batch'];
			$midterm_date = $_POST['midterm_date'];
			$final_date = $_POST['final_date'];

			$query = "UPDATE status SET mid_term = '$midterm_date', final = '$final_date' WHERE thesis_id = '$thesis_id' ";
			$data = mysqli_query($conn, $query);

			if($data){
				echo("<script>alert('Record Updated.')</script>") ;
				?>

				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/updateStatusbyBatch.php?batch=<?php echo $batch;?>">
				
				<?php
			}
			else{

				echo("<script>alert('Record Not updated.')</script>") ;

				?>
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showStatus.php">
				
			</META>
				<?php
			}

		}

		mysqli_close($conn);

	?>


</body>	
</html>



<?php 	
	} 
	else 
	{
		// user is not logged in, send the user to the login page

		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}
?>