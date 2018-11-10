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

		$query = "SELECT * FROM student";
		$data = mysqli_query($conn, $query);
		$writes_id = $_GET['writes_id'];
?>

<form action="" method="POST" style="padding: 10px; ">
	  <div class="form-group">
	  	<label>Class RollNo*</label>
		  <select class="form-control" name="class_rollno">
		  	<?php 
		  	while($fetch = mysqli_fetch_assoc($data)){
		  		$temp = $fetch['batch'].$fetch['department'].$fetch['class_rollno']; ?>
		  		<option value="<?php echo $temp ?>"><?php echo $temp ?></option>
		  	<?php
		  		}
		  	?>
		  </select>  
	  </div> 
	  <input type="hidden" name="writes_id" value="<?php echo $_GET['writes_id']?>">
	  <input type="hidden" name="thesis_id" value="<?php echo $_GET['thesis_id']?>">
	  <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>

<?php

		if($_POST['update']){
			//die($_POST['writes_id']);
			$postvalue = $_POST['class_rollno'];
			$class_rollno = substr($postvalue, 0,3);
			$stud_batch = substr($postvalue, 3,3);
			$stud_depart = substr($postvalue,6,3 );
			
			$writes_id = $_POST['writes_id'];
			$thesis_id = $_POST['thesis_id'];

			$query = "DELETE FROM writen WHERE writes_id = '$writes_id'";

			$data = mysqli_query($conn, $query);

	
			$insertquery = "INSERT INTO writen VALUES ('$writes_id','$stud_batch','$stud_depart','$class_rollno','$thesis_id')" ;

			$inserted = mysqli_query($conn, $insertquery);

			if($inserted){
				echo("<script>alert('Record Updated.')</script>") ;
				?>

				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showWrites.php">
				
				<?php
			}
			else{

				echo("<script>alert('Record Not updated.')</script>") ;

				?>
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showWrites.php">
				
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





	