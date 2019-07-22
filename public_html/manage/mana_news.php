<? include("check.php"); 
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
		if(confirm('Bạn muốn sắp xếp nó ?'))
		{
			document.mainform.com.value='sort';
			document.mainform.submit();
		}
	}
	function DelCheck()
	{
		if(confirm('Bạn muốn xóa nó ?'))
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
	if ($timkiem_news){
		$bs=1;
		$_SESSION['ses_value_search']=$value_search;
		$_SESSION['ses_kind_search']=$kind_search;
		$_SESSION['ses_order_by']=$order_by;
		$_SESSION['ses_search_tag']=$search_tag;
		$_SESSION['ses_catalogid_search']=$catalogid_search;
	}
	$str_action="";
	if ($bs){	
		$value_search=trim($_SESSION['ses_value_search']);
		$kind_search=$_SESSION['ses_kind_search'];
		$order_by=$_SESSION['ses_order_by'];
		$search_tag=$_SESSION['ses_search_tag'];
		$catalogid_search=$_SESSION['ses_catalogid_search'];
		if (!($order_by)) $order_by=" a_id desc";
		$str_action="";
		if($value_search){
			$value_search_no=RemoveSign($value_search);	
			$str_action.=" and ((a_name_no like '%$value_search_no%')  or (a_name_en_no like '%$value_search_no%')) ";

		}
		if ($kind_search){
			 $str_action.= " and ($kind_search) ";

		}
		if($search_tag){ 
			$str_action.=" and (a_tag_no like '%|$search_tag|%') "; 
		}
		if ($catalogid_search){
			$str_action.=" and (c_id ='$catalogid_search')";
		}
		$str_order_by= " order by $order_by";

	}
?>

<h1><?=$lb_tieude?></h1>
<?php
	if($com=="check"){	$tcheck="checked";
	}elseif($com=="uncheck"){$tcheck="";
	}elseif($com=="delete"){
		for($i=1;$i<=$socheck;$i++){
			$b="check".$i;
			$id=$$b;
			if($id)	{
				$sql_del = mysql_query("delete from tbl_news  where a_id ='$id'");
				$sql_del = mysql_query("delete from tb_hinhgiuatin  where a_id ='$id'");
			}
		}
	}
	if($com=="sort"){
	for($i=1;$i<=$socheck;$i++){
		$b="sort".$i;
		$a_id1=$$b;
		$a_id2="sx".$a_id1;
		$sort_v=$$a_id2;
		if($sort_v){
		  $sql_qr = mysql_query("update tbl_news set a_sort='$sort_v' where (a_id ='$a_id1')");
		}
	}
}
	if ($del){
		$sql_del = mysql_query("delete from tbl_news  where a_id ='$del'");
		$sql_del = mysql_query("delete from tb_hinhgiuatin  where a_id ='$del'");		
	}
	if ($ina) $sql_del = mysql_query("update tbl_news set a_of=0 where a_id ='$ina'");
	if ($a) $sql_del = mysql_query("update tbl_news set a_of=1 where a_id ='$a'");
	
	
	$numview = 10;
	if($pz=="") $pzz = 0;
	else $pzz = $pz * $numview;
	if (!($str_order_by)) $str_order_by=" order by a_sort asc,a_id  desc";
	$qr="select * from  tbl_news where c_kind='$skind' $str_action $str_order_by ";
	$sql_list = mysql_query("$qr limit $pzz,$numview");
	$sql_num = mysql_query("$qr");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = (int)$numlist/$numview;
	$startpage=$pz*$numview+1;
	$finishpage=$pz*$numview + $numview;
	if($finishpage >$numlist) $finishpage=$numlist;
	if(!$numlist) $startpage=0;

echo "<form action='mana_news.php' method='post' name='mainform' id='mainform'>
	  <input name='com' type='hidden' value=''>";
	  $stt=0;
		while($rows = mysql_fetch_array($sql_list)){
			$stt++;
			$a_id = $rows[a_id];
			$a_name = outputdata($rows[a_name]);$a_name_en = outputdata($rows[a_name_en]);
			$a_gioithieu = outputdata($rows[a_gioithieu]);$a_gioithieu_en = outputdata($rows[a_gioithieu_en]);
			$a_pic = $rows[a_pic];
			$str_pic="";
			if($a_pic){
				$str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../multidata/$a_pic' width='130' border='0'></a>";
				$str_pic="<li>Hình<right>$str_pic</right></li>";
			}	
					
			$a_ngaycapnhat = $rows[a_date];
			$a_ngaycapnhat = substr($a_ngaycapnhat,6,2)."/".substr($a_ngaycapnhat,4,2)."/".substr($a_ngaycapnhat,0,4);
			$a_of  = $rows[a_of];	
			if ($a_of){ 
				$ac="<a href='mana_news.php?ina=$a_id&bs=$bs&pz=$pz' class='green'>Hiển thị >>> Ẩn</a>";		
			}else{ 
				$ac="<a href='mana_news.php?a=$a_id&bs=$bs&pz=$pz' class='gray'>Ẩn >>> Hiển thị</a>";
			}
			
			$a_sort  = $rows[a_sort];	
			if(($skind<=3)||($skind==6)){
				$c_id = $rows[c_id];  $q=mysql_query("select * from tbl_cata where (c_id='$c_id')");$c_name=@mysql_result($q,0,"c_name");$c_name_en=@mysql_result($q,0,"c_name_en");
				$str_cid="<li>Danh mục<right>$c_name / $c_name_en</right></li>";
			}else $str_cid="";
echo "<table>
<tr>
<th width='2%'>Check</th>
<th width='7%'>S.xếp</th>
<th><h2>$a_name<h2></th>
</tr>
<tr>
<td><input name='check$stt' type='checkbox' value='$a_id' $tcheck></td>
<td><input name='sx$a_id' type='text' value='$a_sort'><input name='sort$stt' type='hidden' value='$a_id'></td>
<td><ul>
	<li>Ngày nhập<right>$a_ngaycapnhat</right></li>
	<li>Tiêu đề EN<right>$a_name_en</right></li>
	$str_cid
	$str_pic
	<li>Giới thiệu VN<right>$a_gioithieu</right></li>
	<li>Giới thiệu EN<right>$a_gioithieu_en</right></li>
	<li>Chức năng<right><a href='edit_news.php?edit=$a_id&bs=$bs&pz=$pz' class='orange'>Sửa</a><a href='$PHP_SELF?del=$a_id&bs=$bs&pz=$pz' class='orange' onclick=\"return confirm('Bạn chắc chắn muốn xóa ?')\">Xóa</a><a href='piccenternews.php?a_id=$a_id&pz=$pz&bs=$bs' class='blue'>Hình giữa nội dung</a>$ac</right></li>
</ul></td>
</tr>
</table><br>";}
echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Check All\" name=\"checkall\" class=\"submit\">
	<input onclick=\"UnCheckAll()\" type=\"button\" value=\"Uncheck All\" name=\"uncheck\" class=\"submit\">
	<input onclick=\"DelCheck()\" type=\"button\" value=\"Xóa\" name=\"delete\" class=\"submit\">
	<input onclick=\"Sort()\" type=\"button\" value=\"Sắp xếp\" name=\"sort\" class=\"submit\">
	<input name='pz' type='hidden' value='$pz'>
	<input name='bs' type='hidden' value='$bs'>
	<input name='socheck' type='hidden' value='$stt'></form>";
if($finishpage){?>
<br />
<ul>
<li>Hiển thị từ <?=$startpage?> đến <?=$finishpage?> (của <?=$numlist?> tin)
<span><?=$str_pagelist?>
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
</span></li>
</ul>
</body>
</html>