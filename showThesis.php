<?php

	session_start();

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
	

	include("header.php");
	include("nav.php");
	include("connection.php");

	error_reporting(0);

	$query = "SELECT DISTINCT supervisor.id sup_id, thesis.id id, thesis.title thesis_title, supervisor.title sup_title, first_name, middle_name, last_name FROM thesis 
	INNER JOIN supervisor on thesis.sup_id = supervisor.id";

	$data = mysqli_query($conn, $query);
	$records = mysqli_num_rows($data);
	//$fetch = mysqli_fetch_assoc($data);

	if($records != 0){
		?>
			<table class="table" style="width: 1200px; padding-left : 20px;">
			    <tr>
			    	<th scope="col">S.N</th>
			      <th scope="col">Supervisor Name</th>
			      <th scope="col">Title</th>
			      <th colspan="2">Operation</th>
			    </tr>
		<?php
		$sn = 0;
		while($fetch = mysqli_fetch_assoc($data)){
			$super_name = $fetch['sup_title'].' '.$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
			echo "<tr>
					<td>".++$sn."</td>
					<td>".$super_name."</td>
					<td>".$fetch['thesis_title']."</td>
				 	<td><a href='updateThesis.php?id=$fetch[id]&ttl=$fetch[thesis_title]&sup_name=$fetch[sup_title] $fetch[first_name] $fetch[middle_name] $fetch[last_name]'><img src='icon/update.svg'></a></td>
				 	<td><a href='deleteThesis.php?id=$fetch[id]' onclick='return checkDelete()'><img src='icon/delete.svg'></a></td>
				  </tr>";
		}
	
	}

	else{
		echo "No record has been found.";
	}
?>
		</table>
	</body>
</html>

	<script type="text/javascript">
		function checkDelete(){
			return confirm('Delete this Record?');}
		

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