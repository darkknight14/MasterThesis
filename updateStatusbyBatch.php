<?php

	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
		include('statusbyBatch.php');
		$batch = $_GET['batch'];
	
		$query = "SELECT * FROM student_writes_thesis
		INNER JOIN student on stud_batch = batch and stud_depart = department and stud_rollno = class_rollno
		INNER JOIN thesis on thesis.id = student_writes_thesis.thesis_id
		INNER JOIN status on status.thesis_id = thesis.id 
		where stud_batch = '$batch' ";
		$data = mysqli_query($conn, $query);
		
		$records = mysqli_num_rows($data);

		if($records != 0){
			?>	<div class="lead h3 alert alert-info" style="float:left;"><?php echo $batch;?></div>
				<div class="container">
				<table class="table" style="margin-top:7%;  ">
				    <tr>
				    	<th scope="col">S.N</th>
				    	<th scope="col">Thesis ID</th>
				      <th scope="col">Thesis Title</th>
				      <th scope="col">Midterm Date</th>
				      <th scope="col">Final Date</th>
				    <th scop="col">Operation</th>
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
						<td>".$fetch['thesis_id']."</td>
						<td>".$fetch['title']."</td>
						<td>".$midterm."</td>
						<td>".$final."</td>
						<td><a href='updateStatus.php?thesis_id=$fetch[thesis_id]&mdl_trm=$fetch[mid_term]&fnl=$fetch[final]&batch=$batch'>Update</a></td>
					 	<td><a href='deleteStatus.php?thesis_id=$fetch[thesis_id]&batch=$batch' onclick='return checkDelete()'>Clear</a></td>
					  </tr>";
			}
	
	}

	else{
		echo '<div class="alert alert-primary container" style=" margin-top:12%;" >No record Found.</div>';
	}
?>
				</table>
			</div>
		</body>
	</html>
	<script type="text/javascript">
		function checkDelete(){
			return confirm('Clear this Record?');
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