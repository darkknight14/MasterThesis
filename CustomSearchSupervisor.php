<?php
	session_start();
	if ($_SESSION['loggedin']) 
	{

			include('header.php');
			include('nav.php');
			error_reporting(0);	
			
			
			$supervisor = $_POST['supervisor'];
			if($supervisor)
			{
				 SearchBySupervisor($supervisor);
			}
			else
			{

				echo '<hr>
			<div class="alert alert-warning" style="margin:30px;"> <h2>No results </h2></div> <hr>';

			}
			function SearchBySupervisor($supervisor)
			{
				$new_supervisor = str_replace(' ', '', $supervisor);

				include('connection.php');
				echo'<div class="alert alert-light container lead"><h3 class="h3" >Supervisor for thesis<h3></div>
			<form class="form-inline" method="POST" action ="CustomSearchSupervisor.php" style="float:right; margin:2px;">
				<label class="sr-only" for="inlineFormInputName2">Name</label>
				<input type="text" class="form-control" id="supervisor_name" name="supervisor" placeholder="Search Supervisor">
			<button type="submit" class="btn btn-primary">Search</button>
			</form>';

				$query1 = "SELECT DISTINCT  *  FROM supervisor WHERE concat(supervisor.first_name, supervisor.middle_name, supervisor.last_name) LIKE '%$new_supervisor%'";

						$data =  mysqli_query($conn, $query1);
						$records = mysqli_num_rows($data);
				
				if($records != 0){ 
					?>
					<div>
					<table class="table " style="width: 700px; padding-left : 20px;">
					    <tr>
					      <th scope="col">S.N</th>
					      <th scope="col">Supervisor Name</th>
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
				else
				{
					echo "<div class='alert alert-primary' style='position: absolute; top: 460px; left: 315px;'>Zero results .</div>";
				}
			}

		?>
			</table>
				</div>
			</body>
		</html>
		<script type="text/javascript">
			function checkDelete(){
				return confirm('Delete this Record?');
			}

		</script>
<?php

	} 
	else {
		// user is not logged in, send the user to the login page
		header('Location: adminIOE.php');
	}

?>