<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/galleria.folio.css"/>
<script src="<?=$sub_root?>/js/galleria-1.2.8.min.js"></script>
<script src="<?=$sub_root?>/js/galleria.folio.min.js"></script>
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
$lis1 = mysql_query("select * from tbl_subcollection where  (hienthi=1) and (name_no='$sid')");
if (!@mysql_num_rows($lis1)){echo "<script>location.href='$sub_root';</script>";exit();}
$idsubcollection= trim(@mysql_result($lis1,0,'idsubcollection')); 
if($se_lang=="vn"){ $name_collection=outputdata(@mysql_result($lis1,0,"name")); }else{ $name_collection=outputdata(@mysql_result($lis1,0,"name_en"));}
$sort=trim(@mysql_result($lis1,0,"sort"));
$numview=20;
if($pz=="") $pzz = 0; else $pzz = $pz * $numview;
$query="select * from tbl_album  where (idsubcollection ='$idsubcollection') order by sort,idalbum ";
$sql_list = mysql_query("$query limit $pzz,$numview");
$sql_num = mysql_query("$query");
$numlist = @mysql_num_rows($sql_num);
$numshow = (int)$numlist/$numview; 
?>
    <div class="linkName galName"><?=$name_collection?></div>
    <div id="galView">
	<?
	while($rows = mysql_fetch_array($sql_list)){
			$imagepic=$rows['image']; echo "<a href='$sub_multidata/$imagepic' title='$name_collection'><img src='$sub_resizemultidata/$imagepic' alt='$name_collection'></a>";
	}
	?>
        <div class="clr"></div>
    </div><!--end galView-->
    <?
	$str_pagelist="";
	if($numshow > 1){
		$pmin = $pz-1;$pmax = $pz+1;$gioihancuanum = 10;
		if($pz+1-$gioihancuanum>0) $batdau = $pz+1-$gioihancuanum; else $batdau = 0;
			$ketthuc = $batdau + $gioihancuanum;
			if ($ketthuc>$numshow) $ketthuc = $numshow;
			if($pz) $str_pagelist.="<a href='$sub_root/thu-vien-anh/$sid/$pmin' class='pn'><span>&laquo;</span> $lb_truoc</a>";
			if ($batdau <= $ketthuc){
				for($i = $batdau; $i < $ketthuc; $i++){
					$k = $i+1;
					if($i==$pz) $str_pagelist.="<a href='$sub_root/thu-vien-anh/$sid/$i' class='current'>$k</a>";
					else $str_pagelist.="<a href='$sub_root/thu-vien-anh/$sid/$i'>$k</a>";
				}
			}
			if(!($pz>=$numshow-1)) $str_pagelist.="<a href='$sub_root/thu-vien-anh/$sid/$pmax' class='pn next'>$lb_tiep <span>&raquo;</span></a>";
		}
		if($str_pagelist){?>
		 <div id="nums">
			<?=$str_pagelist?>
			<div class="clr"></div>
		</div><!--end nums-->
		<? }?>
    <div class="clr"></div>
	<script>
		Galleria.loadTheme('<?=$sub_root?>/js/galleria.folio.min.js');
		$("#galView").galleria({
			imageCrop: false,
			maxScaleRatio: 1,
			preload: 3,
			fullscreenTransition:'slide'
		});
		Galleria.run('#galView');
	</script>
	<?
	$sql_list = mysql_query("select * from tbl_subcollection where (hienthi=1) and (idsubcollection<>'$idsubcollection') order by sort, idsubcollection desc ");
	$sopt = @mysql_num_rows($sql_list);
	if($sopt){
	?>
    <div class="pageNav">
    	<div class="rightTitle"><h1><?=$lb_album_khac?></h1></div>
    </div>
	<?
	
	$k=0;$str_css_album="";$str_image_album="";
	while($rows = mysql_fetch_array($sql_list)){
		$name_no=trim($rows['name_no']);$preimage=$rows['preimage'];
		if($se_lang=="vn") {$name = outputdata($rows[name]);}else{$name = outputdata($rows[name_en]);}
		$k++;
		$str_css_album.="#gal-$k { background-image:url($sub_multidata/$preimage);}";
		if($k%6==1) $str_image_album.="<ul class='slideBox'>";
		$str_image_album.="<li><a href='$sub_root/thu-vien-anh/$name_no' id='gal-$k'><span></span></a><h1>$name</h1></li>";
		if(($k%6==0) ||($k==$sopt)) $str_image_album.="<div class='clr'></div></ul>";
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
	<? if($sopt>6){ ?>
    <div id="nums">
    	<a href="#" class="pn prev"><span>&laquo;</span> <?=$lb_truoc?></a>
    	<div class="pagiGroup"></div><!--end pagiCus-->
    	<a href="#" class="pn next"><?=$lb_tiep?> <span>&raquo;</span></a>
        <div class="clr"></div>
    </div><!--end nums-->
    <script type="text/javascript">
		jQuery(document).ready(function(){
			var $oneGal = $('#customers ul');
			$oneGal.imagesLoaded( function(){
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
	<? }?>
</div><!--end colRight-->