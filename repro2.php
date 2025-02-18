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


if (isset($_POST["submit"])) {

	$path = 'upload/' . $_FILES["resume"]["name"];
	move_uploaded_file($_FILES["resume"]["tmp_name"], $path);
	$message = '
		<h3 align="center">Printout Details</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
			<tr>
				<td width="30%">Name</td>
				<td width="70%">' . $_POST["name"] . '</td>
			</tr>
			<tr>
				<td width="30%">Paper Type</td>
				<td width="70%">' . $_POST['type'] . '</td>
			</tr>
			<tr>
				<td width="30%">Printing Sides</td>
				<td width="70%">' . $_POST["side"] . '</td>
			</tr>
			<tr>
				<td width="30%">Paper Color</td>
				<td width="70%">' . $_POST["color"] . '</td>
			</tr>
			<tr>
				<td width="30%">Copies</td>
				<td width="70%">' . $_POST["copies"] . '</td>
			</tr>
			<tr>
				<td width="30%">Phone Number</td>
				<td width="70%">' . $_POST["mobile"] . '</td>
			</tr>
			<tr>
				<td width="30%">Additional Information</td>
				<td width="70%">' . $_POST["additional_information"] . '</td>
			</tr>
			<tr>
				<td width="30%">Token</td>
				<td width="70%">' . $_POST["token"] . '</td>
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
	if ($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<div class="alert alert-success">Submitted Successfully</div>';
		unlink($path);
	} else {
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
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<style>
	body {
		background-position: center;
		background-size: cover;
		height: 100vh;
		width: 100%;
		background-color: #F4F4F4;
	}

	.file {
		font-size: 16px;
		outline: none;
		border: 1px solid black;
		border-radius: 10px;
		width: 100%;
		box-shadow: 2px 2px 6px black;
	}

	::-webkit-file-upload-button {
		color: white;
		background: red;
		border-radius: 10px;
		border: none;
		outline: none;
		padding: 5px 15px;
	}

	.btn {
		width: 100%;
	}

	@media (max-width:1000px) {
		.row h3 {
			font-size: 50px;
		}

		.row label {
			font-size: 30px;
		}

		.row input {
			height: 70px;
			font-size: 30px;
			border: 1px solid rgba(0, 0, 0, 0.597);
		}

		.row select {
			height: 70px;
			font-size: 30px;
			border: 1px solid rgba(0, 0, 0, 0.597);
		}

		.row textarea {
			font-size: 30px;
			border: 1px solid rgba(0, 0, 0, 0.597);
		}

		.row .file {
			height: 45px;
		}
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
				<form method="post" enctype="multipart/form-data" id="paymentForm">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Enter Name*</label>
								<input type="text" name="name" placeholder="Name" class="form-control required-field" required />
							</div>

							<div class="form-group">
								<label>Roll_no*</label>
								<input type="text" name="roll" placeholder="Roll_no" class="form-control required-field" required />
							</div>

							<div class="form-group">
								<label>Paper Type*</label>
								<select name="type" id="paper_type" class="form-control required-field" required>
									<option value="A4">A4 Sheet (210 x 297 millimeters)</option>
									<option value="A3">A3 Sheet (297 x 420 millimeters)</option>
								</select>
							</div>

							<div class="form-group">
								<label>Printing Sides*</label>
								<select name="side" id="side" class="form-control required-field" required>
									<option value="Single Side">Single side</option>
									<option value="Double Side">Double side</option>
								</select>
							</div>

							<div class="form-group">
								<label>Paper Color*</label>
								<select name="color" id="color" class="form-control required-field" required>
									<option value="Black and White">Black and White</option>
									<option value="Color">Color</option>
								</select>
							</div>

							<div class="form-group">
								<label>No of Copies*</label>
								<input type="number" name="copies" id="copies" placeholder="Copies" class="form-control required-field" required />
							</div>

							<div class="form-group">
								<label>Mobile Number*</label>
								<input type="text" name="mobile" placeholder="Mobile Number" class="form-control required-field" pattern="\d*" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Select Your Document*</label>
								<input type="file" id="file" class="file required-field file-input" name="resume" accept=".pdf ,.png,.jpg,.jpeg" required />
							</div>
							<div class="form-group">
								<label>Additional Information</label>
								<textarea name="additional_information" placeholder="Enter Additional Information" class="form-control"></textarea>
							</div>
							<br>

							<div>
								<a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now disabled" data-id="1"><label>Pay ₹<span id="total_price">0</span></label></a><br>
							</div>
							<br>
							<br>
							<div class="form-group" id="token-field" style="display: none;">
								<label>Your Token*</label>
								<input type="text" name="token" placeholder="Enter Token" class="form-control" required readonly />
							</div>
						</div>
					</div>

					<div class="form-group" align="center">
						<a href="indexrepro.html"><input type="button" name="Cancel" value="Cancel" class="btn btn-info" style="background-color: red;" /></a>
						<input type="submit" name="submit" value="Submit" class="btn btn-info buy_now1 disabled" style="background-color: red;" />
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<!-- Include pdf.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    let pagec = 0;

    // Function to calculate price
    function calculatePrice() {
        let copies = parseInt(document.getElementById('copies').value) || 0;
        let paperType = document.getElementById('paper_type').value;
        let side = document.getElementById('side').value;
        let color = document.getElementById('color').value;

        let pricePerCopy = 0;

        // Price calculation logic based on paper type, side, and color
        if (paperType === "A4") {
            if (side === "Single Side" && color === "Black and White") {
                pricePerCopy = 1; // A4 single side B&W
            } else if (side === "Double Side" && color === "Black and White") {
                pricePerCopy = 2; // A4 double side B&W
            } else if (side === "Single Side" && color === "Color") {
                pricePerCopy = 10; // A4 single side Color
            } else if (side === "Double Side" && color === "Color") {
                pricePerCopy = 20; // A4 double side Color
            }
        } else if (paperType === "A3") {
            if (side === "Single Side" && color === "Black and White") {
                pricePerCopy = 10; // A3 single side B&W
            } else if (side === "Double Side" && color === "Black and White") {
                pricePerCopy = 20; // A3 double side B&W
            } else if (side === "Single Side" && color === "Color") {
                pricePerCopy = 10; // A3 single side Color
            } else if (side === "Double Side" && color === "Color") {
                pricePerCopy = 20; // A3 double side Color
            }
        }

        let totalPrice = (pricePerCopy * copies) * pagec;
        document.getElementById('total_price').innerText = totalPrice;
    }

    // Function to count pages in PDF
    function countPagesInPDF(file) {
        const fileReader = new FileReader();
        fileReader.onload = function () {
            const typedArray = new Uint8Array(this.result);

            // Load the PDF using pdf.js
            pdfjsLib.getDocument(typedArray).promise.then(function (pdf) {
                pagec = pdf.numPages;
                console.log("PDF Page Count: ", pagec);
                calculatePrice(); // Call the price calculation only after pages are counted
            }).catch(function (error) {
                console.error('Error counting pages in PDF:', error);
                alert('Error processing PDF file.');
            });
        };
        fileReader.readAsArrayBuffer(file);
    }

    // Handle file upload
    document.getElementById('file').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const fileType = file.type;

        if (fileType === 'application/pdf') {
            // Count pages for PDF
            countPagesInPDF(file);
        } else if (fileType === 'image/jpeg' || fileType === 'image/png') {
            // For image (JPEG, PNG), count it as 1 page
            pagec = 1;
            calculatePrice(); // Call price calculation after setting page count
        } else {
            alert('Please upload a valid PDF, PNG, or JPG file.');
        }
    });

    // Attach event listeners to update price dynamically
    document.getElementById('copies').addEventListener('input', calculatePrice);
    document.getElementById('paper_type').addEventListener('change', calculatePrice);
    document.getElementById('side').addEventListener('change', calculatePrice);
    document.getElementById('color').addEventListener('change', calculatePrice);

    // Function to enable Pay button if all required fields are filled
    function checkRequiredFields() {
        let allFilled = true;
        $('.required-field').each(function () {
            if ($(this).val() === '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            $('.buy_now').removeClass('disabled');
        } else {
            $('.buy_now').addClass('disabled');
            $('.buy_now1').addClass('disabled');
        }
    }

    $('.required-field').on('input', checkRequiredFields);

    $('body').on('click', '.buy_now', function (e) {
        if ($(this).hasClass('disabled')) {
            alert('Please fill all required fields');
            return;
        }

        var totalAmount = $('#total_price').text();
        var product_id = $(this).attr("data-id");

        // Generate a random token function (4-character token)
        function generateRandomToken() {
            return Math.random().toString(36).substr(2, 4); // Generates a random 4-character token
        }

        var options = {
            "key": "rzp_test_uGKzUWiyJLVGOp",
            "amount": totalAmount * 100, // convert to paise
            "name": "Bit Repro",
            "description": "Payment",
            "image": "https://www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
            "handler": function (response) {
                // Payment succeeded, show token field and set token
                $('input[name="token"]').val(generateRandomToken());
                $('#token-field').show(); // Show the token input field
                $('.required-field').prop('readonly', true); // Set input fields to read-only
                $('.buy_now1').removeClass('disabled'); // Enable the Pay button
            },
            "theme": {
                "color": "#528FF0"
            }
        };

        // Create the Razorpay instance with the options
        var rzp1 = new Razorpay(options);

        // Open the Razorpay payment gateway
        rzp1.open();
        e.preventDefault();

        // Handle payment failure
        rzp1.on('payment.failed', function (response) {
            console.log("Payment failed:", response.error); // Silently log the error
            $('input[name="token"]').val(generateRandomToken()); // Generate a token even on failure
            $('#token-field').show(); // Show the token input field after failure
            $('.required-field').prop('readonly', true); // Set input fields to read-only
            $('.buy_now1').removeClass('disabled'); // Enable the Pay button
        });
    });
</script>


</body>

</html>
