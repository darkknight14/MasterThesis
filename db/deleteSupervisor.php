<?php
	include("connection.php");
	$id = $_GET['id'];
	$query = "DELETE FROM supervisor WHERE id='$id' ";

	$delete = mysqli_query($conn, $query);

	if($delete){
		echo "<script>alert('Record Deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showSupervisor.php">

		<?php
	}

	else{
		echo "<script>alert('Record Not Deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showSupervisor.php">

		<?php
	}

?>	