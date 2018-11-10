<?php
session_start();
error_reporting(0);

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'phplogin';


$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ( mysqli_connect_errno())
	die ('Failed to connect to database :(  ' . mysqli_connect_error());

// Now we check if the data was submitted, isset will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) )
	die ('Username and/or password does not exist!');

// Prepare our SQL 
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
	{
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute(); 
		$stmt->store_result(); 

		if ($stmt->num_rows > 0)
		{
			$stmt->bind_result($id, $password);
			$stmt->fetch();      
			
			// Account exists, now we verify the password.
			if (password_verify($_POST['password'], $password))
			{
				// Verification success! User has loggedin!
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				
				// check to see if the user is logged in
				if ($_SESSION['loggedin']) 
				{

					header('Location: IOEadmin.php');
				} 
				else {
					// user is not logged in, send the user to the login page
					header('Location: adminIOE.php');
				}

						
			} 
			else
			{
				echo 'Incorrect username and/or password!';
			}
		} 
		else
		{
			echo 'Incorrect username and/or password!';
		}
	} 
else
	{
		echo 'Could not prepare statement!';
	}
?>
