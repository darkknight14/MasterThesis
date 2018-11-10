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

		<form enctype="multipart/form-data" method="POST" role="form" action="">
          <div class="form-group">

            <div class="alert alert-warning" role="alert">
              Upload .sql file
            </div>
           
            <input type="file" class="form-control-file" id="file" name="file" required> 
            <button type="submit" class="btn btn-primary" style="margin: 2px;  " name="submit" value="submit">Upload</button>
             
          </div>
        </form>

		<?php
		if(isset($_POST['submit']))
		{
			$file="sqlfile.sql";
			$sql = file_get_contents($file);

			/* execute multi query */
			if ($conn->multi_query($sql)) {
			    echo "success sql upload";
			} else {
			   echo "error in sql upload";
			}
		}
		
		


		
	} 
	else 
	{
		// user is not logged in, send the user to the login page
		echo '<div class=" alert alert-warning "> You were not logged in !!!</div>';
		header('Location: adminIOE.html');
	}

?>