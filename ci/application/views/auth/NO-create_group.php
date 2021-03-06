<?php
$this->load->view('common/admin_header');
?>

<div class="width-container">

	<h1><?php echo lang('create_group_heading');?></h1>
	<p><?php echo lang('create_group_subheading');?></p>

	<div id="infoMessage"><b class="font-red"><?php echo $message;?></b></div>

	<?php echo form_open("auth/create_group");?>

		<p>
			<?php echo lang('create_group_name_label', 'group_name');?> <br />
			<?php echo form_input($group_name);?>
		</p>

		<p>
			<?php echo lang('create_group_desc_label', 'description');?> <br />
			<?php echo form_input($description);?>
		</p>

		<p><?php echo form_submit('submit', lang('create_group_submit_btn'));?></p>

	<?php echo form_close();?>

</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>