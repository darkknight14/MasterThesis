<?php
session_start();
error_reporting(0);
/*include('./PHPMailer-master/src/PHPMailer.php');
include('./PHPMailer-master/src/Exception.php');
include('./PHPMailer-master/src/SMTP.php');
include('./PHPMailer-master/src/POP3.php');
include('./PHPMailer-master/src/OAuth.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/

if($_SESSION['loggedin'])
{
	include('connection.php');
	include('header.php');
	include('nav.php');
	$id=$_GET["thesis_id"];	

	$thesis_query= "SELECT thesis.title title, supervisor.title w, supervisor.first_name x, supervisor.middle_name y, supervisor.last_name z 
	, student_writes_thesis.stud_batch batch, student_writes_thesis.stud_depart dpt ,student_writes_thesis.stud_rollno rn
	, area.name area, status.mid_term mid, status.final fin
	FROM thesis 
	INNER JOIN supervisor ON supervisor.id=thesis.sup_id
	INNER JOIN student_writes_thesis ON student_writes_thesis.thesis_id=thesis.id
	INNER JOIN thesis_has_area ON thesis_has_area.thesis_id=thesis.id
	INNER JOIN area ON thesis_has_area.area_id=area.id
	INNER JOIN status ON status.thesis_id=thesis.id
	WHERE thesis.id='$id'

	";
	$thesis_res=mysqli_query($conn, $thesis_query);
	$rown= mysqli_fetch_assoc($thesis_res);
	$thesis_title=$rown["title"];
	$thesis_supervisor=$rown["w"].' '.$rown["x"]. ' '.$rown["y"].''.$rown["z"];
	$std=$rown['batch'].$rown['dpt'].$rown['rn'];
	$area=$rown['area'];
	$mid=$rown['mid'];
	$fin=$rown['fin'];
	
	?>

<div class="container" style=" ">
	<div class="alert alert-info lead h5 " style=" margin-top:20px; padding: 13px;  border-radius: 32px 7px 7px 7px; ">

		<h6 class="lead h5 "><?php echo $id.'. Thesis: '. $thesis_title; ?></h6>
		<hr>
		<p><?php echo 'Supervisor: '.$thesis_supervisor; ?></p>
		<p><?php echo 'Student: '.$std; ?></p>
		<p><?php echo 'Area: '.$area; ?></p>
		<p><?php echo 'Midterm: '.$mid; ?></p>
		<p><?php echo 'Finalterm: '.$fin; ?></p> 
	</div>
</div>

<!-- Button trigger modal -->
<a href="#" style="font-size: 24px; float: right; margin: 20px; " data-toggle="modal" data-target="#DeleteThesis">
  Delete
</a>

<!-- Modal -->
<div class="modal fade" id="DeleteThesis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lead h2" id="exampleModalLabel">Are you sure ?</h5>
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
						<input type="submit" value="DELETE">
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
				$q="DELETE FROM thesis WHERE thesis.id='$id' ";
				$r=mysqli_query($conn, $q);
				
				if($r)
				{
					echo'<script> alert("'.$id.'. Thesis '.$thesis_title.' by '. $std.' supervised by '. $thesis_supervisor.' has been deleted. ");</script>';
				
				
				/*IN order to send mail whenever record is deleted*/		

				/*$mail = new PHPMailer(True);

				// Send mail using Gmail
				try{
									
						//Create a new PHPMailer instance
						$mail = new PHPMailer;

						//Tell PHPMailer to use SMTP
						$mail->isSMTP();

						//Enable SMTP debugging
						// 0 = off (for production use)
						// 1 = client messages
						// 2 = client and server messages
						$mail->SMTPDebug = 2;

						//Set the hostname of the mail server
						$mail->Host = 'smtp.gmail.com';
						
						// use
						// $mail->Host = gethostbyname('smtp.gmail.com');
						// if your network does not support SMTP over IPv6
						//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
						$mail->Port = 587;

						//Set the encryption system to use - ssl (deprecated) or tls
						$mail->SMTPSecure = 'tls';

						//Whether to use SMTP authentication
						$mail->SMTPAuth = true;

						//Username to use for SMTP authentication - use full email address for gmail
						$mail->Username = "YYY@gmail.com";

						//Password to use for SMTP authentication
						$mail->Password = "*********";

						//Set who the message is to be sent from
						$mail->setFrom('YYY@gmail.com', 'Name');

						//Set an alternative reply-to address
						/*$mail->addReplyTo('to@example.com', 'First Last');

						//Set who the message is to be sent to
						$mail->addAddress('XXX@gmail.com', 'Name');

						//Set the subject line
						$mail->Subject = 'PHPMailer GMail SMTP test';

						//Read an HTML message body from an external file, convert referenced images to embedded,
						//convert HTML into a basic plain-text alternative body
						$mail->msgHTML('<h1>Shristi </h1>');


						//Replace the plain text body with one created manually
						$mail->AltBody = 'This is a plain-text message body';
						
						//Attach an image file
						$mail->addAttachment('images/phpmailer_mini.png');

					    $mail->send();
					    echo 'Message has been sent';

				}
				catch (Exception $e) 
				{
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}*/

			
				?>

					<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/showWrites.php">

				<?php
				}
				else{
					echo '<scrip> alert("Error deleting record: '. mysqli_error($conn).'");</script>';?>	
				<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/deleteThesis.php?thesis_id=<?php echo $id; ?> ">
			<?php
					}
				
			} 
			else
			{
				?>
					<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/project/deleteThesis.php?thesis_id=<?php echo $id; ?> ">
				<?php
				
				echo '<div class="alert alert-danger">No match in username or password! </div>';
			}
		} 
		/*else
		{
			echo '<div class="alert alert-danger">No such admin ! </div>';
		}*/
	}
else{
		echo '<div class="alert alert-warning">Unable to process sql query</div>';

	} 

}
else{


}



?>	