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
		<h3 class="dashboard-h3">PARTS DETAILS</h3>
		<?php echo form_open('service/review_vehicle/', array('class' => 'dashboard-form', 'data-parsley-validate' => TRUE)) ?>

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
			
			<div class="font-600">Modification (Optional. Remove if there is nothing to be changed)</div>
			Which part/parts will be replaced by which?<br /><br />
		<?php
		if(!empty($old_part_id[0])){//if this is set//should not check the array because even if it is not set there is still the first one with empty value
			for($i=0; $i<count($old_part_id); $i++){//this block is used to display selected when reviewing
		?>
				<div class="clone-set" style="border-top: 1px solid #f6f6f6;">
					<div class="float-left">Original Part</div><div class="gray-btn float-right remove-btn">REMOVE</div>
					<select name="old_part_id[]" data-parsley-type="integer" required>
						<?php foreach ($compatible_parts as $part): ?>
							<?php if($part['part_id'] == $old_part_id[$i]){?>
								<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }?>
						<?php endforeach ?>
					</select><br />
					<div>Changed With Part</div>
					<select name="new_part_id[]" data-parsley-type="integer" required>
						<?php foreach ($compatible_parts as $part): ?>
							<?php if($part['part_id'] == $new_part_id[$i]){?>
								<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }?>
						<?php endforeach ?>
					</select><br /><br />
				</div>
		<?php
			}
		}
		?>
			<div class="clone-set" style="border-top: 1px solid #f6f6f6;">
				<div class="float-left">Part</div><div class="gray-btn float-right remove-btn">REMOVE</div>
				<select name="part_type_cat" data-parsley-type="integer" required>
					<option disabled selected>Category</option>		
					<option value="1">Mechanical</option>
					<option value="2">Electrical</option>
					<option value="3">Exterior</option>
					<option value="4">Interior</option>
				</select><br />
			</div>
			<div class="gray-btn float-left clone-btn">ADD MORE</div>
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
	remove_more();
	$(".clone-btn").click(function(){
		$(this).prev().after($(this).prev().clone());
		remove_more();//should do this once new added
		cat_to_type();
	})
	cat_to_type()
})

function remove_more(){
	$(".remove-btn").click(function(){
		$(this).parent().remove();
	})
}

function cat_to_type(){
	$("[name=part_type_cat]").change(function(event){
		event.stopImmediatePropagation();//to prevent multiple handlers from being executed when funtion is called again//one action, many duplicated results
		var $this_cat = $(this);
		$this_cat.nextAll().remove();
		$.ajax({
			url: "<?=site_url()?>service/list_compatible_parts/<?=$model?>",
			dataType: "json",
			success: function(msg) {
				$this_cat.after('<br /><br /><select name="part_type" data-parsley-type="integer" required><option disabled selected>Type</option></select><br /><br />');
				array = [];//this array is used to store ids, to remove duplicate
				$.each(msg, function(i,item){
					if(item.is_default == "1" && item.part_type_cat_id == $this_cat.val()){//only shows defaults in this category
						if(array.indexOf(item.part_type_id) > -1){//found it
							return;//skip this interval, equals to php "continue" in foreach loop
						}
						else{
							array.push(item.part_type_id);
							$this_cat.siblings("[name=part_type]").append('<option value="'+item.part_type_id+'">'+item.part_type+'</option>');
						}
					}
				})
				type_to_part();
			}
		});
	})
}

function type_to_part(){//both old part and new part
	$("[name=part_type]").change(function(event){
		event.stopImmediatePropagation();//to prevent multiple handlers from being executed when funtion is called again//one action, many duplicated results
		var $this_type = $(this);
		$this_type.nextAll().remove();
		$.ajax({
			url: "<?=site_url()?>service/list_compatible_parts/<?=$model?>",
			dataType: "json",
			success: function(msg) {
				$this_type.after('<br /><br /><select name="old_part_id[]" data-parsley-type="integer" required><option disabled selected>Original Part</option></select><br /><br /><select name="new_part_id[]" data-parsley-type="integer" required><option disabled selected>Replaced With Part</option></select><br /><br />');
				$.each(msg, function(i,item){
					if(item.part_type_id == $this_type.val()){//only shows this type
						if(item.is_default == "1"){//default part for old_part_id[]
							$this_type.siblings('[name="old_part_id[]"]').append('<option value="'+item.part_id+'">'+item.manufacture+' '+item.part_name+'</option>');
						}
						$this_type.siblings('[name="new_part_id[]"]').append('<option value="'+item.part_id+'">'+item.manufacture+' '+item.part_name+'</option>');
					}
				})
			}
		});
	})
}
</script>
</body>
</html>