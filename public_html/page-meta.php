<? include("common.php");
if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}

	$str_title_meta="";
	$str_content_meta="";
	if($page=="page-about"){
		if($spageidsub){
			$sql_listcata = mysql_query("select  * from tbl_pagename_ctrinh where (page_of=1) and (page_name_no='$spageidsub')");
		}else{
			$sql_listcata = mysql_query("select  * from tbl_pagename_ctrinh where (page_of=1) and (page_name_no='$spageid')");
		}
		$page_id_meta = trim(@mysql_result($sql_listcata,0,'page_id')); 
		$sql_listcata_detail=mysql_query("select * from tbl_otherpage_ctrinh where okind='$page_id_meta'");
		$str_content_meta=outputdata(@mysql_result($sql_listcata_detail,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_listcata,0,'page_name_en')); else  $str_content_meta = trim(@mysql_result($sql_listcata,0,'page_name'));
		}
	}
	if($page=="page-service"){
		if($spageidsub){
			$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where (page_of=1) and (page_name_no='$spageidsub')");
		}else{
			$sql_listcata = mysql_query("select  * from tbl_pagename_dichvu where (page_of=1) and (page_name_no='$spageid')");
		}
		$page_id_meta = trim(@mysql_result($sql_listcata,0,'page_id')); 
		$sql_listcata_detail=mysql_query("select * from tbl_otherpage_dichvu where okind='$page_id_meta'");
		$str_content_meta=outputdata(@mysql_result($sql_listcata_detail,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_listcata,0,'page_name_en')); else  $str_content_meta = trim(@mysql_result($sql_listcata,0,'page_name'));
		}
	}
	if($page=="page-testimonials"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='1'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
		if(!$str_content_meta) {$str_title_meta=$lb_camnghi_khachhang;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-testimonials-view"){
		$sql_parent_meta=mysql_query("select a_name,meta_key from tbl_news where (a_of=1) and (a_name_no='$snewsid')");
		$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name_en')); else  $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name'));
			$str_content_meta=$str_title_meta;
		}
	}
	if($page=="page-team"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='2'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
		if(!$str_content_meta) {$str_title_meta=$lb_nhanluc_chuluc;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-team-view"){
		$sql_parent_meta=mysql_query("select a_name,meta_key from tbl_news where (a_of=1) and (a_name_no='$snewsid')");
		$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name_en')); else  $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name'));
			$str_content_meta=$str_title_meta;
		}
	}
	if($page=="page-news"){
		if($scnewsid){
			$sql_parent_meta = mysql_query("select  * from tbl_cata where c_of=1 and (c_name_no='$scnewsid')");
			$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
			if(!$str_content_meta) {
				if($se_lang=="vn") $str_title_meta=outputdata(@mysql_result($sql_parent_meta,0,'c_name'));
				 else $str_title_meta=outputdata(@mysql_result($sql_parent_meta,0,'c_name_en'));
				$str_content_meta=$str_title_meta;
			} 
		}else{
			$qrmeta=mysql_query("select * from tbl_meta where kind='3'");
			if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else  $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
			if(!$str_content_meta) {$str_title_meta=$lb_tintuc;$str_content_meta=$str_title_meta;}
		}
	}
	if($page=="page-news-view"){
		$sql_parent_meta=mysql_query("select a_name,meta_key from tbl_news where (a_of=1) and (a_name_no='$snewsid')");
		$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name_en')); else  $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name'));
			$str_content_meta=$str_title_meta;
		}
	}
	if($page=="page-faq"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='4'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
		if(!$str_content_meta) {$str_title_meta=$lb_diendan;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-faq-ask"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='5'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
		if(!$str_content_meta) {$str_title_meta=$lb_dat_cau_hoi;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-faq-reply"){
		$sql_parent_meta=mysql_query("select a_name,meta_key from tbl_news where (a_of=1) and (a_name_no='$snewsid')");
		$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="eng") $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name_en')); else  $str_content_meta = trim(@mysql_result($sql_parent_meta,0,'a_name'));
			$str_content_meta=$str_title_meta;
		}
	}
	if($page=="page-contact"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='6'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); 
		else if($se_lang=="eng") $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_ch'));
		if(!$str_content_meta) {$str_title_meta=$lb_lienhe;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-customers"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='7'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); 
		else if($se_lang=="eng") $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_ch'));
		if(!$str_content_meta) {$str_title_meta=$lb_khachhang;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-gallery"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='8'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); 
		else if($se_lang=="eng") $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_ch'));
		if(!$str_content_meta) {$str_title_meta=$lb_thuvienanh;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-gallery-view"){
		if($se_lang=="vn") $sql_parent_meta=mysql_query("select name,name_en,meta_key from tbl_subcollection where (name_no='$sid')");
		else $sql_parent_meta=mysql_query("select name,name_en,meta_key from tbl_subcollection where (name_en_no='$sid')");
		$str_content_meta=outputdata(@mysql_result($sql_parent_meta,0,'meta_key'));
		if(!$str_content_meta) {
			if($se_lang=="vn") $str_title_meta=outputdata(@mysql_result($sql_parent_meta,0,'name'));else $str_title_meta=outputdata(@mysql_result($sql_parent_meta,0,'name_en'));
			$str_content_meta=$str_title_meta;
		} 
	}
	if($page=="page-sitemap"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='9'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); 
		else if($se_lang=="eng") $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_ch'));
		if(!$str_content_meta) {$str_title_meta=$lb_sitemap;$str_content_meta=$str_title_meta;}
	}
	if($page=="page-video"){
		$qrmeta=mysql_query("select * from tbl_meta where kind='10'");
		if($se_lang=="vn")$str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key')); else $str_content_meta=outputdata(@mysql_result($qrmeta,0,'meta_key_en'));
		if(!$str_content_meta) {$str_title_meta=$lb_video;$str_content_meta=$str_title_meta;}
	}
	if($se_lang=="vn"){
		if(!$str_title_meta) $str_title_meta="Vigor Health";
		if(!$str_content_meta)
			$str_content_meta="<title>$str_title_meta</title><meta name='keywords' content='$str_title_meta'/>";
		else if(strpos($str_content_meta,"<meta")===false)
		$str_content_meta="<title>$str_content_meta</title><meta name='keywords' content='$str_content_meta'/><meta name='description' content='$str_content_meta'/>";
	}else{
		if(!$str_title_meta) $str_title_meta="Vigor Health";
		if(!$str_content_meta)
			$str_content_meta="<title>$str_title_meta</title><meta name='keywords' content='$str_title_meta'/>";
		else if(strpos($str_content_meta,"<meta")===false)
		$str_content_meta="<title>$str_content_meta</title><meta name='keywords' content='$str_content_meta'/><meta name='description' content='$str_content_meta'/>";
	}
?>
<?=$str_content_meta?>