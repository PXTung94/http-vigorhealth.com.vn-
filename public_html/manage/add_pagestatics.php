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
if ($kind) $_SESSION["session_trangtinh_kind"]=$kind; else $kind=$_SESSION["session_trangtinh_kind"];
if($updatesubmit){
	$content=inputdata($content);$content_en=inputdata($content_en);
	if($updatenow){
		$qr_update=mysql_query("update tbl_page set content='$content',content_en='$content_en' where id='$id_page'");
	}else{
		$qr_insert=mysql_query("insert tbl_page(content,content_en,kind) values ('$content','$content_en','$kind')");
		$qr=mysql_query("select * from tbl_page where kind='$kind' order by id desc limit 0,1");
		$id_page=@mysql_result($qr,0,'id');
	}
	for ($i=0;$i<10;$i++){
		$k=$i+1;
		$pic_namex=upload_image('hinhanhxengiua',$k,0,0,0);
		if(!@is_numeric($pic_namex)){
			$del_pic=mysql_query("delete from tbl_pic_page where n_vitri='$k' and n_id='$id_page'");
			$in_pic=mysql_query("insert into tbl_pic_page(n_id,n_vitri,p_pic,kind) VALUES('$id_page','$k','$pic_namex','$kind')");
		}
	}	
	
	echo "<script>
			alert('Cập nhật thành công!');
			location.href='add_pagestatics.php';
		</script>";
	exit();
}

if($delit) $dele = mysql_query("delete from  tbl_pic_page where kind='$kind' and id='$delit'");

$qr=mysql_query("select * from tbl_page where kind='$kind'");
if (@mysql_num_rows($qr)){
	$id_page=@mysql_result($qr,0,'id');
	$content=outputdata_input(@mysql_result($qr,0,'content'));
	$content_en=outputdata_input(@mysql_result($qr,0,'content_en'));
	$updatenow=1;
}else {$updatenow=0;$id_page=0;}
?>

<form  action="add_pagestatics.php?updatenow=<?=$updatenow?>&id_page=<?=$id_page?>&updatesubmit=1" method="post" enctype="multipart/form-data" name="formuploaddata">
<h1><? echo $array_loaitrangtinh[$kind] ?></h1>
<ul>
<?
if($kind==26){ ?>
	<li>Google Map<right><textarea name="content" rows="5"><?=$content?></textarea></right></li>
	<li><right><input name="updatesubmit" type="submit" class="submit" value="Cập nhật"></right></li>
<? }elseif($kind<=30){?>
<li>Nội dung VN<right><textarea name="content" rows="5"><?=$content?></textarea></right></li>
<li>Nội dung EN<right><textarea name="content_en" rows="5"><?=$content_en?></textarea></right></li>
<li><right><input name="updatesubmit" type="submit" class="submit" value="Cập nhật"></right></li>
<? }?>
<?
$sopt=10;
if(($kind>=21)&&($kind<=30)) $sopt=0;
if($kind>=31) $sopt=1;
for ($i=0;$i<$sopt;$i++){
	$k=$i+1;
	$str_xoa="";
	$str_hinh="";
	$sql_picogiua = mysql_query("select * from  tbl_pic_page where (n_id=$id_page) and (n_vitri=$k) and (kind='$kind') order by n_vitri");
	if (@mysql_num_rows($sql_picogiua)){
		$id=mysql_result($sql_picogiua,0,'id');
		$p_pic=mysql_result($sql_picogiua,0,'p_pic');
		$str_xoa="<a href='add_pagestatics.php?delit=$id' class='blue'>Xóa</a>";
		if($kind==31) $str_hinh="<a href='../multidata/$p_pic' target='_blank'><img src='../multidata/$p_pic'  border='0'/></a>";
		else  $str_hinh="<a href='../multidata/$p_pic' target='_blank'><img src='../multidata/$p_pic' width='100' border='0'/></a>";
	}
	if($sopt==1) $str_ha="Image"; else $str_ha="Nhãn {{image$k}}";
	echo "<li>$str_hinh<right>$str_ha $str_xoa<br />
		<input name='hinhanhxengiua[]' type='file' value=''></right></li>";
}
if($sopt){
?>
<li><right><input name="updatesubmit" type="submit" class="submit" value="Cập nhật"></right></li>
<? }?>
</ul>
</form>
</body>
</html>
<?
	if(($kind>=1)&&($kind<=20)){?>
	<script src="ckeditor/ckeditor.js"></script>
	<script>CKEDITOR.replace('content');CKEDITOR.replace('content_en');
<?	}
?>