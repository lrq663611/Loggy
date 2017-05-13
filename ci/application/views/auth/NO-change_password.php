<?php
$this->load->view('common/admin_header');
?>

<div class="width-container">

	<h1><?php echo lang('change_password_heading');?></h1>

	<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
	
	<div id="infoMessage"><b class="font-red"><?php echo $message;?></b></div>

	<?php echo form_open("auth/change_password", array('class' => 'dashboard-form')) ?>

		  <p>
				<?php echo lang('change_password_old_password_label', 'old_password');?> <br />
				<?php echo form_input($old_password);?>
		  </p>

		  <p>
				<label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
				<?php echo form_input($new_password);?>
		  </p>

		  <p>
				<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
				<?php echo form_input($new_password_confirm);?>
		  </p>

		  <?php echo form_input($user_id);?>
		  <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

	<?php echo form_close();?>

</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>