<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/site-map"><?=$lb_sitemap?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_sitemap?></h1></div>
    </div>
    <div class="sitemap">
    	<ul id="sitemap">
            <li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li><a href="#"><?=$lb_gioithieu?></a>
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
			?> <li><a href="<?=$sub_root?>/cam-nghi-khach-hang"><?=$lb_camnghi_khachhang?></a></li>
                </ul>
            </li>
            <li><a href="#"><?=$lb_dichvu?></a>
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
             <li><a href="<?=$sub_root?>/nhan-su-chu-luc"><?=$lb_nhanluc_chuluc?></a></li>
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
			 <li><a href="<?=$sub_root?>/video"><?=$lb_video?></a> </li> 
			  <li><a href="<?=$sub_root?>/thu-vien-anh"><?=$lb_thuvienanh?></a></li>
                    <li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
		            <li><a href="<?=$sub_root?>/xem-ho-so" target="_blank"><?=$lb_xem_hoso?></a></li>
		            <li><a href="<?=$sub_root?>/khach-hang"><?=$lb_khachhang?></a></li>
	                <li><a href="<?=$sub_root?>/site-map"><?=$lb_sitemap?></a></li>
	                <li><a href="<?=$sub_root?>/lien-he"><?=$lb_lienhe?></a></li>
        </ul>
        <div class="clr"></div>
    </div><!--end showText-->
	<div class="clr"></div>
</div><!--end colRight-->