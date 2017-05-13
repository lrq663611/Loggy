<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">SHOW PART</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<span class="show-label">Part:</span><?=$record['part']?><br />
			<span class="show-label">Type:</span><?=$record['part_type']?><br />
			<span class="show-label">Manufacture:</span><?=$record['manufacture']?><br />
			<span class="show-label">Group:</span><?=$record['part_group']?><br />
			<span class="show-label">Description:</span><?=$record['part_description']?><br />
			<?php echo anchor('part/edit_part/'.$record['part_id'], 'Edit', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>