<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
if($skind) $_SESSION["session_skind_admin"]=$skind; else $skind=$_SESSION["session_skind_admin"]; $lb_tieude =$array_page[$skind];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function Sort()
	{
		if(confirm('Bạn chắc chắn muốn sắp xếp ?'))
		{
			document.mainform.com.value='sort';
			document.mainform.submit();
		}
	}
	function DelCheck()
	{
		if(confirm('Bạn chắc chắn muốn xoá ?'))
		{
			document.mainform.com.value='delete';
			document.mainform.submit();
		}
	}
	function CheckAll()
	{
		document.mainform.com.value='check';
		document.mainform.submit();
	}
	function UnCheckAll()
	{
		document.mainform.com.value='uncheck';
		document.mainform.submit();
	}
</script>
</head>
<body>
<?php
if($com=="check"){	$tcheck="checked";}
if($com=="uncheck"){$tcheck="";}
if($com=="delete"){
	for($i=1;$i<=$socheck;$i++){
		$b="check".$i;
		$id=$$b;
		if($id){
		  $sql_del = mysql_query("delete from tbl_cata where (c_id ='$id')");
		  $sql_del = @mysql_query("delete from tbl_news where (c_id='$id')");
		}
	}
}
if($com=="sort"){
	for($i=1;$i<=$socheck;$i++){
		$b="sort".$i;
		$c_id1=$$b;
		$c_id2="sx".$c_id1;
		$sort_v=$$c_id2;
		if($sort_v){
		  $sql_qr = mysql_query("update tbl_cata set c_sort='$sort_v' where (c_id ='$c_id1')");
		}
	}
}
if ($del){
	$sql_del = mysql_query("delete from tbl_cata where (c_id ='$del')");
	$sql_del = @mysql_query("delete from tbl_news where (c_id='$del')");
}
if ($ina)$sql_qr = mysql_query("update tbl_cata set c_of=0 where c_id ='$ina'");
if ($a)$sql_qr = mysql_query("update tbl_cata set c_of=1 where c_id ='$a'");


echo "<h1>Quản lý Danh mục ($lb_tieude)</h1>";
echo "<form action='mana_cata.php' method='post' name='mainform' id='mainform'>
<input name='com' type='hidden' value=''>
<table>
<tr>
	<th width='3%'>Chọn</th>
	<th width='7%'>S.Xếp</th>
	<th>Tên danh mục VN</th><th width='30%'>Tên danh mục EN</th>
	<th width='30%'>Chức năng</th>
</tr>";
$sql_level_1 = mysql_query("select  * from tbl_cata  where c_kind='$skind' order by c_sort,c_id");
$stt=0;
while($rows = mysql_fetch_array($sql_level_1)){
	$stt++;
	$c_id  = $rows[c_id];$c_name = trim($rows[c_name]);$c_name_en=trim($rows[c_name_en]);$c_sort = $rows[c_sort];
	
	$c_of = $rows[c_of];
	if ($c_of==1){ 
		$ac="<a href='mana_cata.php?ina=$c_id' class='green'>Hiển thị >>> Ẩn Danh mục</a>";
	}else{ 
		$ac="<a href='mana_cata.php?a=$c_id' class='gray'>Ẩn >>> Hiển thị Danh mục</a>";
	}
	
	echo "<tr>
				<td><input name='check$stt' type='checkbox' value='$c_id' $tcheck></td>
				<td><input name='sort$stt' type='hidden' value='$c_id'><input name='sx$c_id' type='text' value='$c_sort'></td>
				<td>$c_name</td><td>$c_name_en</td>
				<td><a href='edit_cata.php?edit=$c_id' class='orange'>Sửa</a><a href='mana_cata.php?del=$c_id' class='orange' onclick=\"return confirm('Bạn chắc chắn muốn Xoá ?')\">Xoá</a>&nbsp;
				$ac</td>
			</tr>";
		}
		echo "</table><br>";
		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Chọn tất cả\" name=\"checkall\" class=\"submit\">
			<input onclick=\"UnCheckAll()\" type=\"button\" value=\"Bỏ chọn tất cả\" name=\"uncheck\" class=\"submit\">
			<input onclick=\"DelCheck()\" type=\"button\" value=\"Xoá Chọn\" name=\"delete\" class=\"submit\">
			<input onclick=\"Sort()\" type=\"button\" value=\"Sắp xếp\" name=\"sort\" class=\"submit\">
			<input name='socheck' type='hidden' value='$stt'></form>";
		?>
</body>
</html>		