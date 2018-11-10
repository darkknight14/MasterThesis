<?php
	error_reporting(0);
	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
			include('header.php');
			include('nav.php');
			include("connection.php");

			error_reporting(0);
			
			$query = "SELECT DISTINCT * FROM area";
			$data = mysqli_query($conn, $query);
			

			$records = mysqli_num_rows($data);
			//$fetch = mysqli_fetch_assoc($data);

			if($records != 0){

				echo'
			
			<form class="form-inline" method="POST" action ="CustomSearchArea.php" style="float:right; margin:20px;">
				<label class="sr-only" for="inlineFormInputName2">Name</label>
				<input type="text" class="form-control" id="area" name="area" placeholder="E.g. Image Processing">
			<button type="submit" class="btn btn-primary">Search</button>
			</form>
			';

				?>
					<table class="table" style="width: 700px; padding-left : 20px;">
					    <tr>
					    	<th scope="col">S.N</th>
						   <th scope="col">Area Name</th>
					      <th scope="col">Operation</th>
					    </tr>
				<?php
				$sn = 0; 
				while($fetch = mysqli_fetch_assoc($data)){
					// $fetch1 = mysqli_fetch_assoc($data1);
					echo "<tr>
							<td>".++$sn."</td>
							<td>".$fetch['name']."</td>
						 	<td><a href='areaDetails.php?area_id=$fetch[id]'>View Thesis</a></td>
						 	<td><a href='areaDelete.php?area_id=$fetch[id]'>Delete Area </a></td>
						  </tr>";
				}
			
			}

			else{
				echo'<div class="alert alert-light container lead"><h3 class="h3" >Area for thesis<h3></div>';
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