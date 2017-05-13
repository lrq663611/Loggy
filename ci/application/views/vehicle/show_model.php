<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">SHOW MODEL</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<span class="show-label">Model:</span><?=$record['model']?><br />
			<span class="show-label">Make:</span><?=$record['make']?><br />
			<span class="show-label">Year:</span><?=$record['year']?><br />
			<?php echo anchor('vehicle/edit_model/'.$record['model_id'], 'Edit', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>