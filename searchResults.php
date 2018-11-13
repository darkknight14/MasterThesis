<?php
	error_reporting(0);	
	include('header.php');
	
	include('connection.php');

	$area = "SELECT * FROM area";
	$data1 = mysqli_query($conn , $area);
?>
<div>
	<img src="icon/logo.png"style="position: relative; top: 11px; left: 20px"> 
</div>

<h1 class="display-4">Msc in Computer Systems and Knowledge Engineering - Completed Thesis Works</h1>
<hr>
<div id="result" class="alert alert-success" style="display:none">Number of records returned is </div>


<form action="searchResults.php" method="POST">
<div class="card" style="">
<div class="row" style="margin-top: 20px;">
  <div class="col-sm-6">
    
      <div class="card-body">
        <h5 class="card-title">Area</h5>
        <p class="card-text"><?php
					  	while($fetch = mysqli_fetch_assoc($data1)){

					  			$name = $fetch['name'];
					  			$id = $fetch['id'];
					  		?>
					  		<div style="padding-left: 20px;">
						  		 <input class="form-check-input" name="checklist[]" type="checkbox" value="<?php echo $id ?>" id="defaultCheck1">
						  		<label class="form-check-label" for="defaultCheck1">
						    		<?php echo $name ?>
						    	</label>
						    	<br>
					    	</div>
					    <?php
					  	}
					    ?>
        </p>
       <!--  <button type="submit" name="submit" value="submit" class="btn btn-primary" >Search</button> -->
      </div>
    
  </div>
  <div class="col-sm-6">
  
      <div class="card-body">
        <h5 class="card-title">Thesis Title</h5>
        <input class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp" placeholder="Title">
        <div style="margin-top: 10px;">
        <h5 class="card-title">Year of Completion</h5>
        <input class="form-control" id="exampleInputEmail1" name="yoc" aria-describedby="emailHelp" placeholder="Year of Completion">
        </div>
        <div style="margin-top: 10px;">
        <h5 class="card-title">Supervisor</h5>
        <input class="form-control" id="exampleInputEmail1" name="supervisor" aria-describedby="emailHelp" placeholder="Supervisor">
        </div>
       
      </div>
    
  </div>
</div>
<hr>
<button type="submit" name="submit" class="btn btn-info" id="submit" style="width:25%; margin:auto;">Search</button>
<style type="text/css">
#submit{
	color:white;
	background-color: #2f9da3;
}
#submit:hover{
		color:#2f9da3;
		background-color: white;
		border: 1px solid #2f9da3;
		
	}

</style>
<hr>
</div>
</form>
<hr>




