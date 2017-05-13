<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD SERVICE ENTRY</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step4-1.png" alt="step4-1.png"></div>
		<h3 class="dashboard-h3">CHOOSE VEHICLE</h3>	
		<?php echo form_open('service/add_entry/', array('class' => 'dashboard-form')) ?>
			<div class="font-600">Plate Number</div>
			<input type="text" name="rego_num" value="<?=$rego_num?>"/><br />
			<input type="hidden" name="vehicle" value="<?=$vehicle?>"/>
			<input type="hidden" name="model_id" value="<?=$model_id?>"/>
			<div id="show-matched-vehicle"></div>
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
			<br />
			<div class="orange-btn float-left search">Search</div>
			<input type="submit" value="NEXT STEP"/>
		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(function(){
	rego_to_car = false;
	
	$("[type=submit]").click(function(e){
		e.preventDefault();
		if(rego_to_car){
			$(".dashboard-form").submit();
		}
	})
})
$("[name=rego_num]").focus(function() {
	make_to_year();
});

function make_to_year(){
	$(".search").click(function(e){
		e.stopImmediatePropagation();//to prevent multiple handlers from being executed when funtion is called again//one action, many duplicated results
		rego_num = $("[name=rego_num]").val();

		$.ajax({
			url: "<?php echo site_url();?>service/rego_to_vehicle/"+rego_num,
			dataType: "json",
			success: function(msg) {
				if(jQuery.isEmptyObject(msg)){//found no record
					$("[name=vehicle]").val("");
					$("[name=model_id]").val("");
					$("#show-matched-vehicle").html("The plate number does not match any vehicle!")
				}
				else{
					$("[name=vehicle]").val(msg.vehicle);
					$("[name=model_id]").val(msg.model_id);
					$("#show-matched-vehicle").html("Is it a <b>"+msg.color+" "+msg.vehicle_model_year+" "+msg.make+" "+msg.model+"</b>?");
					rego_to_car = true;
				}
			}
		});
	})
}
</script>

</body>
</html>