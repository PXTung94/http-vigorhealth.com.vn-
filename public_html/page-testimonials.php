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
	$qr_tv="select * from  tbl_news where (a_of=1) and (c_kind='$sckind') order by  a_id  desc";
	$numview = 6;
	if($pz=="") $pzz = 0; else $pzz = $pz * $numview;
	$sql_list = mysql_query("$qr_tv limit $pzz,$numview");
	$sql_num = mysql_query("$qr_tv");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = ceil($numlist/$numview);
	$css_news="";$content_news="";
	$k=0;
	while($rows = mysql_fetch_array($sql_list)){
		$k++;
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);$a_ghichu = outputdata($rows[a_ghichu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);$a_ghichu = outputdata($rows[a_ghichu]);}
		$css_news.="  #cus-$k { background-image: url($sub_multidata/$a_pic);}";
		$content_news.="<li class='oneThink'>
        	<a href='$sub_root/cam-nghi-khach-hang/$a_name_no' class='cusAva'><label id='cus-$k'>Avatar</label></a>
            <div class='left'>
	            <h1><a href='$sub_root/cam-nghi-khach-hang/$a_name_no'>$a_name</a></h1>
				<span>$a_ghichu</span>
				<p>$a_gioithieu
                    <div class='clr'></div>
                    <a href='$sub_root/cam-nghi-khach-hang/$a_name_no' class='viewmore'>$lb_xemchitiet</a>
	            </p>
            </div>
            <div class='clr'></div>
        </li>";
	}
	?>
    <div id="testimonials">
    	<style type="text/css">
       <?=$css_news?>
        </style>
    	 <?=$content_news?>
        <div class="clr"></div>
    </div><!--end showText-->
	<div class="clr"></div>
	<?
	$str_pagelist="";
	if($numshow > 1){
		$pmin = $pz-1;$pmax = $pz+1;$gioihancuanum = 10;
		if($pz+1-$gioihancuanum>0) $batdau = $pz+1-$gioihancuanum; else $batdau = 0;
			$ketthuc = $batdau + $gioihancuanum;
			if ($ketthuc>$numshow) $ketthuc = $numshow;
			if($pz) $str_pagelist.="<a href='$sub_root/cam-nghi-khach-hang/$pmin' class='pn'><span>&laquo;</span> $lb_truoc</a>";
			if ($batdau <= $ketthuc){
				for($i = $batdau; $i < $ketthuc; $i++){
					$k = $i+1;
					if($i==$pz) $str_pagelist.="<a href='$sub_root/cam-nghi-khach-hang/$i' class='current'>$k</a>";
					else $str_pagelist.="<a href='$sub_root/cam-nghi-khach-hang/$i'>$k</a>";
				}
			}
			if(!($pz>=$numshow-1)) $str_pagelist.="<a href='$sub_root/cam-nghi-khach-hang/$pmax' class='pn next'>$lb_tiep <span>&raquo;</span></a>";
		}
		if($str_pagelist){?>
		 <div id="nums">
			<?=$str_pagelist?>
			<div class="clr"></div>
		</div><!--end nums-->
		<? }?>
</div><!--end colRight-->