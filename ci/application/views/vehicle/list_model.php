<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2">LIST MODEL</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
		<div class="dashboard-width">
			<div class="top-filters">
				<select id="model-make">
					<option disabled selected>Make</option>
				<?php
				$make = array();
				foreach ($model_list as $model): 
					if(in_array($model['make_id'], $make)){//this if condition is to get rid of duplicated makes
						continue;//continue is to skip this interval in a loop
					}
					$make[] = $model['make_id'];?>
					<option value="<?=$model['make_id']?>"><?=$model['make']?></option>
				<?php endforeach ?>
				</select>
				<?php 
				if($this->uri->segment(3))//if model make is set
				{
				?>
					<select id="model-year">
						<option disabled selected>Year</option>
					<?php
					$year = array();
					foreach ($model_list as $model): 
						if(in_array($model['year'], $year)){//this if condition is to get rid of duplicated years
							continue;//continue is to skip this interval in a loop
						}
						$year[] = $model['year'];?>
						<option value="<?=$model['year']?>"><?=$model['year']?></option>
					<?php endforeach ?>
					</select>
				<?php
				}?>
			</div>
			<?php foreach ($model_list as $model): ?>

				<?php echo anchor('vehicle/show_model/'.$model['model_id'], '<b>'.$model['make'].'</b> '.$model['model']) ?>
				<div class="main">
					<?php echo $model['year'] ?>
				</div><br />

			<?php endforeach ?><br />

			<?php echo anchor('vehicle/edit_model/', 'Add New', array('class' => 'orange-btn float-right')) ?>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(function(){
	var make = "<?=$this->uri->segment(3)?>";
	if (make){
		$("#model-make").val(make);
	}
	var year = "<?=$this->uri->segment(4)?>";
	if (year){
		$("#model-year").val(year);
	}
})
$("#model-make").change(function(){
	window.location = "<?=site_url()?>vehicle/list_model/"+$(this).val();
})
$("#model-year").change(function(){
	window.location = "<?=site_url()?>vehicle/list_model/"+$("#model-make").val()+"/"+$(this).val();
})
</script>
</body>
</html>