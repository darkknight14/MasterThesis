<?php

	session_start();
	error_reporting(0);
	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		include('showWrites.php');
		$batch = $_GET['batch'];
	
		$query = "SELECT DISTINCT student_writes_thesis.thesis_id t_id, area.name t_area, student.first_name sfirst_name, student.middle_name smiddle_name, student.last_name slast_name, stud_batch, stud_depart, stud_rollno, thesis.title ttitle, supervisor.title stitle, supervisor.first_name	sufirst_name, supervisor.middle_name sumiddle_name, supervisor.last_name sulast_name
		FROM  area, student_writes_thesis
		INNER JOIN student on stud_batch = batch and stud_depart = department and stud_rollno = class_rollno
		INNER JOIN thesis on thesis.id = student_writes_thesis.thesis_id
		INNER JOIN status on status.thesis_id = thesis.id 
		INNER JOIN supervisor on supervisor.id = thesis.sup_id
		INNER JOIN thesis_has_area on student_writes_thesis.thesis_id = thesis_has_area.thesis_id
		where student.batch = '$batch'
		and 
		area.id=thesis_has_area.area_id
		 ";
	$data = mysqli_query($conn, $query);
	

	$records = mysqli_num_rows($data);
	//$fetch = mysqli_fetch_assoc($data);

	if($records != 0){
		?>
			<?php
				echo'
				<div class=" alert alert-info lead h6" style="float:left;"> '. $batch.'</div>
				<form class="form-inline" method="POST" action ="Thesis.php" style="float:right; margin: 7px;">
			    	<input type="hidden" class="form-control" id="batch" name="batch" value="'.$batch.'">
			    	<input type="text" class="form-control" id="thesis" name="t_id" placeholder="Search By Thesis ID ">
			  		<button type="Submit" class="btn btn-primary">Search</button>
			  </form>
				<form class="form-inline" method="POST" action ="CustomSearchThesis.php" style="float:right; margin:7px;">
			    	<input type="hidden" class="form-control" id="batch" name="batch" value="'.$batch.'">
			    	<input type="text" class="form-control" id="thesis" name="title" placeholder="Search By Thesis Title ">
			  		<button type="Submit" class="btn btn-primary">Search</button>
			  </form>';
			  ?>
			
			<div class="container" >
			<table class=" table">
			    <tr>
			    	<th scope="col">S.N</th>
				   <th scope="col">Student Name</th>
			      <th scope="col">Class RollNo</th>
			      <th scope="col">Thesis ID</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Supervisor</th>
			      <th scope="col">Area</th>
			      <th scope="col">Operation</th>
			    </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo '<tr>
					<td>'.++$sn.'</td>
					<td>'.$fetch["sfirst_name"].' '.$fetch["smiddle_name"].' '.$fetch["slast_name"].'</td>
					<td>'.$fetch["stud_batch"].$fetch["stud_depart"].$fetch["stud_rollno"].'</td>
					<td>'.$fetch["t_id"].'</td>
					<td>'.$fetch["ttitle"].'</td>
					<td>'.$fetch["stitle"].' '.$fetch["sufirst_name"].' '.$fetch["sumiddle_name"].' '.$fetch["sulast_name"].'</td>
				  	<td>'.$fetch["t_area"].'</td>
				  	<td ><a href="deleteThesis.php?thesis_id='. $fetch["t_id"].'">Clear</a></td>	
				  </tr>';
		}
	
	}

	else{
		echo '<div class="alert alert-primary" style="position: absolute; top: 360px; left: 315px;">No record Found.</div>';
	}
?>
			</table>
		</div>
	
<?php 

	} 
else 
{
	// user is not logged in, send the user to the login page

	echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
	header('Location: adminIOE.html');
}

?>