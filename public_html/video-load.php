<? include("allhead.php"); ?>
<?php
	$idVideo = $_GET["id"];
	$v_id=str_replace("video-","",$id);
	$sql_qr_video=mysql_query("select * from tbl_video where (v_of=1) and (v_id='$v_id')");
	$v_lienket_video = outputdata(@mysql_result($sql_qr_video,0,"v_lienket"));
	if($se_lang=="vn"){
		$v_name_video = outputdata(@mysql_result($sql_qr_video,0,"v_name"));$v_des_video= outputdata(@mysql_result($sql_qr_video,0,'v_des'));
	}else{
		$v_name_video = outputdata(@mysql_result($sql_qr_video,0,"v_name_en"));$v_des_video= outputdata(@mysql_result($sql_qr_video,0,'v_des_en'));
	}
?>
<h1 class="titleNews"><?=$v_name_video?></h1>
<?=$v_lienket_video?>
<div id="videoDesc">
    <p><?=$lb_mota_video?></p>
    <?=$v_des_video?>
</div>
<div id="showmore"><span><?=$lb_xemthem?></span><label><?=$lb_rutgon?></label></div>
<div class="clr"></div>
<div class="pageNav"><div class="rightTitle"><div class="fix"><?=$lb_video_khac?></div></div></div>
<div class="clr"></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#showmore span").click(function(){
		$("#videoDesc").addClass("auto");
		$("#showmore label").css({"display":"block"});
		$("#showmore span").css({"display":"none"});
	});
	$("#showmore label").click(function(){
		$("#videoDesc").removeClass("auto");
		$("#showmore span").css({"display":"block"});
		$("#showmore label").css({"display":"none"});
	});
	var descHeight = $("#videoDesc").outerHeight(true);
	if(descHeight > 115) {
		$("#showmore").show();
	}else{
		$("#showmore").hide();
	}
});
</script>