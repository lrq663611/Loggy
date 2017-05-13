<?php
$this->load->view('common/member_header');
?>
<?php
$this->load->view('dashboard/common/top_tab_section_vehicle_dashboard');
?>

<div class="white-background">
	<div class="width-container">
		<div class="each-service-container">
			<div class="green-spanar-bullet white-bullet"></div>
			<div class="vehicle-dashboard-brief">
				<?=$vehicle['make']?>&nbsp;&nbsp;<?=$vehicle['vehicle_model_year']?>&nbsp;&nbsp;<?=$vehicle['model']?>
			</div>
		</div>
		<div class="vehicle-dashboard-detail">
			<table width="100%">
				<tr class="space-top">
					<td width="20%" class="font-600">VIN:</td><td width="30%"><?=$vehicle['vin']?></td><td width="20%" class="font-600">Engine #:</td><td width="30%"><?=$vehicle['engine_num']?></td>
				</tr>
				<tr class="space-bottom">
					<td width="20%" class="font-600">Plate Number:</td><td width="80%" colspan="3"><?=$vehicle['rego_num']?></td>
				</tr>
				<tr>
					<td width="20%" class="font-600">Colour:</td><td width="30%"><?=$vehicle['color']?></td><td width="20%" class="font-600">Drive Type:</td><td width="30%"><?=$vehicle['drive_type']?></td>
				</tr>
				<tr>
					<td width="20%" class="font-600">Transmission:</td><td width="30%"><?=$vehicle['transmission']?></td><td width="20%" class="font-600">Engine:</td><td width="30%"><?=$vehicle['engine']?></td>
				</tr>
				<tr class="space-bottom">
					<td width="20%" class="font-600">Body Type:</td><td width="80%" colspan="3"><?=$vehicle['body_type']?></td>
				</tr>
				<tr class="space-bottom">
					<td width="20%" class="font-600">Vehicle Sold By:</td><td width="80%" colspan="3"><?=$vehicle['company']?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

</body>
</html>