<?php

	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		include('connection.php');
		include('header.php');
		include('nav.php');
		?>
		<div class="alert alert-danger lead" style=" margin:15px; border-radius: 32px 7px 7px 7px; color: #000000;">
				Deleting all tables in Master Science Thesis database?
		</div>
		<!-- Button trigger modal -->
<button class="btn btn-danger" style="font-size: 24px; float: right; margin: 20px; " data-toggle="modal" data-target="#DeleteThesis">
  DROP TABLES
</button>

<!-- Modal -->
<div class="modal fade" id="DeleteThesis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title lead h2" id="exampleModalLabel">Are you absolutely sure ?</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      	<div class="modal-body">
        		<style>
					.login-form {
						width: 300px;
						margin: 0 auto;
						font-family: Tahoma, Geneva, sans-serif;
					}
					.login-form h1 {
						text-align: center;
						color: #4d4d4d;
						font-size: 24px;
						padding: 20px 0 20px 0;
					}
					.login-form input[type="password"],
					.login-form input[type="text"] {
						width: 100%;
						padding: 15px;
						border: 1px solid #dddddd;
						margin-bottom: 15px;
						box-sizing:border-box;
					}
					.login-form input[type="submit"] {
						width: 100%;
						padding: 15px;
						background-color: #535b63;
						border: 0;
						box-sizing: border-box;
						cursor: pointer;
						font-weight: bold;
						color: #ffffff;
					}
				</style>
				<div class="login-form">
					<h1>Login </h1>
					<form action=" " method="post">
						<input type="text" name="username" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<input type="submit" value="I am responsible.">
					</form>
				</div>
      	</div>
    </div>
  </div>
</div>



		<?php
		#authenticate delete confirmation 
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'phplogin';


	$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	if ( mysqli_connect_errno())
		die ('Failed to connect to database :(  ' . mysqli_connect_error());


	// Prepare our SQL 
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
	{
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute(); 
		$stmt->store_result(); 

		if ($stmt->num_rows > 0)
		{
			$stmt->bind_result($pw_id, $password);
			$stmt->fetch();      
			
			// Account exists, now we verify the password.
			if (password_verify($_POST['password'], $password))
			{
				// Verification success! admin now can delete!
				
				$q1="DELETE FROM area";
				$q2="DELETE FROM thesis";
				/*$q3="DELETE FROM thesis_has_area";
				$q4="DELETE FROM status";*/
				$q5="DELETE FROM supervisor";
				$q6="DELETE FROM student";
				/*$q7="DELETE FROM student_writes_thesis";*/
				$r1=mysqli_query($conn, $q1);
				$r2=mysqli_query($conn, $q2);
				/*$r3=mysqli_query($conn, $q3);
				$r4=mysqli_query($conn, $q4);*/
				$r5=mysqli_query($conn, $q5);
				$r6=mysqli_query($conn, $q6);
				/*$r7=mysqli_query($conn, $q7);*/

				if($r1 and $r2 /*and $r3 and $r4 and*/ and $r5 and $r6 /*and $r7*/)
				{
					echo'<script> alert("All tables in database deleted...");</script>';
					session_destroy();
					?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/adminIOE.html"><?php
				
				}
				else
				{
					echo'<div class="alert alert-info" style="margin:110px; font-size:24px; border-radius: 32px 7px 7px 7px;"> Couldnot drop database.</div>';
				}
			}
		}
	} 
}
	else 
	{
		// user is not logged in, send the user to the login page
		echo '<script> alert("You were not logged in !!!"); </script>';
		header('Location: adminIOE.html');
	}

?>