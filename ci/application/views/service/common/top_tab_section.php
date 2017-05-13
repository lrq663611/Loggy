<div class="gray-background">
	<div class="width-container">
		<div id="infoMessage"><?php echo $this->session->flashdata('db_message');?></div>
		<div id="top-tabs">
			<?php 
			//all of these are just for styling, stupid isn't it?
			$add_vehicle_arr = array('add_owner', 'add_vehicle', 'edit_parts', 'review_vehicle', 'save_vehicle');
			$add_service_arr = array('choose_vehicle', 'add_entry', 'change_part', 'review', 'save_service');
			$current_work_arr = array('list_works', 'complete_service');
			
			$method = $this->router->fetch_method();
			
			if(in_array($method, $add_vehicle_arr))
			{
			?>
				<div class='top-tab white-tab' style="color:#6ecb84;">+ <img src="/image/dashboard-icon/40-green-car-icon.png" alt="40-white-car-icon.png" style="height:36px;"></div>
				<a href="<?=site_url()?>service/choose_vehicle" class="top-tab blue-tab">+ <img src="/image/dashboard-icon/30-white-spanar-icon.png" alt="40-white-spanar-icon.png"></a>
				<a href="<?=site_url()?>service/list_works" class="top-tab light-tab">ACTIVE WORKS</a>
				<a href="<?=site_url()?>service/list_works/past" class="top-tab light-tab">PAST WORKS</a>				
			<?php
			}

			if(in_array($method, $add_service_arr))
			{
			?>
				<a href="<?=site_url()?>service/add_owner" class="top-tab green-tab">+ <img src="/image/dashboard-icon/40-white-car-icon.png" alt="40-white-car-icon.png" style="height:36px;"></a>
				<div class='top-tab white-tab' style="color:#009ad0;">+ <img src="/image/dashboard-icon/30-blue-spanar-icon.png" alt="40-white-spanar-icon.png"></div>
				<a href="<?=site_url()?>service/list_works" class="top-tab light-tab">ACTIVE WORKS</a>
				<a href="<?=site_url()?>service/list_works/past" class="top-tab light-tab">PAST WORKS</a>				
			<?php
			}
			
			if(in_array($method, $current_work_arr))
			{
				if($this->uri->segment(3) == 'past')//the third parameter
				{
				?>
					<a href="<?=site_url()?>service/add_owner" class="top-tab green-tab">+ <img src="/image/dashboard-icon/40-white-car-icon.png" alt="40-white-car-icon.png" style="height:36px;"></a>
					<a href="<?=site_url()?>service/choose_vehicle" class="top-tab blue-tab">+ <img src="/image/dashboard-icon/30-white-spanar-icon.png" alt="40-white-spanar-icon.png"></a>
					<a href="<?=site_url()?>service/list_works" class="top-tab light-tab">ACTIVE WORKS</a>
					<div class="top-tab white-tab">PAST WORKS</div>			
				<?php
				}
				else
				{
				?>
					<a href="<?=site_url()?>service/add_owner" class="top-tab green-tab">+ <img src="/image/dashboard-icon/40-white-car-icon.png" alt="40-white-car-icon.png" style="height:36px;"></a>
					<a href="<?=site_url()?>service/choose_vehicle" class="top-tab blue-tab">+ <img src="/image/dashboard-icon/30-white-spanar-icon.png" alt="40-white-spanar-icon.png"></a>
					<div class="top-tab white-tab">ACTIVE WORKS</div>
					<a href="<?=site_url()?>service/list_works/past" class="top-tab light-tab">PAST WORKS</a>
				<?php
				}
			}
			?>

		</div>
	</div>
</div>