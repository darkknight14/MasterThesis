<?php
	include("connection.php");
	$thesis_id = $_GET['thesis_id'];
	$query = "DELETE FROM writes WHERE thesis_id='$thesis_id' ";

	$delete = mysqli_query($conn, $query);

	if($delete){
		echo "<script>alert('Record Deleted.')</script>";
		?>

		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/MScThesis/showWrites.php">

		<?php
	}

	else{
		echo "Not Deleted.";
	}

?>	