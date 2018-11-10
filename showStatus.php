<?php


	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{



			include('header.php');
			include('nav.php');
			include("connection.php");

			error_reporting(0);

			$query = "SELECT DISTINCT * FROM status
			INNER JOIN thesis on status.thesis_id = thesis.id";

			$data = mysqli_query($conn, $query);
			$records = mysqli_num_rows($data);
			//$fetch = mysqli_fetch_assoc($data);

			if($records != 0){
				?>
					<table class="table" style="width: 1200px; padding-left : 20px;">
					    <tr>
					    	<th scope="col">S.N</th>
					      <th scope="col">Thesis Title</th>
					      <th scope="col">Midterm Date</th>
					      <th scope="col">Final Date</th>
					    </tr>
				<?php
				$sn = 0;
				while($fetch = mysqli_fetch_assoc($data)){
					if($fetch['mid_term'] != '0000-00-00'){
						$midterm = $fetch['mid_term'];
					}
					else{
						$midterm = 'X';
					}
					if($fetch['final'] != '0000-00-00'){
						$final = $fetch['final'];
					}
					else{
						$final = 'X';
					}
					echo "<tr>
							<td>".++$sn."</td>
							<td>".$fetch['title']."</td>
							<td>".$midterm."</td>
							<td>".$final."</td>
						 	<td><a href='updateStatus.php?thesis_id=$fetch[thesis_id]&mdl_trm=$fetch[mid_term]&fnl=$fetch[final]'><img src='icon/update.svg'></a></td>
						 	<td><a href='deleteStatus.php?thesis_id=$fetch[thesis_id]' onclick='return checkDelete()'><img src='icon/delete.svg'></a></td>
						  </tr>";
				}
			
			}

			else{
				echo "No record has been found.";
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


