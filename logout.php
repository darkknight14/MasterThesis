<?php
	session_start();
	error_reporting(0);	

	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		echo '<div class="alert alert-warning "> Your logged in session ended.</div>';
		session_destroy();
		header('Location: adminIOE.html');
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}

?>