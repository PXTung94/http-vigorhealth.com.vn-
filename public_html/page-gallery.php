<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/thu-vien-anh"><?=$lb_thuvienanh?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_thuvienanh?></h1></div>
    </div>
	<?
	$sql_list = mysql_query("select * from tbl_subcollection where (hienthi=1) order by sort, idsubcollection desc ");
	$sopt = @mysql_num_rows($sql_list);
	$k=0;$str_css_album="";$str_image_album="";
	while($rows = mysql_fetch_array($sql_list)){
		$name_no=trim($rows['name_no']);$preimage=$rows['preimage'];
		if($se_lang=="vn") {$name = outputdata($rows[name]);}else{$name = outputdata($rows[name_en]);}
		$k++;
		$str_css_album.="#gal-$k { background-image:url($sub_multidata/$preimage);}";
		if($k%9==1) $str_image_album.="<ul class='slideBox'>";
		$str_image_album.="<li><a href='$sub_root/thu-vien-anh/$name_no' id='gal-$k'><span></span></a><h1>$name</h1></li>";
		if(($k%9==0) ||($k==$sopt)) $str_image_album.="<div class='clr'></div></ul>";
	}
	?>
    <div id="gallery">
        <style type="text/css">
		<?=$str_css_album?>
        </style>
    	<div id="slideGroup">
	    	<?=$str_image_album?>
        </div><!--end slideGroup-->
        <div class="clr"></div>
    </div><!--end gallery-->
	<? if($sopt>9){ ?>
    <div id="nums">
    	<a href="#" class="pn prev"><span>&laquo;</span> <?=$lb_truoc?></a>
    	<div class="pagiGroup"></div><!--end pagiCus-->
    	<a href="#" class="pn next"><?=$lb_tiep?> <span>&raquo;</span></a>
        <div class="clr"></div>
    </div><!--end nums-->
    <script type="text/javascript">
		jQuery(document).ready(function(){
			var $oneCus = $('#customers ul');
			$oneCus.imagesLoaded( function(){
				$("#slideGroup").carouFredSel({
					circular: false,
					infinite: false,
					auto 	: false,
					pagination: ".pagiGroup",
					scroll	: {
						items	: 'page',
						fx		: 'crossfade'
					},
					prev	: ".pn.prev",
					next	: ".pn.next",
					swipe: {
						onMouse: true,
						onTouch: true
					},
					items : {
						height: 'variable',
						width: 'variable',
					}
				});
			});
		});
	</script>
	<? }?>
	<div class="clr"></div>
</div><!--end colRight-->