<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_diendan?></h1></div>
    </div>
    <a href="<?=$sub_root?>/dat-cau-hoi" class="buttonAsk radius5"><span class="radius100">?</span><?=$lb_dat_cau_hoi?></a>
    <div class="clr"></div>
    <div id="testimonials" class="faq">
	<?
	$qr_tv="select * from  tbl_news where (a_of=1) and (c_kind='$sckind') order by  a_id  desc";
	$numview = 6;
	if($pz=="") $pzz = 0; else $pzz = $pz * $numview;
	$sql_list = mysql_query("$qr_tv limit $pzz,$numview");
	$sql_num = mysql_query("$qr_tv");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = ceil($numlist/$numview);
	while($rows = mysql_fetch_array($sql_list)){
		$a_name_no = outputdata($rows[a_name_no]);
		$a_date = trim($rows[a_date]);$str_date=substr($a_date,6,2)."-".substr($a_date,4,2)."-".substr($a_date,0,4)." ".substr($a_date,8,2).":".substr($a_date,10,2);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);$a_ghichu = outputdata($rows[a_ghichu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);$a_ghichu = outputdata($rows[a_ghichu]);}
		if($a_ghichu) $str_date=$a_ghichu.", ".$str_date;
		echo "<li class='oneThink'>
            <h1><a href='$sub_root/dien-dan/$a_name_no'>$a_name</a></h1>
            <span> $str_date</span>
            <p>$a_gioithieu
                <div class='clr'></div>
                <a href='$sub_root/dien-dan/$a_name_no' class='viewmore'>$lb_xemchitiet</a><a href='$sub_root/dien-dan/$a_name_no#replyFaq' class='viewmore'>$lb_guiphanhoi</a>
            </p>
            <div class='clr'></div>
        </li>";
	}
	?>
    </div><!--end faq-->
	<div class="clr"></div>
	<?
	$str_pagelist="";
	if($numshow > 1){
		$pmin = $pz-1;$pmax = $pz+1;$gioihancuanum = 10;
		if($pz+1-$gioihancuanum>0) $batdau = $pz+1-$gioihancuanum; else $batdau = 0;
			$ketthuc = $batdau + $gioihancuanum;
			if ($ketthuc>$numshow) $ketthuc = $numshow;
			if($pz) $str_pagelist.="<a href='$sub_root/dien-dan/$pmin' class='pn'><span>&laquo;</span> $lb_truoc</a>";
			if ($batdau <= $ketthuc){
				for($i = $batdau; $i < $ketthuc; $i++){
					$k = $i+1;
					if($i==$pz) $str_pagelist.="<a href='$sub_root/dien-dan/$i' class='current'>$k</a>";
					else $str_pagelist.="<a href='$sub_root/dien-dan/$i'>$k</a>";
				}
			}
			if(!($pz>=$numshow-1)) $str_pagelist.="<a href='$sub_root/dien-dan/$pmax' class='pn next'>$lb_tiep <span>&raquo;</span></a>";
		}
		if($str_pagelist){?>
		 <div id="nums">
			<?=$str_pagelist?>
			<div class="clr"></div>
		</div><!--end nums-->
		<? }?>
</div><!--end colRight-->