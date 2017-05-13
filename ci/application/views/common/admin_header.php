<?php header("Content-Type: text/html; charset=utf-8");?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta name="viewport" content="width=1200, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Admin Dashboard - Loggy Australia</title>
<link rel="shortcut icon" href="/image/Loggy-Favicon.png" type="image/png" />
<link href="/css/dashboard.css" rel="stylesheet" type="text/css" />
<link href="/css/parsley.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'/>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="navi">
	<div class="width-container">
		<div id="logo-s">
			<?php echo anchor('http://loggy.com.au', '<img src="/image/Loggy-Small-Logo.png" alt="loggy logo">');?>
		</div>
		<div id="login-info">
			Logged in as <?=$this->session->userdata('first_name')?> <?=$this->session->userdata('last_name')?> (Admin)
		</div>
		<?php echo anchor('/auth/logout', '<div id="logout-btn" class="navi-item">LOG OUT</div>');?>
		<?php echo anchor('/auth/index', '<div id="accounts-btn" class="navi-item">ACCOUNTS</div>');?>
		<?php echo anchor('/vehicle/list_make', '<div id="vehicles-btn" class="navi-item">VEHICLES</div>');?>
	</div>
</div>
<div id="fixed-navi-offset">
</div>