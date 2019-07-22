<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div class="pagewrap">
    <h1 id="logo"><a href="<?=$sub_root?>"><img src="<?=$sub_image?>/logo.png" width="190" height="100" alt=""></a></h1>
    <div id="top">
        <ul id="hotline">
            <? $kind=24;$qr=mysql_query("select * from tbl_page where kind='$kind'");if (@mysql_num_rows($qr)){
				if ($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en'));else echo outputdata(@mysql_result($qr,0,'content'));
			}?>
        </ul><!--end hotline-->
        <ul id="topLink">
            <li class="row1">
				
				
                <!-- <a href="/english" class="lang en">EN</a><a href="/tieng-viet" class="lang vn">VN</a> -->
				<!-- $sub_root -->
                <!--<span>MUSIC: ON | OFF</span>-->
            </li>
            <div class="clr"></div>
            <li class="row2">    
            	<a href="<?=$sub_root?>/tuyendung" style="text-transform:uppercase">Tuyển dụng</a>  
				<a href="<?=$sub_root?>/video" style="text-transform:uppercase"><?=$lb_video?></a>  
                <a href="<?=$sub_root?>/thu-vien-anh" style="text-transform:uppercase"><?=$lb_thuvienanh?></a>
                <a href="<?=$sub_root?>/site-map" style="text-transform:uppercase"><?=$lb_sitemap?></a>
                <a href="<?=$sub_root?>/lien-he" style="text-transform:uppercase"><?=$lb_lienhe?></a>
            </li>	
			<style>
			.ggtrans{
				position: absolute;
				right: 0rem;
    			top: 7rem;
				z-index: 9999999999999;
			}
			</style>		
			<div class="ggtrans">
			<div id="google_translate_element"></div>
					<script type="text/javascript">
					function googleTranslateElementInit() {
					new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
					}
					</script>

					<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
			</div>
        </ul><!--end topLink-->
		
        <div class="clr"></div>
    </div><!--end top-->
	
</div><!--end pagewrap-->
<div id="menuMain">
    <div class="pagewrap">
        <ul id="menu">
        	<a href="<?=$sub_root?>" class="butHome"><?=$lb_trangchu?></a>
            <li class="haveSub"><a href="#"><?=$lb_gioithieu?></a>
			 <ul>
			<?
			$sql_listcata = mysql_query("select  * from tbl_pagename_ctrinh where page_parent=0 and (page_of=1) order by page_sort,page_id");
			while($rowscata = mysql_fetch_array($sql_listcata)){
				$pageid  = $rowscata[page_id];$page_name_no = $rowscata[page_name_no];
				if($se_lang=="eng") {$page_name = $rowscata[page_name_en];}else{$page_name = trim($rowscata[page_name]);}
				$sql_sublistcata = mysql_query("select  * from tbl_pagename_ctrinh where page_parent='$pageid' and (page_of=1) order by page_sort,page_id");
				if(!@mysql_num_rows($sql_sublistcata)){
					 echo "<li><a href='$sub_root/gioi-thieu/$page_name_no'>$page_name</a></li>";
				}else{
					 echo "<li class='subChild'><a href='#'>$page_name</a> <ul>";
					while($rowssubcata = mysql_fetch_array($sql_sublistcata)){
						$page_name_no_sub = $rowssubcata[page_name_no];
						if($se_lang=="eng") {$page_name_sub = $rowssubcata[page_name_en];}else{$page_name_sub = trim($rowssubcata[page_name]);}
						 echo "<li><a href='$sub_root/gioi-thieu/$page_name_no/$page_name_no_sub'>$page_name_sub</a></li>";
					}
					echo " </ul></li>";
				}
			}
			?>
                </ul>
            </li>
            <li class="haveSub"><a href="#"><?=$lb_dichvu?></a>
                <ul>
				<?
			$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where page_parent=0 and (page_of=1) order by page_sort,page_id");
			while($rowscata = mysql_fetch_array($sql_listcata)){
				$pageid  = $rowscata[page_id];$page_name_no = $rowscata[page_name_no];
				if($se_lang=="eng") {$page_name = $rowscata[page_name_en];}else{$page_name = trim($rowscata[page_name]);}
				$sql_sublistcata = mysql_query("select  * from tbl_pagename_dichvu where page_parent='$pageid' and (page_of=1) order by page_sort,page_id");
				if(!@mysql_num_rows($sql_sublistcata)){
					 echo "<li><a href='$sub_root/dich-vu/$page_name_no'>$page_name</a></li>";
				}else{
					 echo "<li class='subChild'><a href='#'>$page_name</a> <ul>";
					while($rowssubcata = mysql_fetch_array($sql_sublistcata)){
						$page_name_no_sub = $rowssubcata[page_name_no];
						if($se_lang=="eng") {$page_name_sub = $rowssubcata[page_name_en];}else{$page_name_sub = trim($rowssubcata[page_name]);}
						 echo "<li><a href='$sub_root/dich-vu/$page_name_no/$page_name_no_sub'>$page_name_sub</a></li>";
					}
					echo " </ul></li>";
				}
			}
			?>
                </ul>
            </li>
            <li><a href="<?=$sub_root?>/nhan-su-chu-luc-vigor"><?=$lb_nhanluc_chuluc?></a></li>
            <li class="haveSub space"><a href="<?=$sub_root?>/tin-tuc"><?=$lb_tintuc?></a>
                <ul>
				<?
				$sql_cata_top = mysql_query("select  * from tbl_cata  where c_kind='1' and c_of=1 order by c_sort,c_id");
				while($rowstop = mysql_fetch_array($sql_cata_top)){
					$c_name_t = trim($rowstop[c_name]);$c_name_no_t = $rowstop[c_name_no];
					echo "<li><a href='$sub_root/tin-tuc/$c_name_no_t' title='$c_name_t'>$c_name_t</a></li>";
				}
				?>
                </ul>
            </li>
            <li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
            <!--<li><a href="<?=$sub_root?>/xem-ho-so" target="_blank"><?=$lb_xem_hoso?></a></li>-->
            <li><a href="http://www.healthcare.com.vn/report" target="_blank"><?=$lb_xem_hoso?></a></li>
            <li class="haveSub"><a href="<?=$sub_root?>/khach-hang-vigor"><?=$lb_khachhang?></a>
                <ul>
                    <li><a href="<?=$sub_root?>/khach-hang-vigor"><?=$lb_danhsachkhachhang?></a>
                    <li><a href="<?=$sub_root?>/cam-nghi-khach-hang"><?=$lb_camnghi_khachhang?></a></li>
                     <li><a href="http://survey.healthcare.com.vn" target="_blank">Đóng góp ý kiến</a></li>
                </ul>
            </li>
           <!-- <li><a href="http://healthcare.com.vn/" target="_blank">Đặt lịch khám</a> </li>-->
            
        </ul>
        <div id="menuHide">
            <a href="<?=$sub_root?>" class="butHome"><?=$lb_trangchu?></a>
            <div id="menuMobile">
                <h1>MENU</h1>
                <ul>
                    <h2><?=$lb_gioithieu?></h2>
                    <ul>
					<?
			$sql_listcata = mysql_query("select  * from tbl_pagename_ctrinh where page_parent=0 and (page_of=1) order by page_sort,page_id");
			while($rowscata = mysql_fetch_array($sql_listcata)){
				$pageid  = $rowscata[page_id];$page_name_no = $rowscata[page_name_no];
				if($se_lang=="eng") {$page_name = $rowscata[page_name_en];}else{$page_name = trim($rowscata[page_name]);}
				$sql_sublistcata = mysql_query("select  * from tbl_pagename_ctrinh where page_parent='$pageid' and (page_of=1) order by page_sort,page_id");
				if(!@mysql_num_rows($sql_sublistcata)){
					 echo "<li><a href='$sub_root/gioi-thieu/$page_name_no'>$page_name</a></li>";
				}else{
					 echo "<h2>$page_name</h2> <ul>";
					while($rowssubcata = mysql_fetch_array($sql_sublistcata)){
						$page_name_no_sub = $rowssubcata[page_name_no];
						if($se_lang=="eng") {$page_name_sub = $rowssubcata[page_name_en];}else{$page_name_sub = trim($rowssubcata[page_name]);}
						 echo "<li><a href='$sub_root/gioi-thieu/$page_name_no/$page_name_no_sub'>$page_name_sub</a></li>";
					}
					echo " </ul>";
				}
			}
			?>
                    </ul>
                    
                    <h2><?=$lb_dichvu?></h2>
                    <ul>
                    	<?
			$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where page_parent=0 and (page_of=1) order by page_sort,page_id");
			while($rowscata = mysql_fetch_array($sql_listcata)){
				$pageid  = $rowscata[page_id];$page_name_no = $rowscata[page_name_no];
				if($se_lang=="eng") {$page_name = $rowscata[page_name_en];}else{$page_name = trim($rowscata[page_name]);}
				$sql_sublistcata = mysql_query("select  * from tbl_pagename_dichvu where page_parent='$pageid' and (page_of=1) order by page_sort,page_id");
				if(!@mysql_num_rows($sql_sublistcata)){
					 echo "<li><a href='$sub_root/dich-vu/$page_name_no'>$page_name</a></li>";
				}else{
					 echo "<h2>$page_name</h2> <ul>";
					while($rowssubcata = mysql_fetch_array($sql_sublistcata)){
						$page_name_no_sub = $rowssubcata[page_name_no];
						if($se_lang=="eng") {$page_name_sub = $rowssubcata[page_name_en];}else{$page_name_sub = trim($rowssubcata[page_name]);}
						 echo "<li><a href='$sub_root/dich-vu/$page_name_no/$page_name_no_sub'>$page_name_sub</a></li>";
					}
					echo " </ul>";
				}
			}
			?>
                    </ul>
                    
                    <li><a href="index.php?page=page-team"><?=$lb_nhanluc_chuluc?></a></li>
                    
                    <h2><?=$lb_tintuc?></h2>
                    <ul>
                        <?
				$sql_cata_top = mysql_query("select  * from tbl_cata  where c_kind='1' and c_of=1 order by c_sort,c_id");
				while($rowstop = mysql_fetch_array($sql_cata_top)){
					$c_name_t = trim($rowstop[c_name]);$c_name_no_t = $rowstop[c_name_no];
					echo "<li><a href='$sub_root/tin-tuc/$c_name_no_t' title='$c_name_t'>$c_name_t</a></li>";
				}
				?>
                    </ul>
					 <li><a href="<?=$sub_root?>/video"><?=$lb_video?></a> </li> 
                    <li><a href="<?=$sub_root?>/thu-vien-anh"><?=$lb_thuvienanh?></a></li>
                    <li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
		            <!--<li><a href="<?=$sub_root?>/xem-ho-so" target="_blank"><?=$lb_xem_hoso?></a></li>-->
					<li><a href="http://www.healthcare.com.vn/report" target="_blank"><?=$lb_xem_hoso?></a></li>
                    <li><a href="<?=$sub_root?>/khach-hang-vigor"><?=$lb_danhsachkhachhang?></a>
                    <li><a href="<?=$sub_root?>/cam-nghi-khach-hang"><?=$lb_camnghi_khachhang?></a></li>
	                <li><a href="<?=$sub_root?>/site-map"><?=$lb_sitemap?></a></li>
	                <li><a href="<?=$sub_root?>/lien-he"><?=$lb_lienhe?></a></li>
	                <li><a href="http://booking.healthcare.com.vn/" target="_blank"> Đặt lịch khám </li>
            	</ul>
		    </div><!--menu menuMobile-->
            <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="butHome back"><?=$lb_trove?></a>
		</div><!--menu menuHide-->
    </div><!--end pagewrap-->
    <div class="clr"></div>
</div><!--end menuMain-->
<div id="bannerMain">
    <div id="banner">
	<?
	$c_id_banner=1;
	if($page=="page-about")$c_id_banner=2;
	if($page=="page-service")$c_id_banner=3;
	if(($page=="page-testimonials")||($page=="page-testimonials-view"))$c_id_banner=4;
	if(($page=="page-team")||($page=="page-team-view"))$c_id_banner=5;
	if(($page=="page-news")||($page=="page-news-view"))$c_id_banner=6;
	if(($page=="page-faq")||($page=="page-faq-ask")||($page=="page-faq-reply"))$c_id_banner=7;
	if($page=="page-customers")$c_id_banner=8;
	if(($page=="page-gallery")||($page=="page-gallery-view"))$c_id_banner=9;
	$k=0;
	$sql_banner = mysql_query("select * from  tbl_bannerhome where a_of=1 and c_id='$c_id_banner' order by a_sort asc,a_id  desc");
	while($rowsbn = mysql_fetch_array($sql_banner)){
		$k++;
		if($se_lang=="eng") {$a_name_bn = outputdata($rowsbn[a_name_en]);$a_gioithieu_bn = outputdata($rowsbn[a_gioithieu_en]);}
		else{$a_name_bn = outputdata($rowsbn[a_name]);$a_gioithieu_bn = outputdata($rowsbn[a_gioithieu]);}
		$a_pic_bn = $rowsbn[a_pic];
		echo "<div class='oneByOne_item'>
            <h1 data-animate='fadeInUp'><!$a_name_bn></h1>
            <p data-animate='fadeInUp'>$a_gioithieu_bn</p>
            <img src='$sub_multidata/$a_pic_bn' class='img$k' data-animate='fadeInUp'/>
        </div>";
	}
	?>
    </div><!--end banner-->
</div><!--end bannerMain-->