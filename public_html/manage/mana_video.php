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

		if($id) $sql_del = mysql_query("delete from tbl_video where  (v_id ='$id')");

	}

}

if($com=="sort"){

	for($i=1;$i<=$socheck;$i++){

		$b="sort".$i;

		$v_id1=$$b;

		$v_id2="sx".$v_id1;

		$sort_v=$$v_id2;

		if($sort_v){

		  $sql_qr = mysql_query("update tbl_video set v_sort='$sort_v' where (v_id ='$v_id1')");

		}

	}

}

if ($del){

	$sql_del = mysql_query("delete from tbl_video where (v_id ='$del')");

}

if ($ina){

	$sql_qr = mysql_query("update tbl_video set v_of=0 where v_id ='$ina'");

}

if ($a){

	$sql_qr = mysql_query("update tbl_video set v_of=1 where v_id ='$a'");

}

echo "<h1>Video</h1>";

echo "<form action='mana_video.php' method='post' name='mainform' id='mainform'><input name='com' type='hidden' value=''>";
$numview = 10;
	if($pz=="") $pzz = 0;else $pzz = $pz * $numview;
	$qr="select  * from tbl_video order by v_sort,v_id ";
	$sql_list = mysql_query("$qr limit $pzz,$numview");
	$sql_num = mysql_query("$qr");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = (int)$numlist/$numview;
	$startpage=$pz*$numview+1;
	$finishpage=$pz*$numview + $numview;
	if($finishpage >$numlist) $finishpage=$numlist;
	if(!$numlist) $startpage=0;

$stt=0;

while($rows = mysql_fetch_array($sql_list)){

	$stt++;

	$v_id  = $rows[v_id];

	$v_name = outputdata($rows[v_name])." (".outputdata($rows[v_name_en]).")";
	$v_lienket = outputdata($rows[v_lienket]);
	$v_short = outputdata($rows[v_short]);
	$v_of = $rows[v_of];
		$a_pic = $rows[v_pic];
			$str_pic="";
			if($a_pic){
				$str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../multidata/$a_pic' width='150' border='0'></a>";
				$str_pic="<li>Hình<right>$str_pic</right></li>";
			}	
			
	$v_sort = $rows[v_sort];
	if ($v_of==1){ 
		$ac="<a href='mana_video.php?ina=$v_id' class='green'>Hiển thị >>> Ẩn</a>";
		}else{ 
			$ac="<a href='mana_video.php?a=$v_id' class='gray'>Ẩn >>> Hiển thị</a>";
		}
		echo "<table>
<tr>
<th width='2%'>Check</th>
<th width='7%'>Sort</th>
<th><h2>$v_name<h2></th>
</tr>
<tr>
<td><input name='check$stt' type='checkbox' value='$v_id' $tcheck></td>
<td><input name='sort$stt' type='hidden' value='$v_id'><input name='sx$v_id' type='text' value='$v_sort' size='1'></td>
<td><ul>
	<li>Nội dung<right>$v_lienket</right></li>
	$str_pic
	<li>Giới thiệu<right>$v_short</right></li>
	<li>Chức năng<right><a href='edit_video.php?edit=$v_id&pz=$pz' class='orange'>Sửa</a><a href='mana_video.php?del=$v_id&pz=$pz' class='orange'  onclick=\"return confirm('Are you sure you want to Delete ?')\">Xóa</a>$ac</right></li>
</ul></td>
</tr>
</table><br>";
			}

		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Check All\" name=\"checkall\" class=\"submit\">&nbsp;";

		echo "<input onclick=\"UnCheckAll()\" type=\"button\" value=\"UnCheck All\" name=\"uncheck\" class=\"submit\" >&nbsp;";

		echo "<input onclick=\"DelCheck()\" type=\"button\" value=\"Xóa\" name=\"delete\" class=\"submit\">&nbsp;";

		echo "<input onclick=\"Sort()\" type=\"button\" value=\"Sắp xếp\" name=\"sort\" class=\"submit\">";

		echo "<input name='socheck' type='hidden' value='$stt'>";

		echo"</form>";
if($finishpage){?>
<br />
<ul>
<li>Hiển thị từ <?=$startpage?> đến <?=$finishpage?> (của <?=$numlist?> video)
<right><?=$str_pagelist?>
<? }?>
	<? 
$str_pagelist="";
if($numshow > 1){
	$gioihancuanum = 10;
	if($pz) $cs=floor($pz/$gioihancuanum); else $cs=0;
	$batdau=$cs*$gioihancuanum;
	$ketthuc = $batdau + $gioihancuanum;
	if ($ketthuc>$numshow) $ketthuc = $numshow;
	if($cs>0){
		for($i = 1; $i <= $cs; $i++){
			$bt=($i-1)*$gioihancuanum+1;
			$kt=$i*$gioihancuanum;
			$tam=$bt-1; $str_pagelist.="<a href='mana_news.php?bs=$bs&pz=$tam' class='blue'>[$bt-$kt]</a> ";
		}
	}
	if($pz){$tam=$pz-1; $str_pagelist.="<a href='mana_news.php?bs=$bs&pz=$tam' class='gray'>« trước</a>";}
	if ($batdau <= $ketthuc){
		for($i = $batdau; $i < $ketthuc; $i++){
			$k = $i+1;
			if($i==$pz) $str_pagelist.="<a class='green'>$k</a>";
			else{$tam=$i; $str_pagelist.="<a href='mana_news.php?bs=$bs&pz=$tam' class='blue'>$k</a>";}
		}
	}
	if(!($pz>=$numshow-1)) { $tam=$pz+1;$str_pagelist.="<a href='mana_news.php?bs=$bs&pz=$tam' class='gray'>tiếp »</a>";}
	$tam=$numshow/$gioihancuanum;
	$numshow1=floor($tam);
	if($numshow1!=$tam) $numshow1++;
	if($cs+1<=$numshow1){
		for($i = $cs+1; $i <= $numshow1; $i++){
			$bt=$i*$gioihancuanum+1;
			$kt=$bt+$gioihancuanum-1;
			if ($kt>=$numshow+1) $kt = round($numshow)+1;
			if($bt!=$kt) $strbtkt="$bt-$kt"; else $strbtkt=$bt;
			$tam=$bt-1;
			if($bt<=$kt) $str_pagelist.="<a href='mana_news.php?bs=$bs&pz=$tam' class='blue'>[$strbtkt]</a> ";
		}
	}
}
if($str_pagelist) $str_pagelist="$str_pagelist";
if($str_pagelist){?>
<?=$str_pagelist?>
<? }?>
</right></li>
</ul>
</body>
</html>