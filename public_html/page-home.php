<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
    <div id="homeTop">
        <div id="showText">
                 <?
$kind=1;
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
        </div><!--end showText-->
        <div class="clr"></div>
    </div><!--end homeTop-->
    <div id="homeSer_main">
        <h1><? $kind=23;$qr=mysql_query("select * from tbl_page where kind='$kind'");if (@mysql_num_rows($qr)){
				if ($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en'));else echo outputdata(@mysql_result($qr,0,'content'));
			}?></h1>
        <div id="homeSer" class="homeSer">
            <ul>
	<?
	$sql_banner = mysql_query("select * from  tbl_goikham where hienthi=1 order by sapxep,lienketid");
	while($rowsbn = mysql_fetch_array($sql_banner)){
		if($se_lang=="eng") {$s_text = outputdata($rowsbn[s_text_en]);$a_gioithieu_bn = outputdata($rowsbn[a_gioithieu_en]);}
		else{$s_text = outputdata($rowsbn[s_text]);$a_gioithieu_bn = outputdata($rowsbn[a_gioithieu]);}
		$s_pic = $rowsbn[s_pic];$s_link = outputdata($rowsbn[s_link]);
		echo " <li>
                    <a href='$s_link' class='Img'><img src='$sub_multidata/$s_pic' alt='$s_text'></a>
                    <h2><a href='$s_link'>$s_text</a></h2>
                    <p>$a_gioithieu_bn</p>
                </li>";
	}
	?>
            </ul>
            <div class="clr"></div>
        </div><!--end homeSer-->
        <div class="pagiCen" id="pagiSer"><a href="#" class="selected"><span>1</span></a><a href="#"><span>2</span></a></div>
        <div class="clr"></div>
        <script type="text/javascript">
	        jQuery(document).ready(function(){
	            $(".homeSer ul").carouFredSel({
	                circular: false,
	                infinite: true,
	                pagination: "#pagiSer",
	                auto 	: {
	                    pauseDuration : 5000,
	                },
	                scroll	: {
	                    items	: "page",
	                    fx		: 'linear'
	                },
	                swipe: {
	                    onMouse: true,
	                    onTouch: true,
	                },
	                items : {
	                    height: "variable"
	                }
	            });
	        });
	    </script>
    </div><!--end homeSer_main-->
    <div id="homeNews_wrap">
        <div class="rightTitle">
            <h1><?=$lb_tintuc_sukien?></h1>
            <div class="slidePagi Right" id="newsPagi"></div>
        </div>
        <div id="homeNews_main">
            <div id="homeNews" class="homeNews">
                <ul>
	<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (c_kind='1') order by  a_sort,a_id  desc limit 0,8");
	while($rows = mysql_fetch_array($sql_list)){
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);}
		$c_id_top = $rows[c_id];
		$sql_cata_top = mysql_query("select * from tbl_cata  where c_id='$c_id_top'");
		$c_name_no_t=trim(mysql_result($sql_cata_top,0,'c_name_no'));
		if($se_lang=="eng")$c_name=trim(mysql_result($sql_cata_top,0,'c_name_en'));else $c_name=trim(mysql_result($sql_cata_top,0,'c_name'));
		$str_pic="";if($a_pic) $str_pic="<img src='$sub_multidata/$a_pic' width='270' alt='$a_name'>";
                  echo" <li class='oneNews'>
                        <h2>
                           $str_pic
                            <a href='$sub_root/tin-tuc/$c_name_no_t/$a_name_no' class='pattern'><label></label></a>
                            <span><a href='$sub_root/tin-tuc/$c_name_no_t'>$c_name</a></span>
                        </h2>
                        <h1><a href='$sub_root/tin-tuc/$c_name_no_t/$a_name_no''>$a_name</a></h1>
                        <p>$a_gioithieu</p>
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
                        $(".homeNews ul").carouFredSel({
                            circular: false,
                            infinite: true,
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
        </div><!--end homeNews_main-->
        <div class="clr"></div>
    </div><!--end homeNews_wrap-->
    <div id="homeBottom">
        <div class="title">
            <h1><?=$lb_doingu_bacsi?></h1>
            <span>
			<? $kind=27;$qr=mysql_query("select * from tbl_page where kind='$kind'");
			if (@mysql_num_rows($qr)){if($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en')); else echo outputdata(@mysql_result($qr,0,'content'));}?></span>
            <a href="<?=$sub_root?>/nhan-su-chu-luc-vigor" class="viewmore"><?=$lb_xemthem?></a>
        </div>
        <div id="showText" style="margin: 0 20px;">
        <?
$kind=5;
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
        </div><!--end showText-->
    </div><!--end homeBottom-->
    <div class="clr"></div>
</div><!--end colRight-->