<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/video"><?=$lb_video?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_video?></h1></div>
    </div>
    <div id="video">
		
        <div id="showVideo">
            <!-- video play here -->
			<?
            $sql_qr_video=mysql_query("select * from tbl_video where (v_of=1) order by v_sort, v_id desc limit 0,1");
			if(@mysql_num_rows($sql_qr_video)){
			$v_lienket_video = outputdata(@mysql_result($sql_qr_video,0,"v_lienket"));
			if($se_lang=="vn"){
				$v_name_video = outputdata(@mysql_result($sql_qr_video,0,"v_name"));$v_des_video= outputdata(@mysql_result($sql_qr_video,0,'v_des'));
			}else{
				$v_name_video = outputdata(@mysql_result($sql_qr_video,0,"v_name_en"));$v_des_video= outputdata(@mysql_result($sql_qr_video,0,'v_des_en'));
			}
			?>
            <h1 class="titleNews"><?=$v_name_video?></h1>
            <?=$v_lienket_video?>
            <div id="videoDesc">
               <?=$v_des_video?>
            </div>
            <div id="showmore"><span><?=$lb_xemthem?></span><label><?=$lb_rutgon?></label></div>
            <div class="clr"></div>
            <div class="pageNav"><div class="rightTitle"><div class="fix"><?=$lb_video_khac?></div></div></div>
			<? }?>
            <div class="clr"></div>
            <script type="text/javascript">
            jQuery(document).ready(function(){
                $("#showmore span").click(function(){
                    $("#videoDesc").addClass("auto");
                    $("#showmore label").css({"display":"block"});
                    $("#showmore span").css({"display":"none"});
                });
                $("#showmore label").click(function(){
                    $("#videoDesc").removeClass("auto");
                    $("#showmore span").css({"display":"block"});
                    $("#showmore label").css({"display":"none"});
                });
                var descHeight = $("#videoDesc").outerHeight(true);
                if(descHeight > 125) {
                    $("#showmore").show();
                }else{
                    $("#showmore").hide();
                }
            });
            </script>
        </div><!--end showVideo-->
        <div class="clr"></div>
		<?
			$sql_list = mysql_query("select * from tbl_video where (v_of =1) order by v_sort, v_id desc");
			$str_css="";$str_image="";$k=0;$sopt=@mysql_num_rows($sql_list);
			while($rows = mysql_fetch_array($sql_list)){
				$k++;
				if($se_lang=="vn"){$v_name = outputdata($rows[v_name]);$v_name_no = trim($rows[v_name_no]);$v_short = outputdata($rows[v_short]);}
				else{$v_name = outputdata($rows[v_name_en]);$v_name_no = trim($rows[v_name_en_no]);$v_short = outputdata($rows[v_short_en]);}
				$v_pic = trim($rows[v_pic]);$v_id = trim($rows[v_id]);
				$str_css.="#imgVideo-$k { background-image: url($sub_multidata/$v_pic);}";
				if($k%8==1)$str_image.=" <div id='listVideo'>";
				$str_image.="<li class='oneVideo' id='video-$v_id'><h1 id='imgVideo-$k'></h1><h2>$v_name</h2><p>$v_short</p></li>";
				if(($k%8==0)||($k==$sopt))$str_image.="</div>";
			}
			?>
			<style type="text/css">
       <?=$str_css?>
        </style>
        <div id="videoSlide_cont">
            <div id="videoSlide">
                <?=$str_image?>
            </div><!--end videoSlide-->
            <div class="clr"></div>
        </div><!--end videoSlide_cont-->
        <div class="clr"></div>
		<? if($sopt>8){ ?>
        <div id="nums">
	    	<a href="#" class="pn prev"><span>&laquo;</span> <?=$lb_truoc?></a>
	    	<div class="pagiGroup"></div><!--end pagiCus-->
	    	<a href="#" class="pn next"><?=$lb_tiep?> <span>&raquo;</span></a>
	        <div class="clr"></div>
	    </div><!--end nums-->
        <script type="text/javascript">
            jQuery(document).ready(function(){
                var $album = $('#videoSlide #listVideo');
                    $album.imagesLoaded(function(){
                    $album.masonry({
                        itemSelector: '.oneVideo',
                        columnWidth: 0,
                    });
                    $("#videoSlide").carouFredSel({
                        circular: false,
                        infinite: false,
						responsive: true,
                        auto 	: false,
                        pagination: ".pagiGroup",
                        scroll	: {
                            items	: 'page',
                            fx		: 'fade',
                            duration: 500,
                        },
                        prev	: ".pn.prev",
                        next	: ".pn.next",
                        items : {
                            height: "variable"
                        }
                    });
                });
            });
        </script>
		<? }?>
        <div class="clr"></div>
    </div><!--end video-->
	<div class="clr"></div>
</div><!--end colRight-->