<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD NEW VEHICLE</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step3-3.png" alt="step3-3.png"></div>
		<h3 class="dashboard-h3">CONFIRM INFORMATION</h3>

		<?php echo form_open('service/save_vehicle/', array('id' => 'save_vehicle', 'class' => 'dashboard-form'))?>
			<div class="review-vehicle">
				<b class="font-red"><?php echo validation_errors(); ?></b>
				<div class="owner-details">
					First Name: <?=$first_name?><br />
					Last Name: <?=$last_name?><br />
					Company: <?=$company?><br />
					Email: <?=$email?><br />
					Phone: <?=$phone?><br />
					Address: <?=$address?><br />
					Suburb: <?=$suburb?><br />
					Postcode: <?=$postcode?><br />
					<input id="submit_to_add_owner" type="submit" value="EDIT/UPDATE" style="background-color:#62666a;"/>
				</div>
				<div class="vehicle-details">
					VIN Number: <?=$vin?><br />
					Number Plate: <?=$rego_num?><br />
					Engine Number: <?=$engine_num?><br />
					Vehicle Manufacture: <span class="ajax-make"><?=$make?></span><br />
					Year of Manufacture: <?=$year?><br />
					Model: <span class="ajax-model"><?=$model?></span><br />
					Body Type: <?=$body_type?><br />
					Drive Type: <?=$drive_type?><br />
					Transmission: <?=$transmission?><br />
					Engine: <?=$engine?><br />
					Colour: <?=$color?><br />
					Note: <?=$note?><br />
					Modification: <br />
					<?php
					for($i=0; $i<count($old_part_id); $i++){
					?>
					From <span class="ajax-old-part-<?=$old_part_id[$i]?>"><?=$old_part_id[$i]?></span><br />
					To <span class="ajax-new-part-<?=$new_part_id[$i]?>"><?=$new_part_id[$i]?></span><br />
					<?php
					}
					?>
					<input id="submit_to_add_vehicle" type="submit" value="EDIT/UPDATE" style="background-color:#62666a;"/>
				</div>
			</div>		
			<input type="hidden" name="first_name" value="<?=$first_name?>"/>
			<input type="hidden" name="last_name" value="<?=$last_name?>"/>
			<input type="hidden" name="company" value="<?=$company?>"/>
			<input type="hidden" name="email" value="<?=$email?>"/>
			<input type="hidden" name="phone" value="<?=$phone?>"/>
			<input type="hidden" name="address" value="<?=$address?>"/>
			<input type="hidden" name="suburb" value="<?=$suburb?>"/>
			<input type="hidden" name="postcode" value="<?=$postcode?>"/>
			
			<input type="hidden" name="vin" value="<?=$vin?>"/>
			<input type="hidden" name="rego_num" value="<?=$rego_num?>"/>
			<input type="hidden" name="engine_num" value="<?=$engine_num?>"/>
			<input type="hidden" name="make" value="<?=$make?>"/>
			<input type="hidden" name="year" value="<?=$year?>"/>
			<input type="hidden" name="model" value="<?=$model?>"/>
			<input type="hidden" name="body_type" value="<?=$body_type?>"/>
			<input type="hidden" name="drive_type" value="<?=$drive_type?>"/>
			<input type="hidden" name="transmission" value="<?=$transmission?>"/>
			<input type="hidden" name="engine" value="<?=$engine?>"/>
			<input type="hidden" name="color" value="<?=$color?>"/>
			<input type="hidden" name="note" value="<?=$note?>"/>
		<?php
		for($i=0; $i<count($old_part_id); $i++){
		?>
			<input type="hidden" name="old_part_id[]" value="<?=$old_part_id[$i]?>"/>
			<input type="hidden" name="new_part_id[]" value="<?=$new_part_id[$i]?>"/>
		<?php
		}
		?>		
			<input type="submit" value="CONFIRM & FINISH"/>
		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$("#submit_to_add_owner").click(function(event){
	event.preventDefault();
	$('#save_vehicle').attr('action', '<?=site_url()?>service/add_owner').submit();
})
$("#submit_to_add_vehicle").click(function(event){
	event.preventDefault();
	$('#save_vehicle').attr('action', '<?=site_url()?>service/add_vehicle').submit();
})

$(function(){
	make_get_name();
	model_get_name($(".ajax-model").html());
	<?php
	for($i=0; $i<count($old_part_id); $i++){
	?>
	part_get_name(<?=$old_part_id[$i]?>);
	part_get_name(<?=$new_part_id[$i]?>);
	<?php
	}
	?>
})

function make_get_name(){
	$.ajax({
		url: "<?php echo site_url();?>service/list_make/",
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				if($(".ajax-make").html() == item.id){
					$(".ajax-make").html(item.name);
				}
			});
		}
	});
}

function model_get_name(id){
	$.ajax({
		url: "<?php echo site_url();?>service/model_get_name/"+id,
		dataType: "json",
		success: function(msg) {
			$(".ajax-model").html(msg.name);
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
		}
	});
}
</script>

</body>
</html>