<div class="gray-background">
	<div class="width-container">
		<div id="infoMessage"><?php echo $this->session->flashdata('db_message');?></div>
		<div id="top-tabs">
			<?php 
			//all of these are just for styling, stupid isn't it?
			$make_arr = array('list_make', 'edit_make');
			$model_arr = array('list_model', 'show_model', 'edit_model');
			$manufacture_arr = array('list_manufacture', 'edit_manufacture');
			$part_arr = array('list_part', 'show_part', 'edit_part');
			$part_type_arr = array('list_type', 'show_type', 'edit_type');
			
			$method = $this->router->fetch_method();
			
			if(in_array($method, $make_arr))
			{
			?>
				<div class='top-tab white-tab'>MAKE</div>
				<a href="<?=site_url()?>vehicle/list_model" class="top-tab light-tab">MODEL</a>
				<a href="<?=site_url()?>part/list_manufacture" class="top-tab light-tab">PART MANUFACTURER</a>
				<a href="<?=site_url()?>part/list_part" class="top-tab light-tab">PART</a>
				<a href="<?=site_url()?>part/list_type" class="top-tab light-tab">PART TYPE</a>				
			<?php
			}

			if(in_array($method, $model_arr))
			{
			?>				
				<a href="<?=site_url()?>vehicle/list_make" class="top-tab light-tab">MAKE</a>
				<div class='top-tab white-tab'>MODEL</div>
				<a href="<?=site_url()?>part/list_manufacture" class="top-tab light-tab">PART MANUFACTURER</a>
				<a href="<?=site_url()?>part/list_part" class="top-tab light-tab">PART</a>
				<a href="<?=site_url()?>part/list_type" class="top-tab light-tab">PART TYPE</a>				
			<?php
			}
			
			if(in_array($method, $manufacture_arr))
			{
			?>				
				<a href="<?=site_url()?>vehicle/list_make" class="top-tab light-tab">MAKE</a>
				<a href="<?=site_url()?>vehicle/list_model" class="top-tab light-tab">MODEL</a>
				<div class='top-tab white-tab'>PART MANUFACTURER</div>
				<a href="<?=site_url()?>part/list_part" class="top-tab light-tab">PART</a>
				<a href="<?=site_url()?>part/list_type" class="top-tab light-tab">PART TYPE</a>				
			<?php
			}
			
			if(in_array($method, $part_arr))
			{
			?>				
				<a href="<?=site_url()?>vehicle/list_make" class="top-tab light-tab">MAKE</a>
				<a href="<?=site_url()?>vehicle/list_model" class="top-tab light-tab">MODEL</a>
				<a href="<?=site_url()?>part/list_manufacture" class="top-tab light-tab">PART MANUFACTURER</a>
				<div class='top-tab white-tab'>PART</div>
				<a href="<?=site_url()?>part/list_type" class="top-tab light-tab">PART TYPE</a>				
			<?php
			}
			
			if(in_array($method, $part_type_arr))
			{
			?>				
				<a href="<?=site_url()?>vehicle/list_make" class="top-tab light-tab">MAKE</a>
				<a href="<?=site_url()?>vehicle/list_model" class="top-tab light-tab">MODEL</a>
				<a href="<?=site_url()?>part/list_manufacture" class="top-tab light-tab">PART MANUFACTURER</a>
				<a href="<?=site_url()?>part/list_part" class="top-tab light-tab">PART</a>
				<div class='top-tab white-tab'>PART TYPE</div>
			<?php
			}
			?>

		</div>
	</div>
</div>