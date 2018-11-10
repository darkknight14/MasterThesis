<?php

	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
			include("header.php"); 
			include("nav.php");
			include("connection.php");
			
			$query = "SELECT DISTINCT thesis.id, batch, department, class_rollno, student.first_name stud_firstname, student.middle_name stud_middlename, student.last_name stud_lastname, thesis.title thesis_title, supervisor.title supervisor_title, supervisor.first_name supervisor_firstname, supervisor.middle_name supervisor_middlename, supervisor.last_name supervisor_lastname, mid_term, final 
				FROM student
				INNER JOIN student_writes_thesis ON student.batch = student_writes_thesis.stud_batch and student.department = student_writes_thesis.stud_depart and student.class_rollno = student_writes_thesis.stud_rollno
				INNER JOIN thesis on student_writes_thesis.thesis_id = thesis.id
				INNER JOIN supervisor on thesis.sup_id = supervisor.id 
				INNER JOIN status on thesis.id  = status.thesis_id  " ;

				$data = mysqli_query($conn, $query);
				$records = mysqli_num_rows($data);
				if($records != 0){
				?>
					<div>
					<table class="table">
					    <tr>
					    	<th scope="col">S.N</th>
					      <th scope="col">Class RollNo</th>
					      <th scope="col">Student Name</th>
					      <th scope="col">Supervisor Name</th>
					      <th scope="col">Thesis Title</th>
					      <th scope="col">Midterm</th>
					      <th scope="col">Final</th>
					      
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
							<td>".$fetch['batch'].$fetch['department'].$fetch['class_rollno']."</td>
							<td>".$fetch['stud_firstname']." ".$fetch['stud_middlename']." ".$fetch['stud_lastname']."</td>
							<td>".$fetch['supervisor_title']." ".$fetch['supervisor_firstname']." ".$fetch['supervisor_middlename']." ".$fetch['supervisor_lastname']."</td>
							<td>".$fetch['thesis_title']."</td>
							<td>".$midterm."</td>
							<td>".$final."</td>
						  </tr>";
				}
			
			}

			else{
				echo "No record has been found.";
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
		echo ' show student ..';
		header('Location: adminIOE.html');
	}
?>