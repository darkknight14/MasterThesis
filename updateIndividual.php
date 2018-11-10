<?php
	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
		include("header.php");
		include("nav.php");
		include("connection.php");
		
		error_reporting(0);	

		$supervisor = "SELECT * FROM supervisor";
		$data = mysqli_query($conn, $supervisor);

		$area = "SELECT * FROM area";
		$data1 = mysqli_query($conn , $area);

		$hthesis_id = $_GET['id'];
		$hthesis = "SELECT * from thesis
					WHERE id = '$hthesis_id' ";

		$data2 = mysqli_query($conn, $hthesis);
		$fetch = mysqli_fetch_assoc($data2);
		
		$myvar= $fetch['title'];

?>

<form action="" method="POST" style="padding: 10px; margin: auto;" class="col-sm-8">
	  <div class="form-group">
	    <label>First Name</label>
	    <input class="form-control" id="exampleInputEmail1" name="first_name" aria-describedby="emailHelp" placeholder="First Name" value = "<?php echo $_GET['fn'];?>" required>
	  </div>
	  <div class="form-group">
	    <label>Middle Name</label>
	    <input class="form-control" id="exampleInputEmail1" name="middle_name" aria-describedby="emailHelp" value = "<?php echo $_GET['mn'];?>" placeholder="Middle Name">
	  </div>
	  <div class="form-group">
	    <label>Last Name</label>
	    <input class="form-control" id="exampleInputEmail1" name="last_name" aria-describedby="emailHelp" value = "<?php echo $_GET['ln'];?>" placeholder="Last Name">
	  </div>
	  <input type="hidden" name="stud_batch" value="<?php echo $_GET['sb'];?>"> 
	  <input type="hidden" name="stud_depart" value="<?php echo $_GET['sd'];?>"> 
	  <input type="hidden" name="stud_rollno" value="<?php echo $_GET['sr'];?>"> 
	  <input type="hidden" name="mythesis_id" value="<?php echo $_GET['id'];?>"> 
	   <div class="form-group">
	  	<label>Supervisor Name*</label>
		  <select class="form-control" name="sup_id">
		  	<?php 
		  	while($fetch = mysqli_fetch_assoc($data)){
		  		$temp = $fetch['title'].' '.$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name']; 
		  		$id = $fetch['id']; ?>
		  		<option value="<?php echo $id ?>"><?php echo $temp ?></option>
		  	<?php
		  		}
		  	?>
		  </select>  
	  </div>
	  <div class="form-group">
	   <label>Title*</label>
	    <input class="form-control" id="exampleInputPassword1" name="mytitle" placeholder="Title" value="<?php echo $myvar ?>" required>
	  </div>
	  <label>Select Project Area*</label>
	  <div class="form-check">
	  	<?php
	  	while($fetch = mysqli_fetch_assoc($data1)){

	  			$name = $fetch['name'];
	  			$id = $fetch['id'];
	  		?>
	  		 <input class="form-check-input" name="checklist[]" type="checkbox" value="<?php echo $id ?>" id="defaultCheck1">
	  		<label class="form-check-label" for="defaultCheck1">
	    		<?php echo $name ?>
	    	</label>
	    	<br>

	    <?php
	  	}
	 	?>
	 </div><br>
	
	  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
	</form>

	<?php 
	
			if($_POST['submit']){

			$id1 = $_POST['mythesis_id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$middle_name =  $_POST['middle_name'];
			$stud_batch = $_POST['stud_batch'];
			$stud_depart = $_POST['stud_depart'];
			$stud_rollno = $_POST['stud_rollno'];
			$title = $_POST['mytitle'];
			$sup_id =  $_POST['sup_id'];


			if(!($sup_id and $first_name and $last_name and $title and $stud_depart and $stud_depart and $stud_rollno))
				{
				echo "<script>alert('Please fill all the required fields.')</script>";
				}

			else{

				$student = "UPDATE student SET first_name='$first_name',middle_name='$middle_name', last_name='$last_name' WHERE batch = '$stud_batch' and department = '$stud_depart' and class_rollno = '$stud_rollno' ";

				$insertstudent = mysqli_query($conn, $student);

				$thesisupdatequery = "UPDATE thesis set sup_id = '$sup_id', title='$title' WHERE id = '$id1' "; 

				$executeupdate = mysqli_query($conn, $thesisupdatequery); 
				
				$deletearea = "DELETE FROM thesis_has_area WHERE thesis_id = '$id1' ";

				$executedelete = mysqli_query($conn, $deletearea);

				if(!empty($_POST['checklist'])){
						foreach($_POST['checklist'] as $check){
							$newquery = "INSERT INTO thesis_has_area VALUES ('$id1','$check')";
							$insertinarea = mysqli_query($conn, $newquery);
							
						}
					}
				 
				 if ($insertstudent and $executeupdate) {
				 	echo "<script>alert('Data has been updated.');</script>	";
				 	
				 	?>

					<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/updateStudent.php">

					<?php

				 }
				else{
					echo "<script>alert('Data couldn't be updated.');</script>	";
				}
			}
		}
		mysqli_close($conn);
	
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}
?>