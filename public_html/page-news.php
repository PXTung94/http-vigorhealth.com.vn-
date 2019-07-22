<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<?
$tieude_news_second=$lb_tintuc;$str_phantrang="$sub_root/tin-tuc";
if($scnewsid){
	$str_phantrang="$sub_root/tin-tuc/$scnewsid";
	$sql_news = mysql_query("select  * from tbl_cata where c_of=1 and (c_name_no='$scnewsid') and (c_kind='$sckind') order by c_sort,c_id");
	if (!(@mysql_num_rows($sql_news))){echo "<script>location.href='$sub_root';</script>";exit();}
	$luu_cid=@mysql_result($sql_news,0,'c_id');
	if($se_lang=="eng") $c_name_cata=@mysql_result($sql_news,0,'c_name_en'); else $c_name_cata=@mysql_result($sql_news,0,'c_name'); 
	$tieude_news_second=$c_name_cata;
	$qr_tv="select * from  tbl_news where (a_of=1) and (c_kind='$sckind') and (c_id='$luu_cid') order by  a_sort,a_id  desc";
}else{
	$qr_tv="select * from  tbl_news where (a_of=1) and (c_kind='$sckind') order by  a_sort,a_id  desc";
}
?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/tin-tuc"><?=$lb_tintuc?></a></li>
			<?
			if($scnewsid){?>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/tin-tuc/<?=$scnewsid?>"><?=$c_name_cata?></a></li>
			<? }?>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$tieude_news_second?></h1></div>
    </div>
    <div id="news" class="newsKind">
	<?
	$numview = 9;
	if($pz=="") $pzz = 0; else $pzz = $pz * $numview;
	$sql_list = mysql_query("$qr_tv limit $pzz,$numview");
	$sql_num = mysql_query("$qr_tv");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = ceil($numlist/$numview);
	while($rows = mysql_fetch_array($sql_list)){
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);}
		$c_id_top = $rows[c_id];
		$sql_cata_top = mysql_query("select * from tbl_cata  where c_id='$c_id_top'");
		$c_name_no_t=trim(mysql_result($sql_cata_top,0,'c_name_no'));
		$str_pic="";if($a_pic) $str_pic="<img src='$sub_multidata/$a_pic' width='270' alt='$a_name'>";
		echo "<li class='oneNews'>
	        <h2>
	            $str_pic
	            <a href='$sub_root/tin-tuc/$c_name_no_t/$a_name_no' class='pattern'><label></label></a>
                <span></span>
	        </h2>
	        <h1><a href='$sub_root/tin-tuc/$c_name_no_t/$a_name_no'>$a_name</a></h1>
	        <p>$a_gioithieu</p>
	    </li>";
	}
	?>
		<div class="clr"></div>
    </div>
	<?
	$str_pagelist="";
	if($numshow > 1){
		$pmin = $pz-1;$pmax = $pz+1;$gioihancuanum = 10;
		if($pz+1-$gioihancuanum>0) $batdau = $pz+1-$gioihancuanum; else $batdau = 0;
			$ketthuc = $batdau + $gioihancuanum;
			if ($ketthuc>$numshow) $ketthuc = $numshow;
			if($pz) $str_pagelist.="<a href='$str_phantrang/$pmin' class='pn'><span>&laquo;</span> $lb_truoc</a> ";
			if ($batdau <= $ketthuc){
				for($i = $batdau; $i < $ketthuc; $i++){
					$k = $i+1;
					if($i==$pz) $str_pagelist.=" <a href='$str_phantrang/$i' class='current'>$k</a> ";
					else $str_pagelist.=" <a href='$str_phantrang/$i'>$k</a> ";
				}
			}
			if(!($pz>=$numshow-1)) $str_pagelist.=" <a href='$str_phantrang/$pmax' class='pn next'>$lb_tiep <span>&raquo;</span></a>";
		}
		if($str_pagelist){?>
		 <div id="nums">
			<?=$str_pagelist?>
			<div class="clr"></div>
		</div><!--end nums-->
		<? }?>
    <script type="text/javascript">
		var $news = $('#news');
		$news.imagesLoaded( function(){
			$news.masonry({
				itemSelector : '.oneNews',
				columnWidth: 0
			});
		});
	</script>
    <div class="clr"></div>
</div><!--end colRight-->