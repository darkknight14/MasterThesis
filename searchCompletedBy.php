<?php
	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
			include('header.php');
			error_reporting(0);	
			include('connection.php');
			$query1 = "SELECT distinct student.first_name sfn, student.middle_name smn, student.last_name sln, thesis.title tt, supervisor.first_name sufn, supervisor.middle_name sumn, supervisor.last_name suln, supervisor.title st, status.final finale FROM thesis_has_area INNER join thesis on thesis_has_area.thesis_id = thesis.id inner join supervisor on thesis.sup_id = supervisor.id inner join status on thesis.id = status.thesis_id INNER join student_writes_thesis on thesis.id = student_writes_thesis.thesis_id INNER join student on student_writes_thesis.stud_batch = student.batch and student_writes_thesis.stud_depart = student.department and student_writes_thesis.stud_rollno = student.class_rollno WHERE status.final != '0000-00-00' order by status.final desc limit 50";

			$data = mysqli_query($conn, $query1);
			$records = mysqli_num_rows($data);
					
			$area = "SELECT * FROM area";
			$data1 = mysqli_query($conn , $area);
			?>
				<img src="icon/logo.png"style="position: relative; top: 11px; left: 20px"> 
				<H1>Msc in Computer Systems and Knowledge Engineering - Completed Thesis Works</H1>
				<hr>



				
		<!-- 		
		<form action="searchResults.php" method="POST">
		<div style="">
		<div class="row" style="margin-top: 20px;">
		  <div class="col-sm-6">
		    <div class="card" style="background-color: lightgrey;">
		      <div class="card-body">
		        <h5 class="card-title">Area</h5>
		        <p class="card-text"><?php
							  	/*while($fetch = mysqli_fetch_assoc($data1)){

							  			$name = $fetch['name'];
							  			$id = $fetch['id'];*/
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
		        <button type="submit" name="submit" value="submit" class="btn btn-primary" >Search</button>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-6">
		    <div class="card" style="background-color: lightgrey;">
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
		        <button type="submit" name="submit" value="submit" class="btn btn-primary" style="margin-top: 17px;">Search</button>
		      </div>
		    </div>
		  </div>
		</div>
		</div>
		</form>
		<hr> -->



<form action="searchResults.php" method="POST">
<div class="container card" style="padding:2%; ">
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
						    		<?php echo $name; ?>
						    	</label>
						    	<br>
					    	</div>
					    <?php
					  	}
					    ?>
        </p>
        <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary" >Search</button> -->
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
        <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary" style="margin-top: 17px;">Search</button> -->
      </div>
    
  </div>
</div>

<button type="submit" name="submit"  value="submit" class="btn btn-outline-info" style="width:25%; margin:auto;">Search</button>

</div>
</form>
<hr>




		<div>
			<h2>Some Recently Completed Thesis.</h2>	
			<div style="margin-top: 10px;">
			<?php
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
			?>
			</table>
		</div>
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