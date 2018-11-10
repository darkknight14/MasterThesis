<?php
	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
		include('updateStudent.php');
		$batch = $_GET['batch'];
	
		$query = "SELECT * FROM student_writes_thesis
		INNER JOIN student on stud_batch = batch and stud_depart = department and stud_rollno = class_rollno
		INNER JOIN thesis on thesis.id = student_writes_thesis.thesis_id
		INNER JOIN status on status.thesis_id = thesis.id 
		where stud_batch = '$batch' ";
		$data = mysqli_query($conn, $query);
		echo'
		<div class="lead h3 alert alert-info" style="float:left;">'. $batch.'</div>
		<form class="form-inline" method="POST" action ="CustomSearchStudent.php" style=" margin:2%; float:right;">
		    <label class="sr-only" for="inlineFormInputName2">Name</label>
		    <input type="hidden" class="form-control" id="area" name="batch" value="'.$batch.'">
		    <input type="text" class="form-control" id="area" name="student" placeholder="E.g. Shristi ">
		 	<button type="submit" class="btn btn-primary">Search</button>
	 	</form>';
	


	$records = mysqli_num_rows($data);


	if($records != 0){
		?>
			<div class="container" style="margin-top:5%; ">	
			<table class="table" style="width: 1000px; padding : 25px; ">
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
		echo "<div class='alert alert-warning' style='position: absolute; margin-top: 60px; left: 315px;'>No record Found.</div>";
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
	else 
	{
		// user is not logged in, send the user to the login page
		echo 'update student by batch ';
		//echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}

?>



