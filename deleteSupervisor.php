<?php

	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
		include("connection.php");
		include("header.php");
		include("nav.php");
		$id = $_GET['id'];

		$query_supervisor= "SELECT * FROM Supervisor WHERE id='$id' ";
		$result_supervisor= mysqli_query($conn, $query_supervisor);
		$row= mysqli_fetch_assoc($result_supervisor);
		$supervisor_name=$row["title"]. " ".$row["first_name"]." ".$row["middle_name"]. " ".$row["last_name"]; 
		

		/*check whether supervisor has thesis to look upon*/
		/*if true*/
		$query= "SELECT id FROM thesis WHERE thesis.sup_id= '$id' ";
		$thesis_supervised= mysqli_query($conn, $query);
		$thesis_row=mysqli_num_rows($thesis_supervised);
		echo '<div class="alert alert-secondary " style ="margin: 20px; " > Thesis supervised by '.$supervisor_name.' is '. $thesis_row .'</div>'; 
		if($thesis_row>0){
			/*echo '<script>alert("Supervisor '. $supervisor_name .' has thesis under supervision.\n 1. Delete thesis under supervision and then delete thesis.\n 2. Substitute with \'NULL\' or another name.")</script>';*/
		?>
				
		<!-- Button trigger modal -->
		<a type="button" href="" style ="margin-left: 20px" data-toggle="modal" data-target="#DeleteSupervisor">
		  Still want to delete supervisor record!
		</a>

		<!-- Modal -->
		<div class="modal fade" id="DeleteSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h5>Things you can do.</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <ul>
		        	<li>
		        		1. Delete thesis under supervision and come back to delete this supervisor.
		        	</li>
		        	<li>
		        		2. Substitute with alternate names (eg. NULL or other ).
		        		<form action="" method= "POST" >
		        			<div class="container" style="margin: auto ; padding: 1px;">
		        				<div class="input-group input-group-sm mb-6	">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
									</div>
									<input type="text" class="form-control" aria-label="Supervisor" name="alt_title" placeholder="Mr. " aria-describedby="inputGroup-sizing-sm">
									<input type="text" class="form-control" name="alt_first" placeholder= "Aman" aria-describedby="inputGroup-sizing-sm">
									<input type="text" class="form-control" name= "alt_middle" placeholder= "Kumar " aria-describedby="inputGroup-sizing-sm">
									<input type="text" class="form-control" name= "alt_last" placeholder= "Shakya" aria-describedby="inputGroup-sizing-sm">
								</div>
		        			</div>
							
							<div class="modal-footer">
								<button type="submit" name= "submit" class="btn btn-primary">Substitute</button>
							</div>
		        		</form>
		        	</li>
		        </ul>	
		      </div>
		    </div>
		  </div>
		</div>

		<?php 
				$title=  $_POST['alt_title'];
				$first=  $_POST['alt_first'];
				$middle=  $_POST['alt_middle'];
				$last=  $_POST['alt_last'];
				if(isset($_POST['submit'])){
					$query_alt= "UPDATE Supervisor SET title ='$title', first_name='$first' , middle_name='$middle' , last_name='$last' WHERE id= '$id' ";
					$result_done=mysqli_query($conn, $query_alt);
					if($result_done){
						echo "<script>alert('Updated supervisor record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">';}
					else{
						echo "<script>alert('Failed to update supervisor record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">';}
				}
			} /*ifend  thesis are under supervision */

			else{ // no thesis under supervision
				$del_sup="DELETE FROM Supervisor WHERE id= '$id' ";
				$res=mysqli_query($conn, $del_sup);
				if($res){
						echo "<script>alert('Deleted supervisor record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">';}
					else{
						echo "<script>alert('Failed to delete supervisor record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showSupervisor.php">';}

			}

	} 
else 
{
	// user is not logged in, send the user to the login page
	/*echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';*/
	header('Location: adminIOE.html');
}
?>	