<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<?php foreach($works as $work):?>
			<div class="each-service-container">
				<?php if($this->uri->segment(3) == 'past'){//the third parameter?>
					<div class="red-spanar-bullet white-bullet"></div>
				<?php }else{?>
					<div class="green-spanar-bullet white-bullet"></div>
				<?php }?>
				<div class="each-service">
					<div class="each-service-brief" style="padding-top:20px; padding-bottom:20px;">
						<?php if($this->uri->segment(3) == 'past'){//the third parameter?>
							<span class="plus-minus-btn dashboard-btn toggle-closed">+</span>
							<?=date("d-m-Y", $work['start_date'])?>&nbsp;&nbsp;<?=$work['rego_num']?>&nbsp;&nbsp;<?=$work['first_name'][0].". ".$work['last_name']?>&nbsp;&nbsp;<?=$work['make']?>&nbsp;&nbsp;<?=$work['model']?><span class="float-right">Finished on <?=date("d-m-Y", $work['finish_date'])?></span>
						<?php }else{?>
							<span class="plus-minus-btn dashboard-btn toggle-closed">+</span>
							<?=date("d-m-Y", $work['start_date'])?>&nbsp;&nbsp;<?=$work['rego_num']?>&nbsp;&nbsp;<?=$work['first_name'][0].". ".$work['last_name']?>&nbsp;&nbsp;<?=$work['make']?>&nbsp;&nbsp;<?=$work['model']?><?php echo anchor('service/complete_service/'.$work['service_id'], 'COMPLETE & NOTIFY OWNER', array('class' => 'complete-btn dashboard-btn'));?>
						<?php }?>
					</div>
					<div class="each-service-detail">
						<div>
							<?=anchor('service/vehicle_dashboard_vehicle/'.$work['vehicle_id'], 'VEHICLE DASHBOARD', array('class' => 'view-dashboard-btn dashboard-btn'))?>
						</div>
						<table width="100%">
							<tr class="space-top space-bottom">
								<td width="20%" class="font-600">Description:</td><td width="80%" colspan="3"><?=$work['service_description']?></td>
							</tr>
							<tr>
								<td width="20%" class="font-600">Manufacture:</td><td width="30%"><?=$work['make']?></td><td width="20%" class="font-600">Model:</td><td width="30%"><?=$work['model']?></td>
							</tr>
							<tr>
								<td width="20%" class="font-600">Year:</td><td width="30%"><?=$work['vehicle_model_year']?></td><td width="20%" class="font-600">VIN:</td><td width="30%"><?=$work['vin']?></td>
							</tr>
							<tr class="space-bottom">
								<td width="20%" class="font-600">Engine Number:</td><td width="30%"><?=$work['engine_num']?></td><td width="20%" class="font-600">Number Plate:</td><td width="30%"><?=$work['rego_num']?></td>
							</tr>
							<tr>
								<td width="20%" class="font-600">Colour:</td><td width="30%"><?=$work['color']?></td><td width="20%" class="font-600">Drive Type:</td><td width="30%"><?=$work['drive_type']?></td>
							</tr>
							<tr>
								<td width="20%" class="font-600">Transmission:</td><td width="30%"><?=$work['transmission']?></td><td width="20%" class="font-600">Engine:</td><td width="30%"><?=$work['engine']?></td>
							</tr>
							<tr class="space-bottom">
								<td width="20%" class="font-600">Body Type:</td><td width="30%"><?=$work['body_type']?></td><td width="20%" class="font-600">Note:</td><td width="30%"><?=$work['note']?></td>
							</tr>
							<tr>
								<td width="20%" class="font-600"><?=$work['first_name']." ".$work['last_name']?></td><td width="80%" colspan="3">Ph: <?=$work['phone']?></td>
							</tr>							
						</table>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		<br />
		<?php echo $this->pagination->create_links();?>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
$(function(){
	$( ".each-service" ).accordion({ 
		heightStyle: "content",
		collapsible: true,
		active: false,
		activate: function(){
			$(this).find(".plus-minus-btn").toggleClass("toggle-closed toggle-opened", function(){
				if($(this).html() == "-"){
					$(this).html("+");
				}else{
					$(this).html("-");
				}
			});
		}
	});
	$(".complete-btn").click(function() {
		window.location = $(this).attr('href');
		return false;
	});
})
</script>

</body>
</html>