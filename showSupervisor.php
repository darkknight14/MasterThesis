<?php

	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
			include('header.php');
			include('nav.php');
			
			include("connection.php");

			error_reporting(0);

			$query = "SELECT DISTINCT * FROM supervisor";

			$data = mysqli_query($conn, $query);
			$records = mysqli_num_rows($data);
			//$fetch = mysqli_fetch_assoc($data);

			if($records != 0){
				?>
				<form class="form-inline" method="POST" action ="CustomSearchSupervisor.php" style="float:right; margin:20px;">
				<label class="sr-only" for="inlineFormInputName2">Name</label>
				<input type="text" class="form-control" id="supervisor_name" name="supervisor" placeholder="Search Supervisor">
				<button type="submit" class="btn btn-primary">Search</button>
				</form>

					<table class="table " style="width: 700px; padding-left : 20px;">
					    <tr>
					      <th scope="col">S.N</th>
					      <th scope="col">Name</th>
					      <th colspan="3">Operation</th>
					    </tr>
				<?php
				$sn = 0; 
				while($fetch = mysqli_fetch_assoc($data)){
					echo "<tr>
							<td>".++$sn."</td>
							<td>".$fetch['title'].' '.$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name']."</td>
						 	<td><a href='updateSupervisor.php?id=$fetch[id]&ttl=$fetch[title]&fn=$fetch[first_name]&mn=$fetch[middle_name]&ln=$fetch[last_name]'>Update</a></td>
						 	<td><a href='deleteSupervisor.php?id=$fetch[id]' onclick='return checkDelete()'>Delete</a></td>
						 	<td><a href='supervisorDetails.php?id=$fetch[id]'>Thesis supervised</a></td>
						  </tr>";
				}
			
			}

			else{
				?><div class="alert alert-light container lead"><h3 class="h3" >Supervisor for thesis<h3></div><?php
				echo "<div class='alert alert-info' style='margin-top:30px;'>No record has been found.</div>";
			}
		?>
					</table>
				</body>
		</html>
		<script type="text/javascript">
			function checkDelete(){
				return confirm('Delete this Record?');
			}

		</script>
<?php 				
			
	} 
else 
	{
		// user is not logged in, send the user to the login page

		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}
?>
	