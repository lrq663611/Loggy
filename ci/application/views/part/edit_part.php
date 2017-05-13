<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2"><?=$add_update?> PART</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>

		<?php echo form_open('part/edit_part/'.$id, array('class' => 'dashboard-form')) ?>
			<b class="font-red"><?php echo validation_errors(); ?></b>
			<label for="name">Part</label>
			<input type="input" name="name" value="<?=$part_record['part']?>"/><br /><br />
			<label for="description">Description (Optional)</label>
			<input type="input" name="description" value="<?=$part_record['part_description']?>"/><br /><br />
			
			<label for="manufacture">Manufacturer/Brand</label>
			<select name="manufacture">
				<option></option>
			<?php foreach ($manufacture_list as $manufacture): ?>
				<?php if($manufacture['id'] == $part_record['manufacture_id']){?>
					<option value="<?=$manufacture['id']?>" selected><?=$manufacture['name']?></option>
				<?php }else{?>
					<option value="<?=$manufacture['id']?>"><?=$manufacture['name']?></option>
				<?php }?>
			<?php endforeach ?>	
			</select><br /><br />
			
			<label for="group">Group</label>
			<select name="group">
				<option></option>
			<?php foreach ($group_list as $group): ?>
				<?php if($group['id'] == $part_record['part_group_id']){?>
					<option value="<?=$group['id']?>" selected><?=$group['description']?></option>
				<?php }else{?>
					<option value="<?=$group['id']?>"><?=$group['description']?></option>
				<?php }?>
			<?php endforeach ?>
			</select><br /><br />
			
			<label for="type">Type</label>
			<select name="type">
				<option></option>
			<?php foreach ($type_list as $type): ?>
				<?php if($type['type_id'] == $part_record['type_id']){?>
					<option value="<?=$type['type_id']?>" selected><?=$type['type']?></option>
				<?php }else{?>
					<option value="<?=$type['type_id']?>"><?=$type['type']?></option>
				<?php }?>
			<?php endforeach ?>		
			</select><br /><br />
			
			<label for="model">Suitable for Model</label>
			<select name="model[]" size="<?=count($model_list)?>" multiple>
			<?php foreach ($model_list as $model): ?>
				<?php if(in_array($model['model_id'], $pure_model_id_array)){//if this model_id can be found in the compatible table?>
					<option value="<?=$model['model_id']?>" selected><?=$model['model']?></option>
				<?php }else{?>
					<option value="<?=$model['model_id']?>"><?=$model['model']?></option>
				<?php }?>
			<?php endforeach ?>	
			</select>(Highlighted indicates compatible)<br /><br />	
			
			<input type="submit" name="submit" value="<?=$add_update?>"/>

		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>