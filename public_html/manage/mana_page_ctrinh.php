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
		if(confirm('Bạn chắc chắn muốn xóa ?'))
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
<?php
if($com=="check"){	$tcheck="checked";}
if($com=="uncheck"){$tcheck="";}
if($com=="delete"){
	for($i=1;$i<=$socheck;$i++){
		$b="check".$i;
		$id=$$b;
		if($id){
			$qr="select okind from tbl_otherpage_ctrinh where (okind in (select page_id from tbl_pagename_ctrinh where page_id ='$id' or page_parent ='$id'))";
			$sql_qr=mysql_query($qr);
			while($rows = mysql_fetch_array($sql_qr)){
				$pageid  = $rows[okind];
				$sql_del = mysql_query("delete from tbl_otherpage_ctrinh where  (okind ='$pageid')");
				$sql_del = mysql_query("delete from tbl_pic_otherpage_ctrinh where  (kind ='$pageid')");
			}
			$sql_del = mysql_query("delete from tbl_pagename_ctrinh where  (page_id ='$id') or (page_parent ='$id')");
		}
	}
}
if($com=="sort"){
	for($i=1;$i<=$socheck;$i++){
		$b="sort".$i;
		$page_id1=$$b;
		$page_id2="sx".$page_id1;
		$sort_v=$$page_id2;
		if($sort_v){
		  $sql_qr = mysql_query("update tbl_pagename_ctrinh set page_sort='$sort_v' where (page_id ='$page_id1') ");
		}
	}
}
if ($del){
	$qr="select okind from tbl_otherpage_ctrinh where (okind in (select page_id from tbl_pagename_ctrinh where page_id ='$del' or page_parent ='$del'))";
	$sql_qr=mysql_query($qr);
	while($rows = mysql_fetch_array($sql_qr)){
		$pageid  = $rows[okind];
		$sql_del = mysql_query("delete from tbl_otherpage_ctrinh where  (okind ='$pageid')");
		$sql_del = mysql_query("delete from tbl_pic_otherpage_ctrinh where  (kind ='$pageid')");
	}
	$sql_del = mysql_query("delete from tbl_pagename_ctrinh where  (page_id ='$del') or (page_parent ='$del')");
}
if ($ina){
	$sql_qr = mysql_query("update tbl_pagename_ctrinh set page_of=0 where page_id ='$ina'");
}
if ($a){
	$sql_qr = mysql_query("update tbl_pagename_ctrinh set page_of=1 where page_id ='$a'");
}
echo "<h1>Quản lý Danh mục Giới thiệu</h1>";
echo "<form action='mana_page_ctrinh.php' method='post' name='mainform' id='mainform'>
<input name='com' type='hidden' value=''>
<table>
<tr>
	<th width='2%'>Chọn</th>
	<th width='7%'>S.Xếp</th>
	<th>Tên VN / Tên EN</th>
	<th width='30%'>Chức năng</th>
</tr>";
$stt=0;
$sql_list = mysql_query("select  * from tbl_pagename_ctrinh where (page_parent='0') order by page_sort,page_id");
while($rows = mysql_fetch_array($sql_list)){
	$stt++;
	$page_id  = $rows[page_id];
	$page_name = trim($rows[page_name]);
	$page_of = $rows[page_of];
	$page_sort = $rows[page_sort];
	$page_name_en = $rows[page_name_en];
	if ($page_of==1){ 
		$ac="<a href='mana_page_ctrinh.php?ina=$page_id&pz=$pz' class='green'>Hiển thị >>> Ẩn Danh mục</a>";
	}else{  
		$ac="<a href='mana_page_ctrinh.php?a=$page_id&pz=$pz' class='gray'>Ẩn >>> Hiển thị Danh mục</a>";
	}
		echo "<tr>
				<td><input name='check$stt' type='checkbox' value='$page_id' $tcheck></td>
				<td><input name='sort$stt' type='hidden' value='$page_id'><input name='sx$page_id' type='text' value='$page_sort'></td>
				<td><strong>$page_name / <em>$page_name_en</em></strong></td>
				<td><a href='edit_page_ctrinh.php?edit=$page_id&pz=$pz' class='orange'>Sửa</a><a href='mana_page_ctrinh.php?del=$page_id&pz=$pz' class='orange' onclick='return confirm('Bạn chắc chắn muốn xóa nó ?')'>Xóa</a>$ac</td>
			</tr>";
 		$sql_list_1 = mysql_query("select  * from tbl_pagename_ctrinh where (page_parent='$page_id') order by page_sort,page_id");
while($rowscon = mysql_fetch_array($sql_list_1)){
	$stt++;
	$page_id  = $rowscon[page_id];
	$page_name = trim($rowscon[page_name]);
	$page_of = $rowscon[page_of];
	$page_sort = $rowscon[page_sort];
	$page_name_en =$rowscon[page_name_en];
	if ($page_of==1){ 
		$ac="<a href='mana_page_ctrinh.php?ina=$page_id&pz=$pz' class='green'>Hiển thị >>> Ẩn</a>";
		}else{ 
			$ac="<a href='mana_page_ctrinh.php?a=$page_id&pz=$pz' class='gray'>Ẩn >>> Hiển thị</a>";
		}
		echo "<tr>
				<td><input name='check$stt' type='checkbox' value='$page_id' $tcheck></td>
				<td><input name='sort$stt' type='hidden' value='$page_id'><input name='sx$page_id' type='text' value='$page_sort'></td>
				<td><blockquote>&nbsp;&nbsp;&nbsp;&nbsp;$page_name / <em>$page_name_en</em></blockquote></td>
				<td><a href='edit_page_ctrinh.php?edit=$page_id&pz=$pz' class='orange'>Sửa</a><a href=mana_page_ctrinh.php?del=$page_id&pz=$pz class='orange' onclick=\"return confirm('Bạn chắc chắn muốn Xóa ?')\">Xóa</a>$ac</td>
			  </tr>";}
			}
		echo "</table><br>";
		
		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Chọn tất cả\" name=\"checkall\" class=\"submit\">
			<input onclick=\"UnCheckAll()\" type=\"button\" value=\"Bỏ chọn tất cả\" name=\"uncheck\" class=\"submit\">
			<input onclick=\"DelCheck()\" type=\"button\" value=\"Xoá Chọn\" name=\"delete\" class=\"submit\">
			<input onclick=\"Sort()\" type=\"button\" value=\"Sắp xếp\" name=\"sort\" class=\"submit\">
			<input name='pz' type='hidden' value='$pz'></form>";
?>
</body>
</html>