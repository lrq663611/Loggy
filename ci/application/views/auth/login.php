<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/html.php");?>

<body>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/header.php");?>

<div id="middle" class="login-middle add-padding-height">
	<div class="full-width-container add-padding-width">
		<h1 class="login-h1">LOGIN</h1>
		<!--<p><?php echo lang('login_subheading');?></p>-->
		<div id="infoMessage"><?php echo $message;?></div>
		<?php echo form_open("auth/login", array('class' => 'public-form'));?>
			<input type="text" name="identity" placeholder="Email"><br /><br />
			<input type="password" name="password" placeholder="Password"><br /><br />
			<p style="color:#fff">
				<?php echo lang('login_remember_label', 'remember');?>
				<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
			</p>
			<p><input type="submit" value="Login" class="orange-btn" style="width:200px;"></p>
		<?php echo form_close();?>
		<p><a href="forgot_password" style="color:#fff; text-decoration: underline;"><?php echo lang('login_forgot_password');?></a></p>
	</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/footer.php");?>

<script src="/js/jquery.placeholder.js"></script>
<script>

$(function(){
	$('input').placeholder();
})
</script>

</body>
