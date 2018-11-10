<?php
	include("connection.php");
	$id = $_GET['id'];
	$query = "DELETE FROM student_writes_thesis WHERE id='$id' ";

	$delete = mysqli_query($conn, $query);

	if($delete){
		echo "<script>alert('Record Deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showThesis.php">

		<?php
	}

	else{
		echo "<script>alert('Record Not Deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showThesis.php">

		<?php
	}

?>	