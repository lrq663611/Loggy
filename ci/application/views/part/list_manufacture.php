<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">LIST MANUFACTURER</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<?php foreach ($manufacture_list as $manufacture): ?>

				<h4><?php echo anchor('part/edit_manufacture/'.$manufacture['id'], $manufacture['name']) ?></h4>

			<?php endforeach ?><br />

			<?php echo anchor('part/edit_manufacture/', 'Add New', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>