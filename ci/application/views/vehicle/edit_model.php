<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2"><?=$add_update?> MODEL</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>

		<?php echo form_open('vehicle/edit_model/'.$id, array('class' => 'dashboard-form')) ?>
			<b class="font-red"><?php echo validation_errors(); ?></b>
			<label for="name">Model</label>
			<input type="input" name="name" value="<?=$model_record['model']?>"/><br /><br />
			
			<label for="make">Make</label>
			<select name="make">
				<option></option>
				<?php foreach ($make_list as $make): ?>
					<?php if($make['id'] == $model_record['make_id']){?>
						<option value="<?=$make['id']?>" selected><?=$make['name']?></option>
					<?php }else{?>
						<option value="<?=$make['id']?>"><?=$make['name']?></option>
					<?php }?>
				<?php endforeach ?>	
			</select><br /><br />
			
			<label for="year">Year</label>	
			<select name="year">
				<option></option>
				<?php 
				$array = array("2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022");
				for($i=0; $i<count($array); $i++){
					if($model_record['year'] == $array[$i]){
				?>
						<option value="<?=$array[$i]?>" selected><?=$array[$i]?></option>
				<?php
					}
					else{
				?>
						<option value="<?=$array[$i]?>"><?=$array[$i]?></option>
				<?php
					}
				}
				?>
				<option value="other">Other</option>
			</select><br /><br />
			
			<label for="part">Default Part</label>
			<select name="part[]" size="<?=count($part_list)?>" multiple>
			<?php foreach ($part_list as $part): ?>
				<?php if(in_array($part['part_id'], $pure_part_id_array)){//if this part_id can be found in the compatible table?>
					<option value="<?=$part['part_id']?>" selected><?=$part['part']?></option>
				<?php }else{?>
					<option value="<?=$part['part_id']?>"><?=$part['part']?></option>
				<?php }?>
			<?php endforeach ?>	
			</select>(Highlighted indicates default parts)<br /><br />	
			
			<input type="submit" name="submit" value="<?=$add_update?>"/>
		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$("[name=year]").change(function() {
	if($(this).val() == "other"){
		$(this).replaceWith('<input type="input" name="year" value=""/>');
	}
});
</script>

</body>
</html>