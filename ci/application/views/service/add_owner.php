<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">ADD NEW VEHICLE</h2>
		<div class="dashboard-step-bar"><img src="/image/dashboard-steps/step3-1.png" alt="step3-1.png"></div>
		<h3 class="dashboard-h3">OWNER DETAILS</h3>
		<?php echo form_open('service/add_vehicle/', array('class' => 'dashboard-form', 'data-parsley-validate' => TRUE)) ?>
			<div class="font-600">First Name</div>
			<input type="text" name="first_name" value="<?=$first_name?>" required/><br />
			<div class="font-600">Last Name</div>
			<input type="text" name="last_name" value="<?=$last_name?>" required/><br />
			<div class="font-600">Company (Optional)</div>
			<input type="text" name="company" value="<?=$company?>"/><br />
			<div class="font-600">Email</div>
			<input type="text" name="email" value="<?=$email?>" data-parsley-type="email" required/><br />
			<div class="font-600">Phone</div>
			<input type="text" name="phone" value="<?=$phone?>" data-parsley-length="[10, 10]" data-parsley-length-message="Phone number should be 10 digits." data-parsley-type="digits" required/><br />
			<div class="font-600">Address</div>
			<input type="text" name="address" value="<?=$address?>" required/><br />
			<div class="font-600">Suburb</div>
			<input type="text" name="suburb" value="<?=$suburb?>" required/><br />
			<div class="font-600">Postcode (No need to input state)</div>
			<input type="text" name="postcode" value="<?=$postcode?>" data-parsley-length="[4, 4]" data-parsley-length-message="Postcode should be 4 digits." data-parsley-type="digits" required/><br />
			
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
			<input type="submit" value="NEXT STEP"/>
		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/parsley.min.js"></script>

</body>
</html>