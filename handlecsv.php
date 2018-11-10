<?php
session_start();
error_reporting(0);
if ($_SESSION['loggedin']) 
{
	include('connection.php');
	if($_POST['submit'])
	{

		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		while(($csvdata = fgetcsv($handle, 1000, ",")) != FALSE){
			$suptit = $csvdata[0];
			$supfn = $csvdata[1];
			$supmn  = $csvdata[2];
			$supln = $csvdata[3];
			$tt = $csvdata[4];
			$sb = $csvdata[5];
			$sd = $csvdata[6];
			$srn = $csvdata[7];
			$fn = $csvdata[8];
			$mn = $csvdata[9];
			$ln = $csvdata[10];
			$md = $csvdata[11];
			$fd = $csvdata[12];

			$querystudent = "INSERT INTO student VALUES ('$sb', '$sd','$srn', '$fn', '$mn', '$ln')";
			$insertstudent = mysqli_query($conn, $querystudent);

			$findsupervisor = "SELECT    id
					FROM  supervisor
					where supervisor.title = '$suptit' and supervisor.first_name = '$supfn' and supervisor.middle_name = '$supmn' and supervisor.last_name = '$supln'";

			$queryfindsup = mysqli_query($conn, $findsupervisor);
			$record0 = mysqli_num_rows($queryfindsup);
			if($record0 != 0){
				$fetch = mysqli_fetch_assoc($queryfindsup);	
				$sup_id = $fetch['id'];
				$insertsupervisor = 1;	
			}
			else{
				$query1 = "SELECT    *
						FROM      supervisor
						ORDER BY  id DESC
						LIMIT     1";

				$lastrow1 = mysqli_query($conn , $query1);
				$record1 = mysqli_num_rows($lastrow1);
				if($record1 != 0){
					$fetch = mysqli_fetch_assoc($lastrow1);
					$lastrow_id = $fetch['id']; 
					$sup_id = $lastrow_id + 1 ;
				}
				elseif($records == 0){
					$sup_id = 1; 
				}
				$querysup = "INSERT INTO supervisor VALUES ('$sup_id','$suptit', '$supfn','$supmn','$supln') ";
				$insertsupervisor = mysqli_query($conn, $querysup);
			}

			if($insertsupervisor){
				$query3 = "SELECT    *
					FROM      thesis
					ORDER BY  id DESC
					LIMIT     1";

				$lastrow3 = mysqli_query($conn , $query3);
				$record3 = mysqli_num_rows($lastrow3);
				if($record3 != 0){
					$fetch = mysqli_fetch_assoc($lastrow3);
					$lastrow_id = $fetch['id']; 
					$thesis_id = $lastrow_id + 1 ;
				}
				elseif($records == 0){
					$thesis_id = 1; 
				}
				
				$querythesis = "INSERT INTO thesis VALUES ('$thesis_id','$sup_id', '$tt') ";
				$insertthesis = mysqli_query($conn, $querythesis);

			}

			if($insertthesis){
				$querystatus = "INSERT INTO status VALUES ('$thesis_id','$md', '$fd')";
				$insertstatus = mysqli_query($conn, $querystatus);
			}
			

			if($insertstudent and $insertthesis){
				$query4 = "SELECT    *
				FROM      student_writes_thesis
				ORDER BY  writes_id DESC
				LIMIT     1";
				$lastrow4 = mysqli_query($conn , $query4);
				$record4 = mysqli_num_rows($lastrow4);
				if($record4 != 0){
					$fetch = mysqli_fetch_assoc($lastrow4);
					$lastrow_id = $fetch['writes_id']; 
					$writes_id = $lastrow_id + 1 ;
				}
				elseif($record4 == 0){
					$writes_id = 1; 
				}
				$querywrites = "INSERT INTO student_writes_thesis VALUES ('$writes_id', '$sb','$sd','$srn','$thesis_id')" ;
				$insertwrites = mysqli_query($conn, $querywrites);
			}
			
			$areano = sizeof($csvdata) - 13;

			for($i = 13; $i<sizeof($csvdata); $i++){
				$findarea = "SELECT id from area where name = '$csvdata[$i]'";
				$queryarea = mysqli_query($conn, $findarea);
				$record01 = mysqli_num_rows($queryarea);

				if($record01 != 0 ){
					$fetch = mysqli_fetch_assoc($queryarea);	
					$area_id = $fetch['id'];

					$inserthasarea = "INSERT INTO thesis_has_area VALUES ('$thesis_id','$area_id')";
					$queryhasarea = mysqli_query($conn, $inserthasarea);
				}
			
				else{

					$query2 = "SELECT    *
					FROM      area
					ORDER BY  id DESC
					LIMIT     1";

					$lastrow2 = mysqli_query($conn , $query2);
					$record2 = mysqli_num_rows($lastrow2);
					if($record2 != 0){
						$fetch = mysqli_fetch_assoc($lastrow2);
						$lastrow_id = $fetch['id']; 
						$area_id = $lastrow_id + 1 ;
					}
					elseif($record2 == 0){
						$area_id = 1; 
					}
					$insertarea = "INSERT INTO area VALUES ('$area_id','$csvdata[$i]')";
					$queryarea = mysqli_query($conn, $insertarea);

					$inserthasarea = "INSERT INTO thesis_has_area VALUES ('$thesis_id','$area_id')";
					$queryhasarea = mysqli_query($conn, $inserthasarea);
				}
			}

			echo("<script>alert('Data has been inserted.')</script>") ;

				?>
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/">
				
			</META>
				<?php

		}

	}

} 
else {
	// user is not logged in, send the user to the login page
	header('Location: adminIOE.php');
}

?>
