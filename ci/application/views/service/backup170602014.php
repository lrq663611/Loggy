change_parts:
				<select name="old_part_id[]" data-parsley-type="integer" required><!--only default parts in this select-->
					<option></option>		
					<?php foreach ($compatible_parts as $part): ?>
						<?php if($part['is_default'] == 1){//only show default parts?>
							<?php if($part['part_id'] == $old_part_id[$i]){?>
								<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }else{?>
								<option value="<?=$part['part_id']?>"><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }?>
						<?php }?>
					<?php endforeach ?>
				</select><br />
				
				<div>To</div>
				<select name="new_part_id[]" data-parsley-type="integer" required><!--all parts, not only default parts in this select-->
					<option></option>		
					<?php foreach ($compatible_parts as $part): ?>
						<?php if($part['part_id'] == $new_part_id[$i]){?>
							<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
						<?php }else{?>
							<option value="<?=$part['part_id']?>"><?=$part['manufacture']?> <?=$part['part_name']?></option>
						<?php }?>
					<?php endforeach ?>
				</select><br /><br />
				
				
				
edit_parts:
		<?php
		for($i=0; $i<count($old_part_id); $i++){
		?>
			<div class="clone-set" style="border-top: 1px solid #f6f6f6;">
				<div class="float-left">From</div><div class="gray-btn float-right remove-btn">REMOVE</div>
				<select name="old_part_id[]" data-parsley-type="integer" required><!--only default parts in this select-->
					<option></option>		
					<?php foreach ($compatible_parts as $part): ?>
						<?php if($part['is_default'] == 1){//only show default parts?>
							<?php if($part['part_id'] == $old_part_id[$i]){?>
								<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }else{?>
								<option value="<?=$part['part_id']?>"><?=$part['manufacture']?> <?=$part['part_name']?></option>
							<?php }?>
						<?php }?>
					<?php endforeach ?>
				</select><br />
				<div>To</div>
				<select name="new_part_id[]" data-parsley-type="integer" required><!--all parts, not only default parts in this select-->
					<option></option>		
					<?php foreach ($compatible_parts as $part): ?>
						<?php if($part['part_id'] == $new_part_id[$i]){?>
							<option value="<?=$part['part_id']?>" selected><?=$part['manufacture']?> <?=$part['part_name']?></option>
						<?php }else{?>
							<option value="<?=$part['part_id']?>"><?=$part['manufacture']?> <?=$part['part_name']?></option>
						<?php }?>
					<?php endforeach ?>
				</select><br /><br />
			</div>
		<?php
		}
		?>