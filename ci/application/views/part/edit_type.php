<?php
$this->load->view('common/admin_header');
?>
<?php
$this->load->view('vehicle/common/top_tab_section');
?>

<div class="white-background">
	<div class="width-container">
		<h2 class="dashboard-h2"><?=$add_update?> TYPE</h2>
		<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>

		<?php echo form_open('part/edit_type/'.$id, array('class' => 'dashboard-form')) ?>
			<b class="font-red"><?php echo validation_errors(); ?></b>
			<label for="name">Type</label>
			<input type="input" name="name" value="<?=$type_record['type']?>"/><br /><br />
			<label for="category">Category</label>
			<select name="category">
				<option></option>
			<?php foreach ($category_list as $category): ?>
				<?php if($category['id'] == $type_record['category_id']){?>
					<option value="<?=$category['id']?>" selected><?=$category['name']?></option>
				<?php }else{?>
					<option value="<?=$category['id']?>"><?=$category['name']?></option>
				<?php }?>
			<?php endforeach ?>	
			</select><br /><br />
			<label for="description">Short Description (Optional)</label>
			<input type="input" name="description" value="<?=$type_record['description']?>"/><br /><br />
			
			<input type="submit" name="submit" value="<?=$add_update?>"/>

		</form>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>