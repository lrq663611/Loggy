<?php
$this->load->view('common/admin_header');
?>

<div class="width-container">

	<h1><?php echo lang('create_user_heading');?></h1>
	<p><?php echo lang('create_user_subheading');?></p>
	<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
	
	<div id="infoMessage"><b class="font-red"><?php echo $message;?></b></div>

	<?php echo form_open("auth/create_user", array('class' => 'dashboard-form')) ?>

		<p>
			<?php echo lang('create_user_fname_label', 'first_name');?> <br />
			<?php echo form_input($first_name);?>
		</p>

		<p>
			<?php echo lang('create_user_lname_label', 'last_name');?> <br />
			<?php echo form_input($last_name);?>
		</p>

		<p>
			<?php echo lang('create_user_company_label', 'company');?> <br />
			<?php echo form_input($company);?>
		</p>

		<p>
			<?php echo lang('create_user_address_label', 'address');?> <br />
			<?php echo form_input($address);?>
		</p>
		
		<p>
			<?php echo lang('create_user_suburb_label', 'suburb');?> <br />
			<?php echo form_input($suburb);?>
		</p>

		<p>
			<?php echo lang('create_user_postcode_label', 'postcode');?> (State is determined by postcode)<br />
			<?php echo form_input($postcode);?>
		</p>
		
		<p>
			<?php echo lang('create_user_email_label', 'email');?> <br />
			<?php echo form_input($email);?>
		</p>

		<p>
			<?php echo lang('create_user_phone_label', 'phone');?> <br />
			<?php echo form_input($phone);?>
		</p>

		<p>
			<?php echo lang('create_user_password_label', 'password');?> <br />
			<?php echo form_input($password);?>
		</p>

		<p>
			<?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
			<?php echo form_input($password_confirm);?>
		</p>

		<p class="font-red">User will be created as mechanic and members, you can change roles by editing this user later.</p>
		<p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

	<?php echo form_close();?>
	
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>