<?php
$this->load->view('common/admin_header');
?>

<div class="width-container">
		
	<h1><?php echo lang('index_heading');?></h1>
	<p><?php echo lang('index_subheading');?></p>
	<div style="border-bottom: 1px solid #f6f6f6; margin-bottom:20px;"></div>
	
	<div id="infoMessage"><b class="font-red"><?php echo $message;?></b></div>

	<table cellpadding=0 cellspacing=10 class="auth-table">
		<tr>
			<th><?php echo lang('index_fname_th');?></th>
			<th><?php echo lang('index_lname_th');?></th>
			<th><?php echo lang('index_email_th');?></th>
			<th><?php echo lang('index_groups_th');?></th>
			<th><?php echo lang('index_status_th');?></th>
			<th><?php echo lang('index_action_th');?></th>
		</tr>
		<?php foreach ($users as $user):?>
			<tr>
				<td><?php echo $user->first_name;?></td>
				<td><?php echo $user->last_name;?></td>
				<td><?php echo $user->email;?></td>
				<td>
					<?php foreach ($user->groups as $group):?>
						<?php //echo anchor("auth/edit_group/".$group->id, $group->name) ;
						echo $group->name;?><br />
					<?php endforeach?>
				</td>
				<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
				<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
			</tr>
		<?php endforeach;?>
	</table>
	<br />
	
	<?php echo $this->pagination->create_links();?>
	
	<p style="overflow:hidden;"><?php echo anchor('auth/create_user', lang('index_create_user_link'), array('class' => 'orange-btn float-left'))?> <?php echo anchor('auth/create_group', lang('index_create_group_link'), array('class' => 'display-none'))?></p>

</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>