<?php
function NullOrEmptyString($input){
    return (!isset($input) || trim($input)==='');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(!NullOrEmptyString($_POST["name"]) && !NullOrEmptyString($_POST["email"]) && !NullOrEmptyString($_POST["phone"]) && !NullOrEmptyString($_POST["i-am-a"]) && !NullOrEmptyString($_POST["enquiry"])){
	
		if(trim($_POST["human"])===''){//additionally prevent spam//if the hidden field is empty then it is likely submitted by human being
		
			include_once($_SERVER['DOCUMENT_ROOT']."/php/PHPMailer/class.phpmailer.php");
			
			// more setting can be found in https://github.com/PHPMailer/PHPMailer
			$mail = new PHPMailer;

			$mail->From = 'info@loggy.com.au';
			$mail->FromName = 'Loggy Contact Us Page';
			$mail->AddAddress('info@loggy.com.au', 'Info');  // Add a recipient
			$mail->AddBCC('andrew@emoceanstudios.com.au', 'Emocean Check Point');

			$mail->IsHTML(true);                                  // Set email format to HTML
			
			$mail->Subject = 'New Enquiry From Loggy Contact Us Page';
			
			$mail->Body    = '<b>Name: </b>'.$_POST["name"].'<br />
							  <b>Email: </b>'.$_POST["email"].'<br />
							  <b>Phone: </b>'.$_POST["phone"].'<br />
							  <b>He/she is a: </b>'.$_POST["i-am-a"].'<br />
							  <b>Enquiry: </b>'.$_POST["enquiry"].'<br />';

			if(!$mail->Send()) {
				$result = 'Email could not be sent.\n'.'Error Message: ' . $mail->ErrorInfo;
				echo "<script>alert('".$result."');</script>";
			}
			
			echo "<script>alert('Thanks for contacting Loggy Australia!');</script>";
		}
	}
}
?>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/html.php");?>

<body>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/header.php");?>

<div id="middle">
	<div class="text-align-center">
		<div class="section-title-container">
			<h1 class="full-width-container">CONTACT US</h1>
		</div>
		<div class="full-width-container add-padding-height">
			<form class="public-form" method="post" data-parsley-validate>
				<input type="text" name="name" placeholder="Name" required><br /><br />
				<input type="text" name="email" placeholder="Email" data-parsley-type="email" required><br /><br />
				<input type="text" name="phone" placeholder="Phone" data-parsley-type="number" required><br /><br />
				<select name="i-am-a" required>
					<option value="" disabled selected>I am a...</option>
					<option value="Dealer">Dealer</option>
					<option value="Mechanic">Mechanic</option>
					<option value="Customer">Customer who needs to purchase a vehicle soon</option>
					<option value="Owner">Vehicle owner</option>
				</select><br /><br />
				<textarea rows="5" name="enquiry" placeholder="What is your enquiry?" required></textarea><br /><br />
				<input type="submit" value="Submit" class="orange-btn" style="width:200px;">
				<input type="text" name="human" placeholder="PLEASE DON'T PUT ANYTHING IN THIS FIELD IF YOU CAN SEE IT">
			</form>
		</div>
	</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/footer.php");?>

<script src="/js/jquery.placeholder.js"></script>
<script src="/js/parsley.min.js"></script>
<script>
$(function(){
	$('input, textarea').placeholder();
})
</script>

</body>
</html>