<?php

	session_start();

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

			?>
			<form action="" method="POST" style="padding: 10px; margin: auto;" class="col-sm-8">
				  <div class="form-group">
				    <label>First Name*</label>
				    <input class="form-control" id="exampleInputEmail1" name="first_name" aria-describedby="emailHelp" placeholder="First Name" required>
				  </div>
				  <div class="form-group">
				    <label>Middle Name</label>
				    <input class="form-control" id="exampleInputEmail1" name="middle_name" aria-describedby="emailHelp" placeholder="Middle Name">
				  </div>
				  <div class="form-group">
				    <label>Last Name*</label>
				    <input class="form-control" id="exampleInputEmail1" name="last_name" aria-describedby="emailHelp" placeholder="Last Name">
				  </div>
				  <div class="form-group">
				    <label>Student Batch*</label>
				    <input class="form-control" id="exampleInputEmail1" name="stud_batch" aria-describedby="emailHelp" placeholder="Batch" required>
				  </div>
				  <div class="form-group">
				    <label>Student Program*</label>
				    <input class="form-control" id="exampleInputEmail1" name="stud_depart" aria-describedby="emailHelp" placeholder="Program" required>
				  </div>
				  <div class="form-group">
				    <label>Student RollNo*</label>
				    <input class="form-control" id="exampleInputEmail1" name="stud_rollno" aria-describedby="emailHelp" placeholder="Class RollNo" required>
				  </div>
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
				    <input class="form-control" id="exampleInputPassword1" name="title" placeholder="Title" required>
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
				  <div class="form-group">
				    <label>Midterm Date</label><br>	
				    <input type="date" id="midterm_date" name="midterm_date">
				  </div>
				  <div class="form-group">
				    <label>Final Date</label><br>	
				    <input type="date" id="midterm_date" name="final">
				  </div>
				
				  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
				</form>

				<?php 
				
					if($_POST['submit']){

						$first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$middle_name =  $_POST['middle_name'];
						$stud_batch = $_POST['stud_batch'];
						$stud_depart = $_POST['stud_depart'];
						$stud_rollno = $_POST['stud_rollno'];
						$midterm_date = $_POST['midterm_date'];
						$title = $_POST['title'];
						$final_date = $_POST['final'];
						$sup_id =  $_POST['sup_id'];

						$title = $_POST['title'];

						if(!($sup_id and $first_name and $last_name and $title and $stud_depart and $stud_depart and $stud_rollno))
							{
							echo "<script>alert('Please fill all the required fields.')</script>";
							}

						else{

							$student = "INSERT INTO student VALUES('$stud_batch', '$stud_depart','$stud_rollno', '$first_name', '$middle_name', '$last_name')";

							$insertstudent = mysqli_query($conn, $student);

							if($insertstudent){
								$query3 = "SELECT    *
								FROM      thesis
								ORDER BY  id DESC
								LIMIT     1";

							$lastrow = mysqli_query($conn , $query3);
							$fetch = mysqli_fetch_assoc($lastrow);
							$lastrow_id = $fetch['id']; 
							$thesis_id = $lastrow_id + 1 ;
							

							$query = "INSERT INTO thesis VALUES ('$thesis_id','$sup_id', '$title') ";

							$insertthesis = mysqli_query($conn, $query);

							$query2 = "INSERT INTO status VALUES ('$thesis_id','$midterm_date', '$final_date')";

							$insertstatus = mysqli_query($conn, $query2);

							$query4 = "SELECT    *
							FROM      student_writes_thesis
							ORDER BY  writes_id DESC
							LIMIT     1";

							$lastrow1 = mysqli_query($conn , $query4);
							$fetch1 = mysqli_fetch_assoc($lastrow1);
							$lastrow_id1 = $fetch1['writes_id']; 
							$writes_id1 = $lastrow_id1 + 1 ;

							$query1 = "INSERT INTO student_writes_thesis VALUES ('$writes_id1', '$stud_batch','$stud_depart','$stud_rollno','$thesis_id')" ;

							$insertwrites = mysqli_query($conn, $query1);

								if(!empty($_POST['checklist'])){
									foreach($_POST['checklist'] as $check){
										$newquery = "INSERT INTO thesis_has_area VALUES ('$thesis_id','$check')";
										$insertinarea = mysqli_query($conn, $newquery);
										
									}
								}
							}
			 
							 if ($insertthesis and $insertwrites and $insertstatus and $insertstudent) {
							 	echo "<script>alert('Data has been inserted');</script>	";
							 }
							else{
								echo "<script>alert('Data couldn't be inserted');</script>	";
							}
						}
					}
					mysqli_close($conn);
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		/*echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';*/
		header('Location: adminIOE.html');
	}
?>