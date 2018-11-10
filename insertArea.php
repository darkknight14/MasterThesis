<?php

	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		


		include("header.php");
		include("nav.php");
		include("connection.php");
		error_reporting(0);	

?>
<form action="" method="POST" style="padding: 10px; ">
	 <div class="form-group">
	    <label>Area Name</label>
	    <input class="form-control" id="exampleInputEmail1" name="area_name" aria-describedby="" placeholder="Area Name" required>
	  </div>
	  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
</form>

<?php
	
	if($_POST['submit']){
		$area_name = $_POST['area_name'];

		if(!$area_name){
			echo("Please fill out the required fields.");
		}

		else{

				$query3 = "SELECT    *
				FROM      area
				ORDER BY  id DESC
				LIMIT     1";

				$lastrow = mysqli_query($conn , $query3);
				$fetch = mysqli_fetch_assoc($lastrow);
				$lastrow_id = $fetch['id']; 
				$thesis_id = $lastrow_id + 1 ;

			$query = "INSERT INTO area VALUES ('$thesis_id','$area_name')";

			$insert = mysqli_query($conn, $query);

				 if ($insert) {
				 	echo "<script>alert('Area Inserted.')</script>";
					?>

					<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">
				<?php
				 }
				else{

					echo "Not Inserted.";
					
				}
			}	
		}
	} 
else 
{
	// user is not logged in, send the user to the login page
	/*echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';*/
	header('Location: adminIOE.html');
}

?>
