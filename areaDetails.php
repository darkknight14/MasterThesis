<?php
	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{


		include('header.php');
		include('nav.php');
		include("connection.php");

		$id = $_GET['area_id'];

		$query = "SELECT title thesis_title, thesis.id t_id
		FROM area 
		INNER JOIN thesis_has_area on area.id = thesis_has_area.area_id
		INNER JOIN thesis on thesis_has_area.thesis_id = thesis.id
		WHERE area.id = '$id'" ;

		$data = mysqli_query($conn, $query);
		$records = mysqli_num_rows($data);

		$query_area="SELECT * FROM area WHERE id='$id' ";
		$res_area=mysqli_query($conn, $query_area);
		$row_area=mysqli_fetch_assoc($res_area);
		$area_name=$row_area['name'];

		
		if($records != 0){
		?>		
				<h4 class="lead" style="padding: 7px;"><?php echo $area_name; ?></h4>

				<div>
				<table class="table">
				    <tr>
				      <th>S.N.</th>
				      <th>Thesis ID</th>
				      <th scope="col">Thesis Title</th>
				    </tr>
		<?php
				$sn = 0;
			while($fetch = mysqli_fetch_assoc($data))
			{ 
				echo "<tr>
						<td>".++$sn."</td>
						<td>".$fetch['t_id']."</td>
						<td>".$fetch['thesis_title']."</td>
					  </tr>";
			}
		
		}

		else{
			echo "<script>alert('Thesis under this area not found.')</script>";
		?>
			<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showArea.php">

		<?php
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
		header('Location: adminIOE.php');
		
	}
?>
