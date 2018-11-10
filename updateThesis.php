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

		$query = "SELECT * FROM supervisor";
		$data = mysqli_query($conn, $query);

?>
	<form action="" method="POST" style="padding: 10px; ">
	  <div class="form-group">
	    <label>Title</label>
	    <input class="form-control" id="exampleInputPassword1" name="title" placeholder="Title" value = "<?php echo $_GET['ttl'];?>">
	  </div>
	  <div class="form-group">
	  	<label>Supervisor Name*(Previously: <?php echo $_GET['sup_name'] ?>)</label>
		  <select class="form-control" name="sup_id">
		  	<?php 
		  	while($fetch = mysqli_fetch_assoc($data)){
		  		$temp = $fetch['title'].' '.$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name']; 
		  		$value = $fetch['id'];?>
		  		<option value="<?php echo $value ?>"><?php echo $temp ?></option>
		  	<?php
		  		}
		  	?>
		  </select>  
	  </div>
	    
	  <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
	</form>
	<?php
			include("connection.php");
			error_reporting(0);

			if($_POST['update']){

			$title = $_POST['title'];
			$sup_id = $_POST['sup_id'];
			$id = $_GET['id'];

			$query = "UPDATE thesis SET sup_id = '$sup_id', title='$title' WHERE id = '$id' ";
			$data = mysqli_query($conn, $query);

			if($data){
				echo("<script>alert('Record Updated.')</script>") ;
				?>

				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showThesis.php">
				
				<?php
			}
			else{

				echo("<script>alert('Record Not updated.')</script>") ;

				?>
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showThesis.php">
				
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