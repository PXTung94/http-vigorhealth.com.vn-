<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
if ($timkiem_trang){ $_SESSION['ses_nhom_id_dv_search']=$nhom_id_search; }
$nhom_id_search=$_SESSION['ses_nhom_id_dv_search'];$okind=$nhom_id_search;
?>
<form name="searchproduct" method="post" action="add_pageotherstatics_dichvu.php?timkiem_trang=1">
<h1>Nhập Nội dung Dịch vụ</h1>
<ul>
	<li>Chọn Danh mục >>><right><select name="nhom_id_search"><option value='0'>Chọn Danh mục</option>
   	<?
    $sql_level_cata = mysql_query("select  * from tbl_pagename_dichvu where page_parent=0 order by page_sort,page_id");
    while($rowscata = mysql_fetch_array($sql_level_cata)){
        $pageid  = $rowscata[page_id];
        $page_name = trim($rowscata[page_name]);
        $sql_level_cata_1 = mysql_query("select  * from tbl_pagename_dichvu where page_parent='$pageid' order by page_sort,page_id");
        if(@mysql_num_rows($sql_level_cata_1)){
            while($rowscata1 = mysql_fetch_array($sql_level_cata_1)){
                $pageid1 = $rowscata1[page_id];
                $page_name1 = $page_name." >>> ".trim($rowscata1[page_name]);
                if($pageid1 == $nhom_id_search)	echo "<option value='$pageid1' selected>$page_name1</option>";
                else echo "<option value='$pageid1'>$page_name1</option>";
            }
        }else{if($pageid == $nhom_id_search)	echo "<option value='$pageid' selected>$page_name</option>";else echo "<option value='$pageid'>$page_name</option>";}
    }
    ?></select></right></li>
    <li><right><input type="submit" name="timkiem_trang" value="Chọn >>> Nhập nội dung" class="submit"></right></li>
