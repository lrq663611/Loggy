<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">LIST TYPE</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<div class="top-filters">
				<select id="part-type-cat">
					<option disabled selected>Category</option>
					<option value="mechanical">Mechanical</option>
					<option value="electrical">Electrical</option>
					<option value="exterior">Exterior</option>
					<option value="interior">Interior</option>
				</select>
			</div>
			<?php foreach ($type_list as $type): ?>

				<h4><?php echo anchor('part/show_type/'.$type['type_id'], $type['type']) ?></h4>
				<div class="main">
					<?php echo $type['category'] ?><br />
					<?php echo $type['description'] ?>
				</div>

			<?php endforeach ?><br />

			<?php echo anchor('part/edit_type/', 'Add New', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(function(){
	var cat = "<?=$this->uri->segment(3)?>";
	if (cat){
		$("#part-type-cat").val(cat);
	}
})
$("#part-type-cat").change(function(){
	window.location = "<?=site_url()?>part/list_type/"+$(this).val();
})
</script>

</body>
</html>