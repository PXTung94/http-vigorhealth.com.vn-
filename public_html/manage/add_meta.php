<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="meta_key-Type" meta_key="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<h1>Cập nhật nội dung thẻ Meta</h1>
</head>
<body>
<?
if($updatesubmitform){
	foreach ($array_meta as $kind => $valuekind){
		$a="meta_key_".$kind;$meta_key=inputdata($$a);
		$b="meta_key_en_".$kind;$meta_key_en=inputdata($$b);
		$qrupkt=mysql_query("select * from tbl_meta where kind='$kind'");
		if (@mysql_num_rows($qrupkt)){
			$id=@mysql_result($qr,0,'id');
			$qr_update=mysql_query("update tbl_meta set meta_key='$meta_key',meta_key_en='$meta_key_en' where id='$id'");
		}else{
			$qr_insert=mysql_query("insert tbl_meta(meta_key,meta_key_en,kind) values ('$meta_key','$meta_key_en','$kind')");
		}
	}
	echo "<script>alert('Đã cập nhật thành công !');location.href='add_meta.php';</script>";exit();
}
$qr=mysql_query("select * from tbl_meta where kind='$kind'");
if (@mysql_num_rows($qr)){
	$id_page=@mysql_result($qr,0,'id');
	$meta_key=outputdata_input(@mysql_result($qr,0,'meta_key'));
	$meta_key_en=outputdata_input(@mysql_result($qr,0,'meta_key_en'));
	$updatenow=1;
}else {$updatenow=0;$id_page=0;}
?>

<form  action="add_meta.php?updatesubmitform=1" method="post"  name="formuploaddata">
<?
foreach ($array_meta as $kind => $valuekind){
	$qrsql=mysql_query("select * from tbl_meta where kind='$kind'");
	$metakey=outputdata_input(@mysql_result($qrsql,0,'meta_key'));
	$metakey_en=outputdata_input(@mysql_result($qrsql,0,'meta_key_en'));
?>
<ul>
<li><?=$valuekind?> VN<right ><textarea name="meta_key_<?=$kind?>" rows="3" col='40'><?=$metakey?></textarea></right></li>
<li><?=$valuekind?> EN<right ><textarea name="meta_key_en_<?=$kind?>" rows="3" col='40'><?=$metakey_en?></textarea></right></li>
<li><right><input name="updatesubmit" type="submit" class="submit" value="Cập nhật"></right></li>
</ul>
<? }?>
</form>
</body>
</html>