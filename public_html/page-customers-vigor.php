<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/khach-hang-vigor"><?=$lb_khachhang?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_khachhang?></h1></div>
    </div>
	<div class="clr"></div>
    <div id="showText" class="textInside">
<?
$kind=3;
$qr=mysql_query("select * from tbl_page where kind='$kind'");
if (@mysql_num_rows($qr)){
    $id_id=trim(@mysql_result($qr,0,'id'));
    if($se_lang=="vn") $content=outputdata(@mysql_result($qr,0,'content')); else $content=outputdata(@mysql_result($qr,0,'content_en'));
    $sql_picogiua = mysql_query("select * from tbl_pic_page where n_id='$id_id' and kind=$kind order by n_vitri");
    while($rowspic = mysql_fetch_array($sql_picogiua)){
        $n_vitri = $rowspic[n_vitri];
        $p_pic = $rowspic[p_pic];
        $chuoitim="{{image".$n_vitri."}}";
        $chuoithay="$sub_multidata/".$p_pic;
        $content=str_replace($chuoitim,$chuoithay,$content);
    }
    $content=str_replace("$"."irand",$irand,$content);
    echo $content;
}
?>
        <div class="clr"></div>
    </div><!--end showText-->
	<div class="clr"></div>
</div><!--end colRight-->