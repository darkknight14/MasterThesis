<?php

	session_start();
	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		// user is logged in
		include("header.php"); 
		include("nav.php");
		include("connection.php");
		
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		header('Location: adminIOE.html');
	}

?>