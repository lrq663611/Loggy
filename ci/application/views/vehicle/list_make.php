<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">VEHICLE MAKE</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<?php foreach ($make_list as $make): ?>

				<h4><?php echo anchor('vehicle/edit_make/'.$make['id'], $make['name']) ?></h4>

			<?php endforeach ?><br />

			<?php echo anchor('vehicle/edit_make/', 'Add New', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>