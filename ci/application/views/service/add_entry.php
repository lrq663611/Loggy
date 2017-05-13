<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD SERVICE ENTRY</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step4-2.png" alt="step4-2.png"></div>
		<h3 class="dashboard-h3">SERVICE DETAILS</h3>	
		<?php echo form_open('service/change_part/', array('class' => 'dashboard-form', 'data-parsley-validate' => TRUE)) ?>
			<input type="hidden" name="rego_num" value="<?=$rego_num?>"/>
			<input type="hidden" name="vehicle" value="<?=$vehicle?>"/>
			<input type="hidden" name="model_id" value="<?=$model_id?>"/>
			<div class="font-600">Description</div>
			<input type="text" name="description" value="<?=$description?>" required/><br />
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
			<div class="font-600">Entry (You should add in at least 1 entry)</div>
			<br />
		<?php
		for($i=0; $i<count($service_entry_cat_id); $i++){
		?>
			<div class="clone-set" style="border-top: 1px solid #f6f6f6;">
				<div class="float-left">Category</div><div class="gray-btn float-right remove-btn">REMOVE</div>
				<select name="service_entry_cat_id[]" data-parsley-type="integer" required>
					<option></option>		
					<?php foreach ($service_entry_cat_list as $each_cat): ?>
						<?php if($each_cat['id'] == $service_entry_cat_id[$i]){?>
							<option value="<?=$each_cat['id']?>" selected><?=$each_cat['name']?></option>
						<?php }else{?>
							<option value="<?=$each_cat['id']?>"><?=$each_cat['name']?></option>
						<?php }?>
					<?php endforeach ?>
				</select><br />
				<div>Detail</div>
				<input type="text" name="service_entry_description[]" value="<?=$service_entry_description[$i]?>" required/><br /><br />
			</div>
		<?php
		}
		?>
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
	})

})

function remove_more(){
	$(".remove-btn").click(function(){
		$(this).parent().remove();
	})
}
</script>

</body>
</html>