<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/html.php");?>

<body>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/header.php");?>

<div id="middle" class="login-middle add-padding-height">
	<div class="full-width-container add-padding-width">
		<h1 class="login-h1"><?php echo lang('reset_password_heading');?></h1>

		<div id="infoMessage"><?php echo $message;?></div>
		<?php echo form_open("auth/reset_password/".$code, array('class' => 'public-form'));?>
			<input type="text" placeholder="<?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?>" class="public-input fake_pass">
			<input type="password" name="new" pattern="^.{8}.*$" class="public-input real_pass" style="display:none;"><br /><br />
			
			<input type="text" placeholder="<?php echo sprintf(lang('reset_password_new_password_confirm_label'), $min_password_length);?>" class="public-input fake_pass">
			<input type="password" name="new_confirm" pattern="^.{8}.*$" class="public-input real_pass" style="display:none;"><br /><br />
			
			<?php echo form_input($user_id);?>
			<?php echo form_hidden($csrf); ?>
			<p><input type="submit" value="<?=lang('reset_password_submit_btn')?>" class="orange-btn" style="width:200px;"></p>
		<?php echo form_close();?>
	</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/footer.php");?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/jquery.placeholder.js"></script>
<script>

$(function(){
	$('input').placeholder();
	fake_password_placeholder();
})

function fake_password_placeholder(){
	// Show the fake pass (because JS is enabled)
	$('.fake_pass').show();
	// On focus of the fake password field
	$('.fake_pass').focus(function(){
		$(this).hide(); //  hide the fake password input text
		$(this).next('.real_pass').show().focus(); // and show the real password input password
	});
	// On blur of the real pass
	$('.real_pass').blur(function(){
		if($(this).val() == ""){ // if the value is empty, 
			$(this).hide(); // hide the real password field
			$(this).prev('.fake_pass').show(); // show the fake password
		}
	});
}
</script>

</body>