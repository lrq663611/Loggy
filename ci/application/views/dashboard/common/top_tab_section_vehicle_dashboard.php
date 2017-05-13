<div class="gray-background">
	<div class="width-container">
		<div id="infoMessage"><?php echo $this->session->flashdata('db_message');?></div>
		<div id="top-tabs">
			<?php 
			//all of these are just for styling, stupid isn't it?
			$vehicle_profile_arr = array('vehicle_dashboard_vehicle');
			$service_logbook_arr = array('vehicle_dashboard_service');
			$parts_profile_arr = array('vehicle_dashboard_part');
			
			$method = $this->router->fetch_method();
			$vehicle_id = $this->uri->segment(3);
			
			if(in_array($method, $vehicle_profile_arr))
			{
				//echo anchor('dashboard/list_works', '< BACK', array('class' => 'top-tab dark-tab'));
				echo "<div class='top-tab white-tab'>VEHICLE PROFILE</div>";
				echo anchor('dashboard/vehicle_dashboard_service/'.$vehicle_id, 'SERVICE LOGBOOK', array('class' => 'top-tab light-tab'));
				echo anchor('dashboard/vehicle_dashboard_part/'.$vehicle_id, 'PARTS PROFILE', array('class' => 'top-tab light-tab'));
			}

			if(in_array($method, $service_logbook_arr))
			{
				//echo anchor('dashboard/list_works', '< BACK', array('class' => 'top-tab dark-tab'));
				echo anchor('dashboard/vehicle_dashboard_vehicle/'.$vehicle_id, 'VEHICLE PROFILE', array('class' => 'top-tab light-tab'));
				echo "<div class='top-tab white-tab'>SERVICE LOGBOOK</div>";
				echo anchor('dashboard/vehicle_dashboard_part/'.$vehicle_id, 'PARTS PROFILE', array('class' => 'top-tab light-tab'));
			}
			
			if(in_array($method, $parts_profile_arr))
			{
				//echo anchor('dashboard/list_works', '< BACK', array('class' => 'top-tab dark-tab'));
				echo anchor('dashboard/vehicle_dashboard_vehicle/'.$vehicle_id, 'VEHICLE PROFILE', array('class' => 'top-tab light-tab'));
				echo anchor('dashboard/vehicle_dashboard_service/'.$vehicle_id, 'SERVICE LOGBOOK', array('class' => 'top-tab light-tab'));
				echo "<div class='top-tab white-tab'>PARTS PROFILE</div>";
			}
			?>

		</div>
	</div>
</div>