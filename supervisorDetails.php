<?php

	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{

			include('header.php');
			include('nav.php');
			include("connection.php");

			$id = $_GET['id'];

			$query = "SELECT thesis.id t_id, thesis.title thesis_title, student.batch batch, student.department department, student.class_rollno class_rollno, student.first_name stud_firstname, student.middle_name stud_middlename, student.last_name stud_lastname
			   FROM supervisor
			   INNER JOIN thesis on supervisor.id = thesis.sup_id
			   INNER JOIN student_writes_thesis on thesis.id = student_writes_thesis.thesis_id
			   INNER JOIN student ON student.batch = student_writes_thesis.stud_batch and student.department = student_writes_thesis.stud_depart and student.class_rollno = student_writes_thesis.stud_rollno
			   WHERE supervisor.id = '$id' ";

			$data = mysqli_query($conn, $query);
			$records = mysqli_num_rows($data);

			$query_super= "SELECT * FROM supervisor WHERE id='$id' ";
			$res_super= mysqli_query($conn, $query_super);
			$row=mysqli_fetch_assoc($res_super);
			$supervisor_name=$row['title'].' '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];
		
			if($records != 0){
				?>
					<ul class="nav nav-tabs">
						<li>
							
							<h4 class="lead" style="padding: 7px;"><?php echo $supervisor_name; ?></h4>

						</li>
					</ul>				
					<div>
					<table class="table">
					    <tr>
					      <th scope="col">S.N</th>
					      <th scope="col">Thesis ID</th>
					      <th scope="col">Thesis Title</th>
					      <th scope="col">Student Name</th>
					      <th scope="col">Class RollNo</th>
					    </tr>
				<?php
				$sn = 0;
				while($fetch = mysqli_fetch_assoc($data)){
					echo "<tr>
						    <td>".++$sn."</td>
						    <td>".$fetch['t_id']."</td>
							<td>".$fetch['thesis_title']."</td>
							<td>".$fetch['stud_firstname']." ".$fetch['stud_middlename']." ".$fetch['stud_lastname']."</td>
							<td>".$fetch['batch'].$fetch['department'].$fetch['class_rollno']."</td>
						  </tr>";
				}
			
			}

			else{
				echo "<script>alert('Thesis not found.')</script>";
				?>
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">

				<?php
			}
		?>
					</table>
				</div>
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