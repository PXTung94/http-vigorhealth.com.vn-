<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/gioi-thieu"><?=$lb_gioithieu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/cam-nghi-khach-hang"><?=$lb_camnghi_khachhang?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_camnghi_khachhang?></h1></div>
    </div>
	<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (a_name_no='$snewsid') and (c_kind='$sckind')");
	if (!(@mysql_num_rows($sql_list))){echo "<script>location.href='$sub_root';</script>";exit();}
	$rows = mysql_fetch_array($sql_list);
		$a_id = $rows[a_id];$a_pic = $rows[a_pic];
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_des = outputdata($rows[a_des_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_des = outputdata($rows[a_des]);}
				
		$sql_picogiua = mysql_query("select * from tb_hinhgiuatin where a_id='$a_id' order by n_vitri");
		while($rowspic = mysql_fetch_array($sql_picogiua)){
			$n_vitri = $rowspic[n_vitri];
			$p_pic = $rowspic[p_pic];
			$chuoitim="&quot;{{image".$n_vitri."}}&quot;";
			$chuoithay="'"."$sub_multidata/".$p_pic."'";
			$a_des=str_replace($chuoitim,$chuoithay,$a_des);
			$chuoitim="{{image".$n_vitri."}}";
			$chuoithay="$sub_multidata/".$p_pic;
			$a_des=str_replace($chuoitim,$chuoithay,$a_des);
		}
		$a_des=str_replace("&quot;",'"',$a_des);	

?>
    <div id="showText" class="textInside newsView">
    	<h1 class="linkName"><?=$a_name?></h1>
    	<p><img src="<?=$sub_multidata?>/<?=$a_pic?>" alt="<?=$a_name?>"></p>
		<?=$a_des?>
        <div class="clr"></div>
    </div><!--end showText-->
	<div class="clr"></div>
</div><!--end colRight-->