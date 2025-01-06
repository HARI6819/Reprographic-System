<?php
//index.php

$message = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["submit"]))
{
	
	$path = 'upload/' . $_FILES["resume"]["name"];
	move_uploaded_file($_FILES["resume"]["tmp_name"], $path);
	$message = '
		<h3 align="center">Printout Details</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
			<tr>
				<td width="30%">Name</td>
				<td width="70%">'.$_POST["name"].'</td>
			</tr>
			<tr>
				<td width="30%">Paper Type</td>
				<td width="70%">'.$_POST['type'].'</td>
			</tr>
			<tr>
				<td width="30%">Printing Sides</td>
				<td width="70%">'.$_POST["side"].'</td>
			</tr>
			<tr>
				<td width="30%">Paper Color</td>
				<td width="70%">'.$_POST["color"].'</td>
			</tr>
			<tr>
				<td width="30%">Copies</td>
				<td width="70%">'.$_POST["copies"].'</td>
			</tr>
			<tr>
				<td width="30%">Phone Number</td>
				<td width="70%">'.$_POST["mobile"].'</td>
			</tr>
			<tr>
				<td width="30%">Additional Information</td>
				<td width="70%">'.$_POST["additional_information"].'</td>
			</tr>
			<tr>
				<td width="30%">Token</td>
				<td width="70%">'.$_POST["token"].'</td>
			</tr>
		</table>
	';
	

	$mail = new PHPMailer(true);
	$mail->isSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';		            //Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = 587;								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'harimass2267@gmail.com';	    //Sets SMTP username
	$mail->Password = 'krteewylxzcpilhw';			//Sets SMTP password
	$mail->SMTPSecure = 'tls';						//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'haidhivya22@gmail.com';					//Sets the From email address for the message
	$mail->FromName = $_POST["name"];				//Sets the From name of the message
	$mail->AddAddress('haridhivya22@gmail.com');		//Adds a "To" address
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->isHTML(true);							//Sets message type to HTML
	$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Bitrepro';				//Sets the Subject of the message
	$mail->Body = $message;							//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<div class="alert alert-success">Submitted Successfully</div>';
		unlink($path);
	}
	else
	{
		$message = '<div class="alert alert-danger">There is an Error</div>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Send Email with Attachment in PHP using PHPMailer</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<style>
		.file{
			font-size: 16px;
			outline: none;
			border: 1px solid black;
			border-radius: 10px;
			width: 100%;
			box-shadow: 2px 2px 6px black;
		}
		::-webkit-file-upload-button{
			color: white;
			background: red;
			border-radius: 10px;
			border: none;
			outline: none;
			padding: 5px 15px;
		}
	</style>
	<body>
		<br />
		<div class="container">
			<div class="row">
				<div class="col-md-8" style="margin:0 auto; float:none;">
					<h3 align="center">Printout Properties</h3>
					<br />
					<?php print_r($message); ?>
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Enter Name</label>
									<input type="text" name="name" placeholder="Enter Name" class="form-control" required />
								</div>
								
								<div class="form-group">
									<label>Paper Type</label>
									<select name="type" class="form-control" required>
										<option value="A4 Sheet">A4 Sheet (210 x 297 millimeters)</option>
										<option value="A3 Sheet">A3 Sheet (297 x 420 millimeters)</option>
									</select>
								</div>
						

							
								<div class="form-group">
									<label>Printing Sides</label>
									<select name="side" class="form-control" required>
										<option value="Single Side">Single side</option>
										<option value="Double side">Double side</option>
									</select>
								</div>
								<div class="form-group">
									<label>Paper Color</label>
									<select name="color" class="form-control" required>
										<option value="Black and White">Black and White</option>
										<option value="Color">Color</option>
									</select>
								</div>

								
								<div class="form-group">
								<label>No of Copies</label>
									<input type="number" name="copies" placeholder="Number of copies" class="form-control"  required />
								
								</div>
								<div class="form-group">
									<label>Enter Mobile Number</label>
									<input type="text" name="mobile" placeholder="Enter Mobile Number" class="form-control" pattern="\d*" required />
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Select Your Document</label>
									<input type="file" class="file" name="resume" accept=".doc,.docx, .pdf ,.png,.jpg" required />
								</div>
								<div class="form-group">
									<label>Enter Additional Information</label>
									<textarea name="additional_information" placeholder="Enter Additional Information" class="form-control" required rows="8"></textarea>
								</div>
								<div class="form-group">
									<label>Enter Token</label>
									<input type="text" name="token" placeholder="Enter Token" class="form-control" required />
									<?php echo bin2hex(random_bytes(2));?>
								</div>
							</div>
						</div>
						<div class="form-group" align="center">
						<a href="indexrepro.html"><input type="button" name="Cancel" value="Cancel" class="btn btn-info" style="background-color: red;"/></a>
							<input type="submit" name="submit" value="Submit" class="btn btn-info" style="background-color: red;"/>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

