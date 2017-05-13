<?php
function NullOrEmptyString($input){
    return (!isset($input) || trim($input)==='');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(!NullOrEmptyString($_POST["name"]) && !NullOrEmptyString($_POST["company"]) && !NullOrEmptyString($_POST["email"]) && !NullOrEmptyString($_POST["enquiry"])){
	
		if(trim($_POST["human"])===''){//additionally prevent spam//if the hidden field is empty then it is likely submitted by human being
		
			include_once($_SERVER['DOCUMENT_ROOT']."/loggy/PHPMailer/class.phpmailer.php");
			
			// more setting can be found in https://github.com/PHPMailer/PHPMailer
			$mail = new PHPMailer;

			$mail->From = 'info@loggy.com.au';
			$mail->FromName = 'Loggy Landing Page';
			$mail->AddAddress('info@loggy.com.au', 'Info');  // Add a recipient
			$mail->AddAddress('infologgy@gmail.com', 'Info');  // Add a recipient
			$mail->AddBCC('andrew@emoceanstudios.com.au', 'Emocean Test');

			$mail->IsHTML(true);                                  // Set email format to HTML
			
			$mail->Subject = 'New Enquiry From Loggy Landing Page';
			
			$mail->Body    = '<b>Name: </b>'.$_POST["name"].'<br />
							  <b>Company: </b>'.$_POST["company"].'<br />
							  <b>Email: </b>'.$_POST["email"].'<br />
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

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta name="viewport" content="width=1350" />
<meta name="description" content="Loggy is an online vehicle service logbook" />
<title>Loggy Australia</title>
<link rel="shortcut icon" href="/loggy/Loggy-Favicon.png" type="image/png" />
<link href="/loggy/reset.css" rel="stylesheet" type="text/css" />
<link href="/loggy/main.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/loggy/jquery.placeholder.js"></script>
</head>
<body>
<div id="header">
	<div class="full-width-container add-padding-width">
		<a href="/">
			<img id="loggy-logo" src="/loggy/Loggy-Logo.png" alt="loggy logo">
		</a>
		<ul class="menu">
			<li class="menu-item">
				<a href="#what-is-loggy">WHAT IS LOGGY?</a>
			</li>
			<li class="menu-item">
				<a href="#how-can-it-help-you">HOW CAN IT HELP ME?</a>
			</li>
			<li class="menu-item">
				<a href="#contact-us">CONTACT US</a>
			</li>			
		</ul>
	</div>
	<div id="header-background-overlay">
	</div>
</div>
<div id="header-sticky">
	<div class="full-width-container add-padding-width">
		<a href="/">
			<img id="loggy-logo-sticky" src="/loggy/Loggy-Small-Logo.png" alt="loggy logo">
		</a>
		<ul class="menu-sticky">
			<li class="menu-item-sticky">
				<a href="#what-is-loggy">WHAT IS LOGGY?</a>
			</li>
			<li class="menu-item-sticky">
				<a href="#how-can-it-help-you">HOW CAN IT HELP ME?</a>
			</li>
			<li class="menu-item-sticky">
				<a href="#contact-us">CONTACT US</a>
			</li>			
		</ul>
	</div>
</div>
<div id="middle">
	<div>
		<div class="section-title-container"><a name="what-is-loggy" class="anchor-offset"></a> 
			<h2 class="full-width-container">WHAT IS LOGGY?</h2>
		</div>
		<div class="section-content full-width-container add-padding-height">
			<div class="static-left-column" >		
				<img src="/loggy/What-Is-Image-Final.jpg" alt="What is LOGGY">
			</div>
			<div class="static-right-column">
				<div class="static-right-head"><b>Loggy is an online vehicle service logbook</b></div>
				<div class="static-right-content">
					<p>Loggy is Australia's newest and most innovative car profiling and maintenance management service, proven to not only increase efficiency but is also tailor made to suit your sales, customer service and vehicle maintenance scheduling needs.</p>
					<p><b>Loggy provides the creme de la creme of features including:</b></p>
					<p>&#149; Detailed vehicle profiling<br /></p>
					<p>&#149; Vehicle status and maintenance alerts<br /></p>
					<p>&#149; Online bookings, reminders and service invoice uploads<br /></p>
					<p>&#149; Advanced statistics and trends<br /></p>
					<p>&#149; And much more!<br /></p>
				</div>				
			</div>
		</div>
	</div>
	<div>
		<div class="section-title-container"><a name="how-can-it-help-you" class="anchor-offset"></a> 	
			<h2 class="full-width-container">HOW CAN IT HELP ME?</h2>
		</div>
		<div class="section-content full-width-container add-padding-height">
			<div style="margin-bottom: 30px;">
				<div class="static-left-column" >
					<img src="/loggy/Dealers-Image-Final.jpg" alt="LOGGY for Dealers">
				</div>
				<div class="static-right-column">
					<div class="static-right-head"><b>Loggy for Dealers</b></div>
					<div class="static-right-content">
						<p><b>Ease of use / saving time</b></p>				
						<p>You will never miss a beat with our intuitive Vehicle Dashboard feature, all of your inventory is easily viewed and is available right at your finger tips! Intimate details on a car's history are available instantly to take the strain out of searching - relax and let Loggy do all the hard work.</p>
						<p><b>Real Time Work Tracking</b></p>				
						<p>Easily find out when, where, why and who worked on a vehicle, taking out all the guess work and making maintenance a breeze! Status updates are made available on the fly, providing even quicker turn around and improved customer service!</p>
						<p><b>Personalised Customer Service</b></p>				
						<p>Imagine having the ability to let customers know that their 100,000km service is due in 2000kms or that their tyres are due to be rotated in a month. Now you can. Loggy will alert dealers when customers are due for service, to ensure that vehicles are working to optimum standards, ensuring safety and quality!</p>					
					</div>				
				</div>
			</div>
			<div style="margin-bottom: 30px;">
				<div class="static-left-column" >
					<img src="/loggy/Mechanics-Image-Final.jpg" alt="LOGGY for Mechanics">
				</div>
				<div class="static-right-column">
					<div class="static-right-head"><b>Loggy for Mechanics</b></div>
					<div class="static-right-content">
						<p><b>Ease of use / saving time</b></p>				
						<p>Imagine knowing what work has previously been completed to a vehicle the moment it arrives. With Loggy, extensive details are available at a glance, helping to complete your tasks, efficiently and professionally!</p>
						<p><b>Real Time Work Tracking</b></p>				
						<p>The power is now once again in your hands! You will easily be able to know: the average time taken to complete a routine service, the personnel working on a vehicle and the average turnaround of vehicles. Helping you to streamline your business and manage stock efficiently. Vehicle maintenance has changed forever and Loggy is leading the way!</p>
						<p><b>Personalised Customer Service</b></p>				
						<p>With the added convenience of managing large customer inventories, the ability to access a complete vehicle's history and the ease of use of accessing it all within one user friendly interface, Loggy has is bringing vehicle maintenance out of the dark ages! The future is here, the future is now, the future is Loggy!</p>					
					</div>				
				</div>	
			</div>
			<div style="text-align: center;">NOTE: Some of the listed features of Loggy will be implemented and coming online in progressive stages.</div>
		</div>
	</div>
	<div>
		<div class="section-title-container"><a name="contact-us" class="anchor-offset"></a> 
			<h2 class="full-width-container">CONTACT US</h2>
		</div>
		<div class="section-content full-width-container add-padding-height">
			<div class="static-left-column" >
				<img src="/loggy/Contact-Form-Image-Final.jpg" alt="Contact Us">
			</div>
			<div class="static-right-column">
				<div class="static-right-content">
					<p>So what are you waiting for? Drop us a line and one of our friendly consultants will be more than happy to assist.</p>
					<p>To arrange a free appointment you can</p>					
					<p><b>Call us on 1300 462 248</b></p>
					<p>or</p>
					<p><b>Email us</b></p>
					<form id="landing-form" method="post">
						<input type="text" name="name" class="landing-form-input" placeholder="Name">
						<input type="text" name="company" class="landing-form-input" placeholder="Company">
						<input type="text" name="email" class="landing-form-input" placeholder="Email">
						<textarea name="enquiry" class="landing-form-input" placeholder="What is your enquiry?"></textarea>
						<div id="landing-form-submit"></div>
						<input type="text" name="human" class="landing-form-input" placeholder="PLEASE DON'T PUT ANYTHING IN THIS FIELD IF YOU CAN SEE IT">
					</form>
				</div>				
			</div>
		</div>
	</div>	
</div>
<div id="footer">
	<div class="full-width-container add-padding-width">
		<a href="/LANDING-privacy-policy.php" id="privacy-link" target="_blank" style="border-right:0;">Privacy Policy</a>
		<a href="/" target="_blank" style="display:none;">Terms & Conditions</a>
		<span>ABN 64 167 955 178</span>
		<span id="loggy-copy-right">&copy; Loggy <?=date("Y")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Design By <a href="http://www.emoceanstudios.com.au/" target="_blank">Emocean Studios</a></span>
	</div>
</div>
<script>
$(function(){
	$('input, textarea').placeholder();
	$('input[name=human]').hide();
	$('#landing-form-submit').click(function(){
		if(validation()){
			$('#landing-form').submit();
		}
	})
	$(window).scroll(function(){
		sticky_header();
	})	
})

function sticky_header(){
	if($(window).scrollTop() > $("#header").height()){
		$("#header-sticky").slideDown(100);
	}
	else{
		$("#header-sticky").slideUp(100);
	}
}

function validation(){
	a=document.forms["landing-form"]["name"];
	a_regex=/\S/;
	b=document.forms["landing-form"]["company"];
	b_regex=/\S/;	
	c=document.forms["landing-form"]["email"];
	c_regex=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; //stackoverflow standard
	d=document.forms["landing-form"]["enquiry"];	
	d_regex= /\S/;
	
	valid = true;
	$("#landing-form input").css("backgroundColor", "");
	$("#landing-form textarea").css("backgroundColor", "");

	function check (origin, regex){
		if (!regex.test(origin.value) || origin.value == origin.getAttribute("placeholder")){//the second condition only applys when using ie placeholder plugin
			origin.style.backgroundColor="#ff5252";
			valid = false;			
		}
	}
	
	check(a, a_regex);
	check(b, b_regex);
	check(c, c_regex);	
	check(d, d_regex);

	return valid;
}		
</script>
<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-46783652-2']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</body>
</html>