<br>
<?php

	include('header.php');
	error_reporting(0);	



	function allThree($supervisor,$title,$areaArray){
		include('connection.php');
		$supervisor = str_replace(' ', '', $supervisor);
		$space = ' '; 
		$count = 0;
		foreach($areaArray as $check){
			$count++; 
		}
		$id = $areaArray[0];
		
		if($count == 1){
			$query1 = "SELECT student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and thesis.title like '%$title%' and status.final != '0000-00-00' and thesis_has_area.area_id = '$id' ";

			$data = mysqli_query($conn, $query1);
	        $records = mysqli_num_rows($data);
			
		}
		
		elseif($count == 2){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);		
	        	
		}

		elseif($count= 3){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);


		}

		elseif($count = 4){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id inner join thesis_has_area temp2 on thesis_has_area.thesis_id = temp2.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]') and temp2.area_id = '$areaArray[3]'";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		}
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}


	

	function supervisorAndTitle($supervisor, $title){
		$supervisor = str_replace(' ', '', $supervisor);
		include('connection.php');

		$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and thesis.title like '%$title%' and status.final != '0000-00-00' ";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}

	function supervisorAndAreaArray($supervisor, $areaArray){
		
		include('connection.php');
		$supervisor = str_replace(' ', '', $supervisor);

		$count = 0;
		foreach($areaArray as $check){
			$count++; 
		}
		$id = $areaArray[0];
		
		if($count == 1){
			$query1 = "SELECT student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%'  and status.final != '0000-00-00' and thesis_has_area.area_id = '$id' ";

			$data = mysqli_query($conn, $query1);
	        $records = mysqli_num_rows($data);
			
		}
		
		elseif($count == 2){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%'  and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);		
	        	
		}

		elseif($count= 3){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);


		}

		elseif($count = 4){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id inner join thesis_has_area temp2 on thesis_has_area.thesis_id = temp2.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]') and temp2.area_id = '$areaArray[3]'";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		}
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}

	function titleAndAreaArray($title, $areaArray){

		include('connection.php');
			

		$count = 0;
		foreach($areaArray as $check){
			$count++; 
		}
		$id = $areaArray[0];
		
		if($count == 1){
			$query1 = "SELECT student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE thesis.title like '%$title%' and status.final != '0000-00-00' and thesis_has_area.area_id = '$id' ";

			$data = mysqli_query($conn, $query1);
	        $records = mysqli_num_rows($data);
			
		}
		
		elseif($count == 2){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);		
	        	
		}

		elseif($count= 3){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);


		}

		elseif($count = 4){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  thesis.title like '%$title%' and status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id inner join thesis_has_area temp2 on thesis_has_area.thesis_id = temp2.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]') and temp2.area_id = '$areaArray[3]'";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		}
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;

	}

	function title($title){


		include('connection.php');

		$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE thesis.title like '%$title%' and status.final != '0000-00-00' ";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
		
	}

	function supervisor($supervisor){
		$supervisor = str_replace(' ', '', $supervisor);

		include('connection.php');

		$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE concat(supervisor.title,supervisor.first_name,supervisor.middle_name,supervisor.last_name) LIKE '%$supervisor%' and status.final != '0000-00-00' ";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);
				//echo($query1);
		
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}

	function AreaArrayAndYoc($areaArray, $yoc){
		include('connection.php');


		$count = 0;
		foreach($areaArray as $check){
			$count++; 
		}
		$id = $areaArray[0];
		
		if($count == 1){
			$query1 = "SELECT student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' and thesis_has_area.area_id = '$id' and status.final like '$yoc%'";

			$data = mysqli_query($conn, $query1);
	        $records = mysqli_num_rows($data);
			
		}
		
		elseif($count == 2){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]') and status.final like '$yoc%'"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);		
	        	
		}

		elseif($count= 3){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]') and status.final like '$yoc%'"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);


		}

		elseif($count = 4){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st, status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id inner join thesis_has_area temp2 on thesis_has_area.thesis_id = temp2.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]' and temp2.area_id = '$areaArray[3]') and status.final like '$yoc%'";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		}
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}
	function YearofCompletion($yoc){

		include('connection.php');

		$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final LIKE '$yoc%' ";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);
				//echo($query1);
		
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;

	}



























	
	function areaArray($areaArray){

		include('connection.php');
			

		$count = 0;
		foreach($areaArray as $check){
			$count++; 
		}
		$id = $areaArray[0];
		
		if($count == 1){
			$query1 = "SELECT student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' and thesis_has_area.area_id = '$id' ";

			$data = mysqli_query($conn, $query1);
	        $records = mysqli_num_rows($data);
			
		}
		
		elseif($count == 2){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);		
	        	
		}

		elseif($count= 3){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st,status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]')"; 

				$data = mysqli_query($conn, $query1);
	        	$records = mysqli_num_rows($data);


		}

		elseif($count = 4){
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st, status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE  status.final != '0000-00-00' and thesis.id in (Select distinct temp.thesis_id From thesis_has_area INNER join thesis_has_area temp on thesis_has_area.thesis_id = temp.thesis_id Inner join thesis_has_area temp1 on thesis_has_area.thesis_id = temp1.thesis_id inner join thesis_has_area temp2 on thesis_has_area.thesis_id = temp2.thesis_id Where temp.area_id = '$areaArray[0]' and thesis_has_area.area_id = '$areaArray[1]' and temp1.area_id = '$areaArray[2]') and temp2.area_id = '$areaArray[3]'";

				$data =  mysqli_query($conn, $query1);
				$records = mysqli_num_rows($data);

		}
		
		if($records != 0){ 
			?>
			<div>
			<table class="table table-striped">
			    <tr>
			      <th scope="col">S.N</th>
			      <th scope="col">Thesis Title</th>
			      <th scope="col">Student Name</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Date of Completion</th>
			      </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			echo "<tr>
				    <td>".++$sn."</td>
					<td>".$fetch['tt']."</td>
					<td>".$fetch['sfn']." ".$fetch['smn']." ".$fetch['sln']."</td>
					<td>".$fetch['st']." ".$fetch['sufn']." ".$fetch['sumn']." ".$fetch['suln']."</td>
				  	<td>".$fetch['finale']."</td>
				  </tr>";
		}
	
		}
		return $records;
	}


	$supervisor = $_POST['supervisor'];
	$title = $_POST['title'];
	$areaArray = $_POST['checklist'];
	$yoc = $_POST['yoc'];
	$temp = 1;
	if($supervisor or $title or $areaArray or $yoc)
	{
		if($supervisor and $title and $areaArray ){
			allthree($supervisor, $title, $areaArray);
		$temp = 0;
		}			

		elseif($supervisor and $title and $temp){
			 $result=supervisorAndTitle($supervisor, $title);
		$temp = 0;
		}

		elseif($supervisor and $areaArray and $temp){
			$result=supervisorAndAreaArray($supervisor, $areaArray);
		$temp = 0;
		}

		elseif($areaArray and $title and $temp){
			$result=titleAndAreaArray($title, $areaArray);
		$temp = 0;
		}

		elseif($areaArray and $yoc){
			$result=AreaArrayAndYoc($areaArray,$yoc);
			$temp = 0;
		}

		elseif($supervisor and $temp){
			$result=supervisor($supervisor);
			$temp = 0;
		}

		elseif($areaArray and $temp){
			$result=areaArray($areaArray);
		$temp = 0;
		}

		elseif($title and $temp){
			$result=title($title);
		$temp = 0;
		}

		elseif($yoc and $temp){
			$result=YearofCompletion($yoc);
		}

		?>

		<script type="text/javascript">
			var show=document.getElementById("result");
			show.style.display="block";
			
			show.innerHTML+=<?php echo $result; ?>
			/*$("#result").show();*/

			setTimeout(function() {
			 $("#result").hide(); }, 5000);

		</script>


		<?php
	}
	else
		echo('Enter atleast one Field.');
	


?>
