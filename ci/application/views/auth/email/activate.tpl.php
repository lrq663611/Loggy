<html>
<body>
	<h2><?php echo sprintf(lang('email_activate_heading'), $identity);?></h2>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>
	<p>Then use "Forgot your password?" button in the page to change your password.</p>
</body>
</html>