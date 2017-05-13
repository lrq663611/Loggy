<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">SHOW Type</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<span class="show-label">Type:</span><?=$record['type']?><br />
			<span class="show-label">Category:</span><?=$record['category']?><br />
			<span class="show-label">Description:</span><?=$record['description']?><br />
			<?php echo anchor('part/edit_type/'.$record['type_id'], 'Edit', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>