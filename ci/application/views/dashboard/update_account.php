<?php
$this->load->view('common/member_header');
?>
<?php
$this->load->view('dashboard/common/top_tab_section_vehicle_dashboard');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">Update Account Details</h2>
		<?php echo form_open('dashboard/update_account/', array('class' => 'dashboard-form', 'data-parsley-validate' => TRUE)) ?>
			<b class="font-red"><?php echo validation_errors(); ?></b>
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
			<input type="submit" value="SAVE"/>
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