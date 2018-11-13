<?php

	session_start();
	// check to see if the user is logged in
	if ($_SESSION['loggedin']) 
	{
		// user is logged in
		include("header.php"); 
?>

<div class="alert alert-warning" id="Session_Name" style=" margin-top: 50px">
  <strong>
    <?php 
      echo '<h5 class="lead"> You are logged in as '.  $_SESSION['name'] . ' !</h5>';
    ?>
  </strong>
</div>

<script type="text/javascript">

$("#Session_Name").show();

setTimeout(function() { $("#Session_Name").hide(); }, 3000);


</script>



<?php



		include("nav.php");
		include("connection.php");
		
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		header('Location: adminIOE.html');
	}

?>