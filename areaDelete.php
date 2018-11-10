<?php

	session_start();
		

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		
		include("connection.php");
		include("header.php");
		include("nav.php");
		$id = $_GET['area_id'];

		/*first find out the  area name */
		$query_area= "SELECT id, name FROM area WHERE id='$id' ";
		$result_area= mysqli_query($conn, $query_area);
		if(mysqli_num_rows($result_area)>0 )
		{
			$row= mysqli_fetch_assoc($result_area);
			$area= $row["name"];
		}
		else
			echo 'No  such area in database';

		
		/*check whether area has thesis */
		$query= "SELECT * FROM thesis_has_area WHERE area_id= '$id' ";
		$result= mysqli_query($conn, $query);
		$row_num=mysqli_num_rows($result);
		echo '<div class="alert alert-secondary " style ="position: relative; margin: 20px; " > Number of thesis under area '.$area.' is '. $row_num .'</div>'; 
		if($row_num>0) /*if true*/
		{
				
				?>
						
				<!-- Button trigger modal -->
				<a type="button" href="" style ="margin-left: 20px" data-toggle="modal" data-target="#DeleteSupervisor">
				  Still want to delete area record!
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
				        		1. Delete thesis under area and come back to delete this area.
				        	</li>
				        	<li>
				        		2. You can rename to another name (eg. NULL or other ).
				        		<form action="" method= "POST" >
				        			<div class="container" style="margin: auto ; padding: 1px;">
				        				<div class="input-group input-group-sm mb-6	">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-sm">Area</span>
											</div>
											<input type="text" class="form-control" aria-label="Area" name="alt_area" placeholder=" Eg. Big Data " aria-describedby="inputGroup-sizing-sm">
											
										</div>
				        			</div>
									
									<div class="modal-footer">
										<button type="submit" name= "submit" class="btn btn-primary">Rename</button>
									</div>
				        		</form>
				        	</li>
				        </ul>	
				      </div>
				    </div>
				  </div>
				</div>

		<?php 
				$area=  $_POST['alt_area'];
				
				if(isset($_POST['submit'])){
					$query_alt= "UPDATE area SET name ='$area' WHERE id= '$id' ";
					$result_done=mysqli_query($conn, $query_alt);
					if($result_done){
						echo "<script>alert('Area renamed.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">';}
					else{
						echo "<script>alert('Failed to rename area.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">';}
				}
		} /*if end thesis are under area */


		else # No thesis under area
		{
				$del_area="DELETE FROM area WHERE id= '$id' ";
				$res=mysqli_query($conn, $del_area);
				if($res){
						echo "<script>alert('Deleted area record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">';}
					else{
						echo "<script>alert('Failed to delete area record.')</script>";
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">';}
		}

} 
else 
{
	// user is not logged in, send the user to the login page
	/*echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';*/
	header('Location: adminIOE.html');
}
?>	