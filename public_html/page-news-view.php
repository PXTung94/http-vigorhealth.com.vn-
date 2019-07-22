<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<?
$sql_news = mysql_query("select  * from tbl_cata where c_of=1 and (c_name_no='$scnewsid') and (c_kind='$sckind') order by c_sort,c_id");
	if (!(@mysql_num_rows($sql_news))){echo "<script>location.href='$sub_root';</script>";exit();}
	$luu_cid=@mysql_result($sql_news,0,'c_id');
	if($se_lang=="eng") $c_name_cata=@mysql_result($sql_news,0,'c_name_en'); else $c_name_cata=@mysql_result($sql_news,0,'c_name'); 
	
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (a_name_no='$snewsid') and (c_kind='$sckind') and (c_id='$luu_cid')");
	if (!(@mysql_num_rows($sql_list))){echo "<script>location.href='$sub_root';</script>";exit();}
	$rows = mysql_fetch_array($sql_list);
		$a_pic = $rows[a_pic];$a_id = $rows[a_id];$a_sort = $rows[a_sort];
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
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/tin-tuc"><?=$lb_tintuc?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/tin-tuc/<?=$scnewsid?>"><?=$c_name_cata?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$c_name_cata?></h1></div>
    </div>
    <div id="showText" class="textInside newsView">
    	<h1 class="linkName"><?=$a_name?></h1>
    	 <?=$a_des?>
        <div class="clr"></div>
    </div><!--end showText-->
	<?
$str_news_detail="";
$qr="select * from  tbl_news  where (a_of=1) and  (c_id='$luu_cid') and  ";
$qr.=" (a_of=1)  and (c_kind='$sckind') and  ((a_sort<$a_sort) or ((a_sort=$a_sort) and (a_id>$a_id))) order by a_sort asc,a_id  desc limit 0,5";
$sql_list = mysql_query("$qr");
while($rows = mysql_fetch_array($sql_list)){
	$a_name = outputdata($rows[a_name]);
	$a_name_no = outputdata($rows[a_name_no]);
	$str_news_detail.="<li><a href='$sub_root/tin-tuc/$scnewsid/$a_name_no' title='$a_name'>$a_name $str_a_date</a></li>";
}

$qr="select * from  tbl_news  where (a_of=1) and  (c_id='$luu_cid') and  ";
$qr.=" (a_of=1)  and (c_kind='$sckind') and  ((a_sort>$a_sort) or ((a_sort=$a_sort) and (a_id<$a_id))) order by a_sort asc,a_id  desc limit 0,5";
$sql_list = mysql_query("$qr");
while($rows = mysql_fetch_array($sql_list)){
	$a_name = outputdata($rows[a_name]);
	$a_name_no = outputdata($rows[a_name_no]);
	$str_news_detail.="<li><a href='$sub_root/tin-tuc/$scnewsid/$a_name_no' title='$a_name'>$a_name $str_a_date</a></li>";
}
if($str_news_detail){
?>

    <div class="pageNav"><div class="rightTitle"><h1><?=$lb_tinkhac?></h1></div></div>
    <ul class="otherNews">
		<?=$str_news_detail?>
        <div class="clr"></div>
    </ul>
<? }?>
	<div class="clr"></div>
</div><!--end colRight-->