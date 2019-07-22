<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/khach-hang"><?=$lb_khachhang?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_khachhang?></h1></div>
    </div>
    <div id="customers">
    	<div id="slideGroup">
		<?
	$sql_list = mysql_query("select  * from tbl_linksp where hienthi=1 order by sapxep,lienketid");
	$k=0;$sopt = @mysql_num_rows($sql_list);
	while($rows = mysql_fetch_array($sql_list)){
		$k++;
		$s_pic = $rows[s_pic];$s_link =outputdata($rows[s_link]);$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$s_text = outputdata($rows[s_text_en]);}else{$s_text = outputdata($rows[s_text]);}
		if($k%12==1) echo "<ul class='slideBox'>";
		echo "<li><a href='$s_link' target='_blank'><img src='$sub_multidata/$s_pic' alt='$s_text'/></a><h1>$s_text<span></span></h1></li>";
		if(($k%12==0) ||($k==$sopt)) echo "<div class='clr'></div></ul>";
	}
	?>
        </div><!--end slideGroup-->
        <div class="clr"></div>
    </div><!--end customers-->
	<? if($sopt>12){ ?>
    <div id="nums">
    	<a href="#" class="pn prev"><span>&laquo;</span> <?=$lb_truoc?></a>
        <div class="pagiGroup"></div>
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
	<div class="clr"></div>
	<? }?>
</div><!--end colRight-->