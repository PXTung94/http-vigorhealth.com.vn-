<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<?
$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where (page_parent=0) and (page_of=1) and (page_name_no='$spageid')");
if (!(@mysql_num_rows($sql_listcata))){echo "<script>location.href='$sub_root';</script>";exit();}
$page_id = trim(@mysql_result($sql_listcata,0,'page_id'));$page_name_no = trim(@mysql_result($sql_listcata,0,'page_name_no'));
if($se_lang=="eng") $page_name = trim(@mysql_result($sql_listcata,0,'page_name_en')); else  $page_name = trim(@mysql_result($sql_listcata,0,'page_name'));
if($spageidsub){
	$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where (page_parent='$page_id') and (page_of=1) and (page_name_no='$spageidsub')");
	$page_id = trim(@mysql_result($sql_listcata,0,'page_id'));$page_name_no = trim(@mysql_result($sql_listcata,0,'page_name_no'));
	if($se_lang=="eng"){ $page_name = trim(@mysql_result($sql_listcata,0,'page_name_en'));}else{  $page_name = trim(@mysql_result($sql_listcata,0,'page_name'));}
}



	$kind=$page_id;$content_statics="";
	$qr=mysql_query("select * from tbl_otherpage_dichvu where okind='$kind'");
	if (@mysql_num_rows($qr)){
		$id_id=trim(@mysql_result($qr,0,'id'));$file_download=trim(@mysql_result($qr,0,'page_file'));
		if ($se_lang=="eng"){$content_statics=outputdata(@mysql_result($qr,0,'content_en')); $title_download=outputdata(@mysql_result($qr,0,'title_file_en')); }
		else {$content_statics=outputdata(@mysql_result($qr,0,'content'));$title_download=outputdata(@mysql_result($qr,0,'title_file'));  }
		$sql_picogiua = mysql_query("select * from tbl_pic_otherpage_dichvu where n_id='$id_id' and kind=$kind order by n_vitri");
		while($rowspic = mysql_fetch_array($sql_picogiua)){
			$n_vitri = $rowspic[n_vitri];
			$p_pic = $rowspic[p_pic];
			$chuoitim="{{image".$n_vitri."}}";
			$chuoithay="$sub_multidata/".$p_pic;
			$content_statics=str_replace($chuoitim,$chuoithay,$content_statics);
		}
		$content_statics=str_replace("$"."irand",$irand,$content_statics);
	}
?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="#"><?=$lb_dichvu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/dich-vu/<?=$page_name_no?>"><?=$page_name?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$page_name?></h1></div>
    </div>
	<? if(($title_download)&& ($file_download)){ ?>
	<a href="<?=$sub_root?>/download-file/<?=$file_download?>" class="buttonAsk radius5"><span class="radius100 fix">&darr;</span><?=$title_download?></a>
	 <div class="clr"></div>
	 <? }?>
    <div id="showText" class="textInside">
    	<?=$content_statics?>
        <div class="clr"></div>
    </div><!--end showText-->
	<div class="clr"></div>
</div><!--end colRight-->