<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2"><?=$add_update?> MANUFACTURER</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>

		<?php echo form_open('part/edit_manufacture/'.$id, array('class' => 'dashboard-form')) ?>
			<b class="font-red"><?php echo validation_errors(); ?></b>
			<label for="name">Manufacturer/Brand</label>
			<input type="input" name="name" value="<?=$manufacture_record['name']?>"/><br /><br />

			<input type="submit" name="submit" value="<?=$add_update?>"/>

		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>