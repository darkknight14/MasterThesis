<?php
	session_start();
	if ($_SESSION['loggedin']) 
		{


				include('header.php');
				include('nav.php');
				error_reporting(0);	
				
				
				$area = $_POST['area'];
				if($area)
				{
					 SearchByArea($area);
				}
				else
				{

					echo '<hr>
				<div class="alert alert-warning" style="margin:30px;"> <h2>No results </h2></div> <hr>';

				}
				function SearchByArea($area)
				{

					include('connection.php');
					echo'<div class="alert alert-light container lead"><h3 class="h3" >Area for thesis<h3></div>
				<form class="form-inline" method="POST" action ="CustomSearchArea.php" style="float:right; margin:20px;">
					<label class="sr-only" for="inlineFormInputName2">Name</label>
					<input type="text" class="form-control" id="area" name="area" placeholder="E.g. Image Processing">
				<button type="submit" class="btn btn-primary">Search</button>
				</form>';

					$query1 = "SELECT DISTINCT * FROM area WHERE area.name LIKE '%$area%'";

					$data =  mysqli_query($conn, $query1);
					$records = mysqli_num_rows($data);
					if($records != 0){
						?>
							<table class="table" style="width: 700px; padding-left : 20px;">
							    <tr>
							    	<th scope="col">S.N</th>
								   <th scope="col">Area Name</th>
							      <th scope="col">Operation</th>
							    </tr>
						<?php
						$sn = 0; 
						while($fetch = mysqli_fetch_assoc($data))
						{
							
							echo "<tr>
									<td>".++$sn."</td>
									<td>".$fetch['name']."</td>
								 	<td><a href='areaDetails.php?area_id=$fetch[id]'>View Thesis</a></td>
								  </tr>";
						}
					
					}
					else
					{
						echo "<div class='alert alert-primary' style='position: absolute; top: 460px; left: 315px;'>Zero results .</div>";
					}
							
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