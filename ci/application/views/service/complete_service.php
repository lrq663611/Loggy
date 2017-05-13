<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">COMPLETE SERVICE</h2>
		<div style="border-bottom: 1px solid #f6f6f6;"></div>
		<div class="font-red" style="margin-top:20px; margin-bottom:20px; text-align: center;"><b>Are you sure you want to complete this job and notify owner imminently?</b></div>
		<div id="complete-notification">
			<b>Description: </b><?=$service[0]['service_description']?><br />
			<b>Owner: </b><?=$service[0]['first_name']." ".$service[0]['last_name']?><br />
			<b>Vehicle: </b><?=$service[0]['color']." ".$service[0]['vehicle_model_year']." ".$service[0]['make']." ".$service[0]['model']?><br />
			<b>Number Plate: </b><?=$service[0]['rego_num']?><br /><br />
			<?php echo anchor('service/complete_service/'.$service[0]['service_id'].'/1', 'SURE', array('class' => 'orange-btn', 'style' => 'float: left'));?>
			<?php echo anchor('service/list_works', 'CANCEL', array('class' => 'gray-btn', 'style' => 'float: right'));?>
		</div>
	</div>
</div>