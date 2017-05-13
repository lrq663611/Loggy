<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">LIST PART</h2>
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
				<?php 
				if($this->uri->segment(3))//if type cat is set
				{
				?>
					<select id="part-type">
						<option disabled selected>Part Type</option>
					<?php
					$type = array();
					foreach ($part_list as $part): 
						if(in_array($part['part_type_id'], $type)){//this if condition is to get rid of duplicated types
							continue;//continue is to skip this interval in a loop
						}
						$type[] = $part['part_type_id'];?>
						<option value="<?=$part['part_type_id']?>"><?=$part['part_type']?></option>
					<?php endforeach ?>
					</select>
				<?php
				}?>
				<?php 
				if($this->uri->segment(4))//if type is set
				{
				?>
					<select id="part-group">
						<option disabled selected>Part Group</option>
					<?php
					$group = array();
					foreach ($part_list as $part): 
						if(in_array($part['part_group_id'], $group)){//this if condition is to get rid of duplicated groups
							continue;//continue is to skip this interval in a loop
						}
						$group[] = $part['part_group_id'];?>
						<option value="<?=$part['part_group_id']?>"><?=$part['part_group']?></option>
					<?php endforeach ?>
					</select>
				<?php
				}?>
				<?php 
				if($this->uri->segment(5))//if group cat is set
				{
				?>
					<select id="part-manufacture">
						<option disabled selected>Part Manufacturer</option>
					<?php
					$manufacture = array();
					foreach ($part_list as $part): 
						if(in_array($part['part_manufacture_id'], $manufacture)){//this if condition is to get rid of duplicated manufacturers
							continue;//continue is to skip this interval in a loop
						}
						$manufacture[] = $part['part_manufacture_id'];?>
						<option value="<?=$part['part_manufacture_id']?>"><?=$part['manufacture']?></option>
					<?php endforeach ?>
					</select>
				<?php
				}?>
			</div>
			<?php foreach ($part_list as $part): ?>

				<h4><?php echo anchor('part/show_part/'.$part['part_id'], $part['part']) ?></h4>
				<div class="main">
					<?php echo $part['part_type'] ?><br />
					<?php echo $part['manufacture'] ?><br />
					<?php echo $part['part_group'] ?>
				</div>

			<?php endforeach ?><br />

			<?php echo anchor('part/edit_part/', 'Add New', array('class' => 'orange-btn float-right')) ?>
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
	var type = "<?=$this->uri->segment(4)?>";
	if (type){
		$("#part-type").val(type);
	}
	var group = "<?=$this->uri->segment(5)?>";
	if (group){
		$("#part-group").val(group);
	}
	var manufacture = "<?=$this->uri->segment(6)?>";
	if (manufacture){
		$("#part-manufacture").val(manufacture);
	}
})
$("#part-type-cat").change(function(){
	window.location = "<?=site_url()?>part/list_part/"+$(this).val();
})
$("#part-type").change(function(){
	window.location = "<?=site_url()?>part/list_part/"+$("#part-type-cat").val()+"/"+$(this).val();
})
$("#part-group").change(function(){
	window.location = "<?=site_url()?>part/list_part/"+$("#part-type-cat").val()+"/"+$("#part-type").val()+"/"+$(this).val();
})
$("#part-manufacture").change(function(){
	window.location = "<?=site_url()?>part/list_part/"+$("#part-type-cat").val()+"/"+$("#part-type").val()+"/"+$("#part-group").val()+"/"+$(this).val();
})
</script>

</body>
</html>