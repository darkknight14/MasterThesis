<?php
	include("connection.php");
	?>

<?php	
	$id = $_GET['thesis_id'];
	$batch=$_GET['batch'];

	$query = "UPDATE status SET mid_term = '0000-00-00' , final = '0000-00-00' WHERE thesis_id='$id'";

	$delete = mysqli_query($conn, $query);

	if($delete){
		echo "<script>alert('Status Cleared.')</script>";
		?>

		<?php echo('<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/updateStatusbyBatch.php?batch='.$batch.'">');
		
		?>
		<?php
	}

	else{
		echo "<script>alert('Status not deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showStatus.php">

		<?php
	}

?>	