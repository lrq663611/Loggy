<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD SERVICE ENTRY</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step4-4.png" alt="step4-4.png"></div>
		<h3 class="dashboard-h3">CONFIRM INFORMATION</h3>
		
		<?php echo form_open('service/save_service/', array('id' => 'save_service', 'class' => 'dashboard-form'))?>
			<div class="review-vehicle">
				<b class="font-red"><?php echo validation_errors(); ?></b>
				<div class="choosed-vehicle-details">
					Plate Number: <span class="ajax-rego"><?=$rego_num?></span><br />
					Vehicle: <span class="ajax-vehicle"><?=$vehicle?></span><br />
					<input id="submit_to_choose_vehicle" type="submit" value="EDIT/UPDATE" style="background-color:#62666a;"/>
				</div>
				<div class="service-details">
					Description: <?=$description?><br />
					Entry: <br />
					<?php
					for($i=0; $i<count($service_entry_cat_id); $i++){
					?>
					<span class="ajax-entry-cat-<?=$service_entry_cat_id[$i]?>"><?=$service_entry_cat_id[$i]?></span> <?=$service_entry_description[$i]?><br />
					<?php
					}
					?>
					<input id="submit_to_add_entry" type="submit" value="EDIT/UPDATE" style="background-color:#62666a;"/>
				</div>
				<div class="part-details">
					Part Changed: <br />
					<?php
					for($i=0; $i<count($old_part_id); $i++){
					?>
					From <span class="ajax-old-part-<?=$old_part_id[$i]?>"><?=$old_part_id[$i]?></span><br />
					To <span class="ajax-new-part-<?=$new_part_id[$i]?>"><?=$new_part_id[$i]?></span><br />
					<?php
					}
					?>
					Part Change Soon: <br />
					<?php
					for($i=0; $i<count($part_change_soon); $i++){
					?>
					<span class="ajax-change-soon-<?=$part_change_soon[$i]?>"><?=$part_change_soon[$i]?></span><br />
					<?php
					}
					?>
					<input id="submit_to_change_part" type="submit" value="EDIT/UPDATE" style="background-color:#62666a;"/>
				</div>
			</div>
			<div id="save-service-warning">Entry can not be changed and is permanent once saved. Please make sure they are correct.</div>
			<input type="hidden" name="rego_num" value="<?=$rego_num?>"/>
			<input type="hidden" name="vehicle" value="<?=$vehicle?>"/>
			<input type="hidden" name="model_id" value="<?=$model_id?>"/>
			<input type="hidden" name="description" value="<?=$description?>"/>
		<?php
		for($i=0; $i<count($service_entry_cat_id); $i++){
		?>
			<input type="hidden" name="service_entry_cat_id[]" value="<?=$service_entry_cat_id[$i]?>"/>
			<input type="hidden" name="service_entry_description[]" value="<?=$service_entry_description[$i]?>"/>
		<?php
		}
		?>
		<?php
		for($i=0; $i<count($old_part_id); $i++){
		?>
			<input type="hidden" name="old_part_id[]" value="<?=$old_part_id[$i]?>"/>
			<input type="hidden" name="new_part_id[]" value="<?=$new_part_id[$i]?>"/>
		<?php
		}
		?>
		<?php
		for($i=0; $i<count($part_change_soon); $i++){
		?>
			<input type="hidden" name="part_change_soon[]" value="<?=$part_change_soon[$i]?>"/>
		<?php
		}
		?>
			<input type="submit" value="SAVE LOGBOOK ENTRY" onclick="return confirm('Once confirmed it can not be undone. Are you sure you want to save logbook entry?');"/>
		</form>
	</div>
</div>
<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$("#submit_to_choose_vehicle").click(function(event){
	event.preventDefault();
	$('#save_service').attr('action', '<?=site_url()?>service/choose_vehicle').submit();
})
$("#submit_to_add_entry").click(function(event){
	event.preventDefault();
	$('#save_service').attr('action', '<?=site_url()?>service/add_entry').submit();
})
$("#submit_to_change_part").click(function(event){
	event.preventDefault();
	$('#save_service').attr('action', '<?=site_url()?>service/change_part').submit();
})

$(function(){
	vehicle_get_name($(".ajax-rego").html());
	<?php
	for($i=0; $i<count($service_entry_cat_id); $i++){
	?>
	entry_cat_get_name(<?=$service_entry_cat_id[$i]?>);
	<?php
	}
	?>
	<?php
	for($i=0; $i<count($old_part_id); $i++){
	?>
	part_get_name(<?=$old_part_id[$i]?>);
	part_get_name(<?=$new_part_id[$i]?>);
	<?php
	}
	?>
	<?php
	for($i=0; $i<count($part_change_soon); $i++){
	?>
		part_get_name(<?=$part_change_soon[$i]?>);
	<?php
	}
	?>
})

function vehicle_get_name(rego_num){
	$.ajax({
		url: "<?php echo site_url();?>service/rego_to_vehicle/"+rego_num,
		dataType: "json",
		success: function(msg) {
			$(".ajax-vehicle").html(msg.color+" "+msg.vehicle_model_year+" "+msg.make+" "+msg.model);
		}
	});
}

function entry_cat_get_name(id){
	$.ajax({
		url: "<?php echo site_url();?>service/entry_cat_get_name/"+id,
		dataType: "json",
		success: function(msg) {
			$(".ajax-entry-cat-"+id).html(msg.name);
		}
	});
}

function part_get_name(id){
	$.ajax({
		url: "<?php echo site_url();?>service/part_get_name/"+id,
		dataType: "json",
		success: function(msg) {
			$(".ajax-old-part-"+id).html(msg.part_manufacture_name+" "+msg.part_name);
			$(".ajax-new-part-"+id).html(msg.part_manufacture_name+" "+msg.part_name);
			$(".ajax-change-soon-"+id).html(msg.part_manufacture_name+" "+msg.part_name);
		}
	});
}
</script>

</body>
</html>