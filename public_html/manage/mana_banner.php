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

		if(confirm('Bạn muốn sắp xếp ?'))

		{

			document.mainform.com.value='sort';

			document.mainform.submit();

		}

	}

	function DelCheck()

	{

		if(confirm('Bạn muốn Xóa ?'))

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
		if($id) $sql_del = mysql_query("delete from tbl_linksp where  (lienketid ='$id')");
	}
}
if($com=="sort"){

	for($i=1;$i<=$socheck;$i++){

		$b="sort".$i;

		$lienketid1=$$b;

		$lienketid2="sx".$lienketid1;

		$sort_v=$$lienketid2;

		if($sort_v){

		  $sql_qr = mysql_query("update tbl_linksp set sapxep='$sort_v' where (lienketid ='$lienketid1')");

		}

	}

}

if ($del){

	$sql_del = mysql_query("delete from tbl_linksp where (lienketid ='$del')");

}

if ($ina){

	$sql_qr = mysql_query("update tbl_linksp set hienthi=0 where lienketid ='$ina'");

}

if ($a){

	$sql_qr = mysql_query("update tbl_linksp set hienthi=1 where lienketid ='$a'");

}

echo "<h1>Danh sách Khách hàng</h1>";

echo "<form action='mana_banner.php' method='post' name='mainform' id='mainform'>

          <input name='com' type='hidden' value=''>";

$sql_level_1 = mysql_query("select  * from tbl_linksp order by sapxep,lienketid");

$stt=0;

while($rows = mysql_fetch_array($sql_level_1)){

	$stt++;

	$lienketid  = $rows[lienketid];
	$hienthi = $rows[hienthi];
	$sapxep = $rows[sapxep];$s_pic = $rows[s_pic];
	$s_text =outputdata($rows[s_text]);$s_text_en =outputdata($rows[s_text_en]);$s_link =outputdata($rows[s_link]);
		if ($hienthi==1){ 
		$ac="<a href='mana_banner.php?ina=$lienketid'  class='green'>Hiển thị >>> Ẩn</a>";
		}else{ 
			$ac="<a href='mana_banner.php?a=$lienketid'  class='gray'>Ẩn >>> Hiển thị</a>";
		}
		echo "<table>
<tr>
<th width='2%'>Check</th>
<th width='7%'>Sort</th>
<th>$s_text</th>
</tr>
<tr>
<td><input name='check$stt' type='checkbox' value='$lienketid' $tcheck></td>
<td><input name='sort$stt' type='hidden' value='$lienketid'><input name='sx$lienketid' type='text' value='$sapxep' size='1'></td>
<td><ul>
	<li>Tên khách hàng EN<right>$s_text_en</right></li>
	<li>Hình<right><a href='../multidata/$s_pic' target='_blank'><img src='../multidata/$s_pic' width='150' border='0'></a></right></li>
	<li>Liên kết<right><a href='$s_link' target='_blank'>$s_link</a></right></li>
	
	<li>Chức năng<right><a href='edit_banner.php?edit=$lienketid' class='orange'>Sửa</a><a href='mana_banner.php?del=$lienketid' class='orange' onclick=\"return confirm('Are you sure to del it ?')\">Xóa</a>$ac</right></li>
</ul></td>
</tr>
</table><br>";
			}

		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Check All\" name=\"checkall\"  class=\"submit\">&nbsp;";

		echo "<input onclick=\"UnCheckAll()\" type=\"button\" value=\"UnCheck All\" name=\"uncheck\"  class=\"submit\">&nbsp;";

		echo "<input onclick=\"DelCheck()\" type=\"button\" value=\"Del\" name=\"delete\"  class=\"submit\">&nbsp;";

		echo "<input onclick=\"Sort()\" type=\"button\" value=\"Sort\" name=\"sort\"  class=\"submit\">";

		echo "<input name='socheck' type='hidden' value='$stt'>";

		echo"</form>";

		?>