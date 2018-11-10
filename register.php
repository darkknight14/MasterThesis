<?php
// Change this to your connection info.
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'phplogin';
// Try and connect using the info above.
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno)
	{
		die ('Oops error in database connection :( ' . $mysqli->connect_errno);
	}
// Now we check if the data was submitted, isset will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) 
	{
		die ('Please complete the registration form!<br><a href="register.html">Back</a>');
	}

//non empty fields submission check
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) 
	{
		die ('Please complete the registration form!<br><a href="register.html">Back</a>');
	}

// fields validation 
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
{
	die ('Email is not valid!<br><a href="register.html">Back</a>');
}

if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    die ('Username is not valid!<br><a href="register.html">Back</a>');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	die ('Password must be between 5 and 20 characters long.<br><a href="register.html">Back</a>');
}

// We need to check if the account with that username exists
if ($stmt = $mysqli->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
	{
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute(); 
		$stmt->store_result(); 
		// Store the result so we can check if the account exists in the database.
		if ($stmt->num_rows > 0)
			echo 'Username exists, please choose another!<br><a href="register.html">Back</a>';
		else 
		{
			// Username doesnt exists, insert new account
			if ($stmt = $mysqli->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) 
			{
				// We don't want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
				$stmt->execute();
				echo 'You have successfully registered, you can now login!<br><a href="index.html">Login</a>'; //add login page url after successful register 
			} 
			else
				echo 'Could not prepare statement!';
		}
		$stmt->close();
	} 
else
	echo 'Could not prepare statement!';

$mysqli->close();
?>
