<?php

	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
			include("header.php");
			include("nav.php");

			?>
				<form action="" method="POST" style="padding: 10px; margin: auto;" class="col-sm-8">
				  <div class="form-group">
				    <label>Title</label>
				    <input class="form-control" id="exampleInputPassword1" name="title" placeholder="Title" required>
				  </div>
				  <div class="form-group">
				    <label>First Name*</label>
				    <input class="form-control" id="exampleInputPassword1" name="first_name" placeholder="First Name" required>
				  </div>
				  <div class="form-group">
				    <label>Middle Name</label>
				    <input class="form-control" id="exampleInputPassword1" name="middle_name" placeholder="Middle Name">
				  </div>
				  <div class="form-group">
				    <label>Last Name*</label>
				    <input class="form-control" id="exampleInputPassword1" name="last_name" placeholder="Last Name" required>
				  </div>
				  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
				</form>
				<?php

					error_reporting(0);
					include("connection.php");

					if($_POST['submit']){
						$title =  $_POST['title'];
						$first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$middle_name = $_POST['middle_name'];

						if(!($first_name and $last_name))
							{
							echo ("<script>alert('Please fill all the required fields.')</script>");
							}

						else{
							$query = "INSERT INTO supervisor VALUES ('$id','$title', '$first_name', '$middle_name','$last_name') ";

							 $insert = mysqli_query($conn, $query);



							 if ($insert) {
							 	echo ("<script>alert('Record Inserted.')</script>") ;
							 	?>

							<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">
							
							<?php
							 }
							else{
								echo ("<script>alert('Insertion couldn't be made.')</script>") ;
								?>
							<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/insertSupervisor.php">

							<?php
							}
						}
					}
					mysqli_close($conn);

				?>


			</body>	
			</html>
				
				<?php } 
	else 
	{
		// user is not logged in, send the user to the login page
		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}
?>


