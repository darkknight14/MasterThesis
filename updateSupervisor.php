<?php
	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
	

		include('header.php');
		include('nav.php');

		?>
			<form action="" method="POST" style="padding: 10px; ">
			  <div class="form-group">
			    <label>Title</label>
			    <input class="form-control" id="exampleInputPassword1" name="title" placeholder="Title" value = "<?php echo $_GET['ttl'];?>">
			  </div>
			  <div class="form-group">
			    <label>First Name*</label>
			    <input class="form-control" id="exampleInputPassword1" name="first_name" placeholder="First Name" value = "<?php echo $_GET['fn'];?>" required>
			  </div>
			  <div class="form-group">
			    <label>Middle Name</label>
			    <input class="form-control" id="exampleInputPassword1" name="middle_name" placeholder="Middle Name" value = "<?php echo $_GET['mn'];?>">
			  </div>
			  <div class="form-group">
			    <label>Last Name*</label>
			    <input class="form-control" id="exampleInputPassword1" name="last_name" placeholder="Last Name" value = "<?php echo $_GET['ln'];?>" required>
			  </div>
			  <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
			</form>
			<?php
					include("connection.php");
					error_reporting(0);

				if($_POST['update']){

					$title = $_POST['title'];
					$first_name = $_POST['first_name'];
					$middle_name = $_POST['middle_name'];
					$last_name = $_POST['last_name'];
					$id = $_GET['id'];

					$query = "UPDATE supervisor SET title='$title', first_name='$first_name',middle_name='$middle_name', last_name='$last_name' WHERE id = '$id' ";
					$data = mysqli_query($conn, $query);

					if($data){
						echo("<script>alert('Record Updated.')</script>") ;
						?>

						<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">
						
						<?php
					}
					else{
						echo("Didn't update."."<br>".mysqli_error($conn));
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



