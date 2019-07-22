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
	<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (a_name_no='$snewsid') and (c_kind='$sckind')");
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
    <div id="teamView">
    	<div class="left"><span style="background-image: url(<?=$sub_multidata?>/<?=$a_pic?>);">Avatar here</span></div><!--end left-->
    	<div class="right">
          <h1><?=$a_name?></h1>
	        <?=$a_des?>
        </div><!--end right-->
        <div class="clr"></div>
    </div><!--end teamView-->
    <div class="clr"></div>
	<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (c_kind='$sckind') and (a_id<>'$a_id') order by  a_id  desc");
	if (@mysql_num_rows($sql_list)){
	?>
    <div class="pageNav" id="otherPerNav">
    	<div class="rightTitle">
        	<h1><?=$lb_themnhansu_vigor?></h1>
        	<div class="slidePagi Right" id="newsPagi"></div>
    	</div>
    </div>
    <div id="homeNews_main" class="otherPer">
        <div id="homeNews">
            <ul>
			<?
	
	while($rows = mysql_fetch_array($sql_list)){
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name]);$a_ghichu = outputdata($rows[a_ghichu]);}
		else{$a_name = outputdata($rows[a_name_en]);$a_ghichu = outputdata($rows[a_ghichu_en]);}
		echo " <li class='onePer'>
		            <h2><a href='$sub_root/nhan-su-chu-luc/$a_name_no' style='background-image:url($sub_multidata/$a_pic);'></a></h2>
		            <h1>
			            <a href='$sub_root/nhan-su-chu-luc/$a_name_no'>$a_name</a>
			            <em>$a_ghichu</em>
		            </h1>
		        </li>";
	}
	?> 
            </ul>
            <div class="clr"></div>
        </div><!--end homeNews-->
        <script type="text/javascript">
            jQuery(document).ready(function(){
                var $oneNews = $('.oneNews');
                $oneNews.imagesLoaded( function(){
                    $("#homeNews ul").carouFredSel({
                        circular: false,
                        infinite: true,
						width: "100%",
                        auto 	: {
                            pauseDuration: 5000
                        },
                        pagination: "#newsPagi",
                        scroll	: {
                            items	: 'page',
                            fx		: 'linear'
                        },
                        prev	: false,
                        next	: false,
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
    </div><!--end homeNews_main--><? }?>
	<div class="clr"></div>
</div><!--end colRight-->