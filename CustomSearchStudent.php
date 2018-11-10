<?php
	session_start();
	if ($_SESSION['loggedin']) 
	{

	include('header.php');
	include('nav.php');
	error_reporting(0);	
	
	
	$student = $_POST['student'];
	$batch = $_POST['batch'];
	if($student and $batch)
	{	
		 SearchByStudent($student, $batch);
	}
	else
	{

		echo '<hr>
	<div class="alert alert-warning" style="margin:30px;"> <h2>No results </h2></div> <hr>';

	}
	function SearchByStudent($student, $batch)
	{
		$new_student = str_replace(' ', '', $student);

		include('connection.php');
		/*querry those students who are working on thesis */
		$query1 = "SELECT DISTINCT * FROM student_writes_thesis
		INNER JOIN student on stud_batch = '$batch'and stud_depart = department and stud_rollno = class_rollno
		INNER JOIN thesis on thesis.id = student_writes_thesis.thesis_id
		INNER JOIN status on status.thesis_id = thesis.id 
		where stud_batch = '$batch' and concat(student.first_name, student.middle_name, student.last_name) LIKE '%$new_student%'";

		$data =  mysqli_query($conn, $query1);
		$records = mysqli_num_rows($data);
		if($records != 0)
		{
		?>
				<div class="container">
				<table class="table" style="margin-top: 6%;">
				    <tr>
				    	<th scope="col">S.N</th>
					   	<th scope="col">Student Name</th>
				      	<th scope="col">Class RollNo</th>
				      	<th scope="col">Thesis ID</th>
				   		<th scope="col">Operation</th>
				    </tr>
			<?php
			$sn = 0;
			while($fetch = mysqli_fetch_assoc($data)){
				
				echo "<tr>
						<td>".++$sn."</td>
						<td>".$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name']."</td>
						<td>".$fetch['stud_batch'].$fetch['stud_depart'].$fetch['stud_rollno']."</td>
						<td>".$fetch['thesis_id']."</td>
						<td><a href='updateIndividual.php?fn=$fetch[first_name]&mn=$fetch[middle_name]&ln=$fetch[last_name]&sb=$fetch[stud_batch]&sd=$fetch[stud_depart]&sr=$fetch[stud_rollno]&id=$fetch[thesis_id]'>Update</a></td>
					  </tr>";
				}
		}

	else{
		echo "<div class='alert alert-primary' style='position: absolute; top: 460px; left: 315px;'>Zero results .</div>";
	}
	 echo'
			</table>
				</div>
					
			
			<script type="text/javascript">
				function checkDelete(){
					return confirm("Delete this Record?");
				}

			</script>

		';	
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




	