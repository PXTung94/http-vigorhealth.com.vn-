<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/nhan-su-chu-luc"><?=$lb_nhanluc_chuluc?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_nhanluc_chuluc?></h1></div>
    </div>
    <div id="team" class="teamInside">
    	<div id="slideGroup">
		<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (c_kind='$sckind') order by  a_id  desc");
	$k=0;$sopt = @mysql_num_rows($sql_list);
	while($rows = mysql_fetch_array($sql_list)){
		$k++;
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);$a_ghichu = outputdata($rows[a_ghichu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);$a_ghichu = outputdata($rows[a_ghichu]);}
		if($k%12==1) echo "<ul class='slideBox'>";
		echo "<li class='onePer'>
		            <h2><a href='$sub_root/nhan-su-chu-luc/$a_name_no' style='background-image:url($sub_multidata/$a_pic);'></a></h2>
		            <h1>
			            <a href='$sub_root/nhan-su-chu-luc/$a_name_no'>$a_name</a>
			            <em>$a_ghichu</em>
		            </h1>
		            <p>$a_gioithieu</p>
		        </li>";
		if(($k%12==0) ||($k==$sopt)) echo "<div class='clr'></div></ul>";
	}
	?>
        </div><!--end slideGroup-->
        <div class="clr"></div>
    </div><!--end teamInside-->
	<? if($sopt>12){ ?>
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
    <div class="clr"></div>
	<? }?>
</div><!--end colRight-->