</ul>
</form>
<?
if(!$okind) exit();
if($updatesubmit){
	$thanhcong=1;
	if ($thanhcong){
		if($_FILES['picfile']['name']){
			$pic_name=upload_file('picfile',0);
			if(@is_numeric($pic_name)){
				$thanhcong=0;
				$error=$array_error_file[$pic_name];
				echo "<script>alert(\"$error\");</script>";
			}
		}
	}
	if ($thanhcong){
		$content=inputdata($content);$content_en=inputdata($content_en);$meta_key=inputdata($meta_key);$title_file=inputdata($title_file);$title_file_en=inputdata($title_file_en);
		if($updatenow){
			$qr="update tbl_otherpage_dichvu set content='$content',content_en='$content_en',meta_key='$meta_key',page_file='$pic_name',title_file='$title_file' 
			,title_file_en='$title_file_en' where id='$id_page'";
			$qr_update=mysql_query($qr);
		}else{
			$qr_insert=mysql_query("insert tbl_otherpage_dichvu(content,content_en,okind,meta_key,page_file,title_file,title_file_en) 
			values ('$content','$content_en','$okind','$meta_key','$pic_name','$title_file','$title_file_en')");
			$qr=mysql_query("select * from tbl_otherpage_dichvu where okind='$okind' order by id desc limit 0,1");
			$id_page=@mysql_result($qr,0,'id');
		}
		for ($i=0;$i<11;$i++){
			$k=$i+1;
			$pic_namex=upload_image('hinhanhxengiua',$i+1,0,0,0);
			if($pic_namex){
				if(!(@is_numeric($pic_namex))){
					$del_pic=mysql_query("delete from tbl_pic_otherpage_dichvu where n_vitri='$k' and n_id='$id_page'");
					$in_pic=mysql_query("insert into tbl_pic_otherpage_dichvu(n_id,n_vitri,p_pic,kind) VALUES('$id_page','$k','$pic_namex','$okind')");
				}
			}
		}	
	}
	echo "<script>
			alert('Đã cập nhật xong !');
			location.href='add_pageotherstatics_dichvu.php';
		</script>";
	exit();
}

if($delit) $dele = mysql_query("delete from  tbl_pic_otherpage_dichvu where kind='$okind' and id='$delit'");

$qr=mysql_query("select * from tbl_otherpage_dichvu where okind='$okind'");
if (@mysql_num_rows($qr)){
	$id_page=@mysql_result($qr,0,'id');
	$content_en=outputdata_input(@mysql_result($qr,0,'content_en'));
	$content=outputdata_input(@mysql_result($qr,0,'content'));
	$meta_key=outputdata_input(@mysql_result($qr,0,'meta_key'));
	$title_file=outputdata_input(@mysql_result($qr,0,'title_file'));$title_file_en=outputdata_input(@mysql_result($qr,0,'title_file_en'));
	$page_file=@mysql_result($qr,0,'page_file');
	if($page_file) $str_file="<a href='../multidata/$page_file' target='_blank'>$page_file</a><br>";else $str_file="";
	$updatenow=1;
}else {$updatenow=0;$id_page=0;}
?>
<br />
<form  action="add_pageotherstatics_dichvu.php?updatenow=<?=$updatenow?>&id_page=<?=$id_page?>&updatesubmit=1" method="post" enctype="multipart/form-data" name="formuploaddata">
<h2><? 
	$sql_qr=mysql_query("select * from tbl_pagename_dichvu where page_id='$okind'");
	$page_parent=@mysql_result($sql_qr,0,'page_parent');
	if($page_parent){
			$sql_qr_1=mysql_query("select * from tbl_pagename_dichvu where page_id='$page_parent'");
			echo @mysql_result($sql_qr_1,0,'page_name')." (".@mysql_result($sql_qr_1,0,'page_name_en').") | "; 
	}
	echo @mysql_result($sql_qr,0,'page_name')." (".@mysql_result($sql_qr,0,'page_name_en').")"; ?></h2>
<br />  
<ul>
    <li>Title File Download VN<right><input name="title_file"  value="<?=$title_file?>"/></right></li>
	<li>Title File Download EN<right><input name="title_file_en"  value="<?=$title_file_en?>"/></right></li>
    <li>File Download<right><?=$str_file?><input name='picfile' type='file' class='box_input' value=''/></right></li>
	<li>Nội dung VN<right><textarea name="content" rows="15"><?=$content?></textarea></right></li>
    <li>Nội dung EN<right><textarea name="content_en" rows="10"><?=$content_en?></textarea></right></li>
	<li>Nội dung thẻ Meta<right ><textarea name="meta_key" rows="5"><?=$meta_key?></textarea></right></li>
    <li><right><input name="updatesubmit" type="submit" value="Cập nhật Nội dung" class="submit"></right></li>
    <li><strong>Hình giữa nội dung</strong><right>width 650px trở xuống</right></li>
    <?
    for ($i=0;$i<10;$i++){
        $k=$i+1;
        $str_xoa="";
        $str_hinh="";
        $sql_picogiua = mysql_query("select * from  tbl_pic_otherpage_dichvu where (n_id=$id_page) and (n_vitri=$k) and (kind='$okind') order by n_vitri");
        if (@mysql_num_rows($sql_picogiua)){
            $id=mysql_result($sql_picogiua,0,'id');
            $p_pic=mysql_result($sql_picogiua,0,'p_pic');
            $str_xoa="<a href='add_pageotherstatics_dichvu.php?delit=$id' class='blue'>Xóa</a>";
            $str_hinh="<a href='../multidata/$p_pic' target='_blank'><img src='../multidata/$p_pic' width='100' border='0'/></a>";
        }
        echo "<li>$str_hinh<right>Nhãn {{image$k}} $str_xoa<br />
            <input name='hinhanhxengiua[]' type='file' value=''></right></li>";
    }
    ?>
    <li><right><input name="updatesubmit" type="submit" value="Cập nhật Nội dung" class="submit"></right></li>
</ul>
</form>
</body>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('content');CKEDITOR.replace('content_en');
</script>