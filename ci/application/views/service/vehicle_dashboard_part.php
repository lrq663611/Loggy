<?php
$this->load->view('common/mechanic_header');
?>
<?php
$this->load->view('service/common/top_tab_section_vehicle_dashboard');
?>

<!--something is included in top_tab_section_vehicle_dashboard-->
		<div class="each-service-container">
			<div class="white-gear-bullet white-bullet"></div>
			<div class="each-service">
				<div class="each-service-brief" style="line-height: inherit;">
					<div class="dashboard-part-type-cat">Mechanical</div>
					<span class="plus-minus-btn dashboard-btn toggle-closed" style="line-height: 40px; margin-top: 20px;">+</span>
				</div>
				<?php if($mechanical){?>
					<div class="each-service-detail">
						<?php foreach($mechanical as $part_type):?>
							<div class="part-profile-title"><?=$part_type['part_type_name']?> <span class="short-description"><?=$part_type['part_type_description']?></span></div>
							<ul class="part-profile-ul" data-part-type-id="<?=$part_type['part_type_id']?>">
							</ul>
						<?php endforeach ?>
					</div>
				<?php }?>
			</div>
		</div>
		<div class="each-service-container">
			<div class="white-flash-bullet white-bullet"></div>
			<div class="each-service">
				<div class="each-service-brief" style="line-height: inherit;">
					<div class="dashboard-part-type-cat">Electrical</div>
					<span class="plus-minus-btn dashboard-btn toggle-closed" style="line-height: 40px; margin-top: 20px;">+</span>
				</div>
				<?php if($electrical){?>
					<div class="each-service-detail">
						<?php foreach($electrical as $part_type):?>
							<div class="part-profile-title"><?=$part_type['part_type_name']?> <span class="short-description"><?=$part_type['part_type_description']?></span></div>
							<ul class="part-profile-ul" data-part-type-id="<?=$part_type['part_type_id']?>">
							</ul>
						<?php endforeach ?>
					</div>
				<?php }?>
			</div>
		</div>
		<div class="each-service-container">
			<div class="white-car-bullet white-bullet"></div>
			<div class="each-service">
				<div class="each-service-brief" style="line-height: inherit;">
					<div class="dashboard-part-type-cat">Exterior</div>
					<span class="plus-minus-btn dashboard-btn toggle-closed" style="line-height: 40px; margin-top: 20px;">+</span>
				</div>
				<?php if($exterior){?>
					<div class="each-service-detail">
						<?php foreach($exterior as $part_type):?>
							<div class="part-profile-title"><?=$part_type['part_type_name']?> <span class="short-description"><?=$part_type['part_type_description']?></span></div>
							<ul class="part-profile-ul" data-part-type-id="<?=$part_type['part_type_id']?>">
							</ul>
						<?php endforeach ?>
					</div>
				<?php }?>
			</div>
		</div>
		<div class="each-service-container">
			<div class="white-wheel-bullet white-bullet"></div>
			<div class="each-service">
				<div class="each-service-brief" style="line-height: inherit;">
					<div class="dashboard-part-type-cat">Interior</div>
					<span class="plus-minus-btn dashboard-btn toggle-closed" style="line-height: 40px; margin-top: 20px;">+</span>
				</div>
				<?php if($interior){?>
					<div class="each-service-detail">
						<?php foreach($interior as $part_type):?>
							<div class="part-profile-title"><?=$part_type['part_type_name']?> <span class="short-description"><?=$part_type['part_type_description']?></span></div>
							<ul class="part-profile-ul" data-part-type-id="<?=$part_type['part_type_id']?>">
							</ul>
						<?php endforeach ?>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('common/footer');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
$(function(){
	$(".part-profile-ul").each(function(){
		part_profile(<?=$this->uri->segment(3)?>, $(this).attr('data-part-type-id'));
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

function part_profile(vehicle_id, part_type_id){
	$.ajax({
		url: "<?php echo site_url();?>service/part_profile/"+vehicle_id+"/"+part_type_id,
		dataType: "json",
		success: function(msg) {
			$.each(msg, function(i,item){
				if(item.part_name_changed == null){//not changed, show the original parts information
					$(".part-profile-ul[data-part-type-id="+part_type_id+"]").append("<li><div class='line-height-30'>"+item.part_manufacture_name_original+" "+item.part_name_original+" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+item.part_description_original+"<span class='float-right part-group-"+item.part_group_id_original+"'><div class='part-group-bullet part-group-bullet-"+item.part_group_id_original+"'></div>"+item.part_group_description_original+"</span></div></li>");
				}
				else{//part has been changed, show changed parts information
					$(".part-profile-ul[data-part-type-id="+part_type_id+"]").append("<li><div class='line-height-30'>"+item.part_manufacture_name_changed+" "+item.part_name_changed+" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+item.part_description_changed+"<span class='float-right part-group-"+item.part_group_id_changed+"'><div class='part-group-bullet part-group-bullet-"+item.part_group_id_changed+"'></div>"+item.part_group_description_changed+"</span></div></li>");
				}
			});
		}
	});
}
</script>

</body>
</html>