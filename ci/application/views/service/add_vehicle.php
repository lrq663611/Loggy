<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD NEW VEHICLE</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step3-2.png" alt="step3-2.png"></div>
		<h3 class="dashboard-h3">VEHICLE DETAILS</h3>
		<?php echo form_open('service/edit_parts/', array('class' => 'dashboard-form', 'data-parsley-validate' => TRUE)) ?>
			<input type="hidden" name="first_name" value="<?=$first_name?>"/>
			<input type="hidden" name="last_name" value="<?=$last_name?>"/>
			<input type="hidden" name="company" value="<?=$company?>"/>
			<input type="hidden" name="email" value="<?=$email?>"/>
			<input type="hidden" name="phone" value="<?=$phone?>"/>
			<input type="hidden" name="address" value="<?=$address?>"/>
			<input type="hidden" name="suburb" value="<?=$suburb?>"/>
			<input type="hidden" name="postcode" value="<?=$postcode?>"/>
			
			<div class="font-600">VIN Number</div>
			<input type="text" name="vin" value="<?=$vin?>" data-parsley-length="[14, 17]" data-parsley-length-message="This value is wrong in length." data-parsley-type="alphanum" required/><br />
			<div class="font-600">Number Plate</div>
			<input type="text" name="rego_num" value="<?=$rego_num?>" data-parsley-maxlength="6" data-parsley-type="alphanum" required/><br />
			<div class="font-600">Engine Number</div>
			<input type="text" name="engine_num" value="<?=$engine_num?>" data-parsley-maxlength="12" data-parsley-type="alphanum" required/><br />	
			<div class="font-600">Vehicle Manufacturer</div>
			<select name="make" data-parsley-type="integer" required>
				<option></option>
			</select><br />
			<div class="font-600">Year of Manufacture</div>
			<select name="year" data-parsley-type="integer" required>
				<option></option>	
			</select><br />
			<div class="font-600">Model</div>
			<select name="model" data-parsley-type="integer" required>
				<option></option>	
			</select><br />
			<div class="font-600">Body Type</div>
			<select name="body_type" required>
				<option></option>
				<?php 
				$array = array("Cab Chassis", "Convertible", "Coupe", "Hatch", "Light Truck", "People Mover", "Sedan", "SUV", "Ute", "Van", "Wagon", "Other");
				for($i=0; $i<count($array); $i++){
					if($body_type == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>	
			</select><br />
			<div class="font-600">Drive Type</div>
			<select name="drive_type" required>
				<option></option>
				<?php 
				$array = array("4x4", "6x2", "6x4", "6x6", "Front Wheel Drive", "Rear Wheel Drive", "Other");
				for($i=0; $i<count($array); $i++){
					if($drive_type == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>	
			</select><br />
			<div class="font-600">Transmission</div>
			<select name="transmission" required>
				<option></option>
				<?php 
				$array = array("Automatic", "Manual", "Other");
				for($i=0; $i<count($array); $i++){
					if($transmission == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>	
			</select><br />
			<div class="font-600">Engine</div>
			<select name="engine" required>
				<option></option>
				<?php 
				$array = array("Diesel", "Electric", "LPG only", "Petrol", "Petrol or LPG", "Other");
				for($i=0; $i<count($array); $i++){
					if($engine == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>	
			</select><br />
			<div class="font-600">Colour</div>
			<select name="color" required>
				<option></option>
				<?php 
				$array = array("Beige", "Black", "Blue", "Bronze", "Brown", "Gold", "Green", "Grey", "Magenta", "Maroon", "Orange", "Pink", "Purple", "Red", "Silver", "White", "Yellow", "Other");
				for($i=0; $i<count($array); $i++){
					if($color == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>	
			</select><br />
			<div class="font-600">Note (Optional)</div>
			<input type="text" name="note" value="<?=$note?>"/><br />
		<?php
		for($i=0; $i<count($old_part_id); $i++){
		?>
			<input type="hidden" name="old_part_id[]" value="<?=$old_part_id[$i]?>"/>
			<input type="hidden" name="new_part_id[]" value="<?=$new_part_id[$i]?>"/>
		<?php
		}
		?>
			<input type="submit" value="NEXT STEP"/>
		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/parsley.min.js"></script>
<script>
$(function(){
	list_make();
})

$("[name=make]").change(function() {
	make_to_year($(this).val());
});

$("[name=year]").change(function() {
	make_year_to_model($("[name=make]").val(), $(this).val());
});

function list_make(){
	$.ajax({
		url: "<?php echo site_url();?>service/list_make/",
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$("[name=make]").append("<option value='"+item.id+"'>"+item.name+"</option>");
			});
			$('[name=make]').val(<?=$make?>).trigger("change");
		}
	});
}

function make_to_year(make){
	$("[name=year]").html('<option></option>');
	$("[name=model]").html('<option></option>');
	$.ajax({
		url: "<?php echo site_url();?>service/make_to_year/"+make,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$("[name=year]").append("<option value='"+item.year+"'>"+item.year+"</option>");
			});
			$('[name=year]').val(<?=$year?>).trigger("change");
		}
	});
}

function make_year_to_model(make, year){
	$("[name=model]").html('<option></option>');
	$.ajax({
		url: "<?php echo site_url();?>service/make_year_to_model/"+make+"/"+year,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$("[name=model]").append("<option value='"+item.id+"'>"+item.name+"</option>");
			});
			$('[name=model]').val(<?=$model?>).trigger("change");
		}
	});
}
</script>

</body>
</html>