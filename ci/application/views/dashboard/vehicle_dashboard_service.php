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
		<?php foreach($services as $service):?>
			<div class="each-service-container">
				<div class="white-spanar-bullet white-bullet"></div>
				<div class="each-service">
					<div class="each-service-brief" data-id="<?=$service['id']?>" style="line-height: inherit;">
						<div style="display: inline-block; margin-top: 21px; margin-bottom: 21px;">
							<?php if ($service['status'] == "1"){?>
								<span class="font-600 font-red"><?=$service['description']?> (NOT COMPLETED)</span>
							<?php }else{?>
								<span class="font-600"><?=$service['description']?></span>
							<?php }?>
							<br /><span><?=date("d-m-Y", $service['start_date'])?></span>
						</div>
						<span class="plus-minus-btn dashboard-btn toggle-closed" style="line-height: 40px; margin-top: 20px;">+</span>
					</div>
					<div class="each-service-detail">
						<div class="service-by"></div><br />
						<div class="service-details-title">SERVICE DETAILS</div>
						<ul class="service-entry-ul">
						</ul>
						<br />
						<div class="parts-changed-title">PARTS CHANGED (Parts which were replacing old parts in this service)</div>
						<ul class="parts-changed-ul">
						</ul>
						<div class="change-soon-title">CHANGE SOON (Parts which were identified by mechanic that need to be changed soon)</div>
						<ul class="change-soon-ul">
						</ul>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
$(function(){
	$(".each-service-brief").each(function(){//get service details for each service
		get_service_details($(this).attr("data-id"));
		get_part_changed_details($(this).attr("data-id"));
		get_change_soon_details($(this).attr("data-id"));
	})
	$( ".each-service" ).accordion({ 
		heightStyle: "content",
		collapsible: true,
		active: false,
		activate: function(){
			$(this).find(".plus-minus-btn").toggleClass("toggle-closed toggle-opened", function(){
				if($(this).html() == "-"){
					$(this).html("+");
				}else{
					$(this).html("-");
				}
			});
		}
	});	
})

function get_service_details(id){
	$.ajax({
		url: "<?php echo site_url();?>dashboard/get_service_details/"+id,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$(".each-service-brief[data-id="+id+"]").siblings(".each-service-detail").find(".service-by").html("Service by "+item.company);//company will always be the same
				$(".each-service-brief[data-id="+id+"]").siblings(".each-service-detail").find(".service-entry-ul").append("<li class='line-height-30'><div class='service-entry-bullet-cat service-entry-bullet-cat-"+item.service_entry_cat_id+"'></div>"+item.service_entry_description+"</li>");
			})
		}
	});
}

function get_part_changed_details(id){
	$.ajax({
		url: "<?php echo site_url();?>dashboard/get_part_changed_details/"+id,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$(".each-service-brief[data-id="+id+"]").siblings(".each-service-detail").find(".parts-changed-ul").append("<li><div class='part-type-bullet-cat part-type-bullet-cat-"+item.part_type_cat_id+"'></div><div class='font-600 line-height-30'>"+item.part_type_cat_name+"</div><div class='font-600' style='margin-left:40px;'>"+item.part_type_name+"</div><div class='line-height-30' style='margin-left:40px;'>"+item.part_manufacture_name+" "+item.part_name+" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+item.part_description+"<span class='float-right part-group-"+item.part_group_id+"'><div class='part-group-bullet part-group-bullet-"+item.part_group_id+"'></div>"+item.part_group_description+"</span></div></li><br />");
			})
		}
	});
}

function get_change_soon_details(id){
	$.ajax({
		url: "<?php echo site_url();?>dashboard/get_change_soon_details/"+id,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				$(".each-service-brief[data-id="+id+"]").siblings(".each-service-detail").find(".change-soon-ul").append("<li><div class='part-type-bullet-cat part-type-bullet-cat-"+item.part_type_cat_id+"'></div><div class='font-600 line-height-30'>"+item.part_type_cat_name+"</div><div class='font-600' style='margin-left:40px;'>"+item.part_type_name+"</div><div class='line-height-30' style='margin-left:40px;'>"+item.part_manufacture_name+" "+item.part_name+" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+item.part_description+"<span class='float-right part-group-"+item.part_group_id+"'><div class='part-group-bullet part-group-bullet-"+item.part_group_id+"'></div>"+item.part_group_description+"</span></div></li><br />");
			})
		}
	});
}
</script>

</body>
</html>