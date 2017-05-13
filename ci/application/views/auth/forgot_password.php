<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/html.php");?>

<body>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/header.php");?>

<div id="middle" class="login-middle add-padding-height">
	<div class="full-width-container add-padding-width">
		<h1 class="login-h1"><?php echo lang('forgot_password_heading');?></h1>
		<!--<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>-->
		<div id="infoMessage"><?php echo $message;?></div>
		<?php echo form_open("auth/forgot_password", array('class' => 'public-form'));?>
			<input type="text" name="email" placeholder="<?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?>" class="public-input"><br /><br />

			<p><input type="submit" value="<?=lang('forgot_password_submit_btn')?>" class="orange-btn" style="width:200px;"></p>
		<?php echo form_close();?>
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