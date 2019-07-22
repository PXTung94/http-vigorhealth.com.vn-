<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function DelCheck()
	{
		if(confirm('Bạn có chắc chắn muốn xoá ?!'))
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
<?
if($timkiem_user) {
	$s_u=1;
	$giatritim=trim($giatritim);
	$_SESSION['se_member_giatri']=$giatritim;
	$_SESSION['se_member_idcollection']=trim($idcollection);
	$_SESSION['se_member_sx_order']=trim($sx_order);
	$_SESSION['ses_search_tag']=$search_tag;
	$_SESSION['ses_search_tag_kind']=$timkiem_user;
}
if ($s_u) {
	$giatritim=$_SESSION['se_member_giatri'];
	$idcollection=$_SESSION['se_member_idcollection'];
	$sx_order=$_SESSION['se_member_sx_order'];
	$search_tag=$_SESSION['ses_search_tag'];
	$search_tag_kind=$_SESSION['ses_search_tag_kind'];
}
?>
<h1>Danh sách album hình</h1>
<?php
	if($sortid){
		for($i=1;$i<=$socheck;$i++){
			$b="hidden".$i;
			$idsubcollection=$$b;
			$a="sort".$i;
			$value_sort=$$a;
			if(($idsubcollection) && ($value_sort)) 
				$qr_select=mysql_query("update tbl_subcollection set sort='$value_sort' where idsubcollection  ='$idsubcollection'");
		}					
	}
	if ($active) $sql1 = mysql_query("update tbl_subcollection set hienthi=1 where idsubcollection ='$active'");
	if ($inactive) $sql1 = mysql_query("update tbl_subcollection set hienthi=0 where idsubcollection ='$inactive'");
	
	if($com=="check"){	$tcheck="checked";
	}elseif($com=="uncheck"){$tcheck="";
	}elseif($com=="delete"){
		for($i=1;$i<=$socheck;$i++){
			$b="check".$i;
			$idsubcollection=$$b;
			if($idsubcollection) {
				$qr_select=mysql_query("select * from tbl_subcollection  where  idsubcollection  ='$idsubcollection'");
				while ($row=mysql_fetch_array($qr_select)){
					$preimage=$row['preimage'];
					@unlink("../multidata/$preimage");
				}
				$sql_del = mysql_query("delete from tbl_subcollection  where  idsubcollection  ='$idsubcollection'");
				$qr_select=mysql_query("select * from tbl_album  where  idsubcollection  ='$idsubcollection'");
				while ($row=mysql_fetch_array($qr_select)){
					$preimage=$row['image'];
					@unlink("../multidata/$preimage");@unlink("../resizemultidata/$preimage");
				}
				$sql_del = mysql_query("delete from tbl_album  where  idsubcollection  ='$idsubcollection'");
			}
		}
	}
	if ($del){
		$qr_select=mysql_query("select * from tbl_subcollection  where  idsubcollection  ='$del'");
		while ($row=mysql_fetch_array($qr_select)){
			$preimage=$row['preimage'];
			@unlink("../multidata/$preimage");
		}
		$sql_del = mysql_query("delete from tbl_subcollection  where  idsubcollection  ='$del'");
		$qr_select=mysql_query("select * from tbl_album  where  idsubcollection  ='$del'");
		while ($row=mysql_fetch_array($qr_select)){
			$preimage=$row['image'];
			@unlink("../multidata/$preimage");@unlink("../resizemultidata/$preimage");
		}
		$sql_del = mysql_query("delete from tbl_album  where  idsubcollection  ='$del'");
	}
	$str_action="";
	if ($giatritim) {
		$giatritim1=RemoveSign($giatritim);
		if($str_action) $str_action.=" and "; else $str_action.=" where ";
		 $str_action .= "  (name_no='$giatritim1') ";
	}
	if($search_tag){ 
		if($str_action) $str_action.=" and "; else $str_action.=" where ";
		if ($search_tag_kind==1) $str_action.=" (a_tag_no like '%|$search_tag|%') "; else $str_action.=" (a_tag_en_no like '%|$search_tag|%') "; 
		}
	if (!$sx_order) $sx_order="sort asc,idsubcollection desc";
	$numview = 15;
	if($pz=="") $pzz = 0;
	else $pzz = $pz * $numview;
	if (!($str_order_by)) $str_order_by=" order by a_sort asc,a_id  desc";
	$sql_list = mysql_query("select * from tbl_subcollection  $str_action order by $sx_order limit $pzz,$numview");
	$sql_num = mysql_query("select  * from tbl_subcollection  $str_action");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = (int)$numlist/$numview;
	$startpage=$pz*$numview+1;
	$finishpage=$pz*$numview + $numview;
	if($finishpage >$numlist) $finishpage=$numlist;
	if(!$numlist) $startpage=0;
	echo "<form action='mana_collection.php' method='post' name='mainform' id='mainform'><input name='com' type='hidden' value=''>";
		  $stt=1;
		while($rows = mysql_fetch_array($sql_list))
			{
			$idsubcollection = $rows[idsubcollection];
			$sort=$rows['sort'];
			$name = outputdata($rows[name]);$name_en = outputdata($rows[name_en]);
			$a_pic = $rows[preimage];
			$str_pic="";
			if($a_pic){
				$str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../multidata/$a_pic' width='150' border='0'></a>";
				$str_pic="<li>Hình chính<right>$str_pic</right></li>";
			}
			$a_tag=trim($rows[a_tag]);	
			$checktag = explode("|", $a_tag);
			$ds_a_tag="";
			foreach ($checktag as $value){
				 if (trim($value)){
				 	if($ds_a_tag) $ds_a_tag.=", ";
					$a_tag_no=RemoveSign($value);
					$ds_a_tag.="<a href='mana_collection.php?timkiem_user=1&search_tag=$a_tag_no'>$value</a>";
				}
			}
			if($ds_a_tag) $ds_a_tag="<li>Tags VN<right>$ds_a_tag</right></li>";
			$a_tag_en=trim($rows[a_tag_en]);	
			$checktag = explode("|", $a_tag_en);
			$ds_a_tag_en="";
			foreach ($checktag as $value){
				 if (trim($value)){
				 	if($ds_a_tag_en) $ds_a_tag_en.=", ";
					$a_tag_no=RemoveSign($value);
					$ds_a_tag_en.="<a href='mana_collection.php?timkiem_user=2&search_tag=$a_tag_no'>$value</a>";
				}
			}
			if($ds_a_tag_en) $ds_a_tag_en="<li>Tags EN<right>$ds_a_tag_en</right></li>";
			$a_of=$rows['hienthi'];
			if ($a_of){ 
				$ac="<a href='$PHP_SELF?inactive=$idsubcollection&pz=$pz&s_u=$s_u' class='green'>Hiển thị >>> Ẩn</a>";		
			}else{ 
				$ac="<a href='$PHP_SELF?active=$idsubcollection&pz=$pz&s_u=$s_u' class='gray'>Ẩn >>> Hiển thị</a>";

			}
			
			echo "<table>
<tr>
<th width='2%'>Chọn</th>
<th width='5%'>S.Xếp</th>
<th><h2>$name ($name_en)<h2></th>
</tr>
<tr>
<td><input name='check$stt' type='checkbox' value='$idsubcollection' $tcheck></td>
<td><input name='sort$stt' type='text' size='2' value='$sort'><input name='hidden$stt' type='hidden' value='$idsubcollection'></td>
<td><ul>
	$str_pic
	$ds_a_tag
	$ds_a_tag_en
	<li>Chức năng<right><a href='edit_collection.php?idsubcollection=$idsubcollection&s_u=$s_u&pz=$pz' class='orange'>Sửa</a><a href='$PHP_SELF?del=$idsubcollection&pz=$pz&s_u=$s_u' class='orange' onclick=\"return confirm('Bạn chắc chắn muốn Xóa ?')\">Xóa</a>$ac<a href='edit_pic_collection.php?idsubcollection=$idsubcollection' target='_blank' class='blue'>Quản lý Hình</a></right></li>
</ul></td>
</tr>
</table><br>";
			$stt++;	  
			}
		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Chọn tất\" name=\"checkall\" class=\"submit\">&nbsp;";
		echo "<input onclick=\"UnCheckAll()\" type=\"button\" value=\"Bỏ tất\" name=\"uncheck\" class=\"submit\">&nbsp;";
		echo "<input onclick=\"DelCheck()\" type=\"button\" value=\"Xoá\" name=\"delete\" class=\"submit\">&nbsp;";
		echo "<input type=\"submit\" value=\"Sắp xếp\" name=\"sortid\" class=\"submit\">&nbsp;";
		echo "<input name='pz' type='hidden' value='$pz'>";
		echo "<input name='s_u' type='hidden' value='$s_u'>";
		echo "<input name='socheck' type='hidden' value='$stt'>";
		echo"</form>";
		if($finishpage){?>
<br />
<ul>
<li>Hiển thị từ <?=$startpage?> đến <?=$finishpage?> (của <?=$numlist?> album)
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
			$tam=$bt-1; $str_pagelist.="<a href='mana_collection.php?s_u=$s_u&pz=$tam' class='blue'>[$bt-$kt]</a> ";
		}
	}
	if($pz){$tam=$pz-1; $str_pagelist.="<a href='mana_collection.php?s_u=$s_u&pz=$tam' class='gray'>« trước</a>";}
	if ($batdau <= $ketthuc){
		for($i = $batdau; $i < $ketthuc; $i++){
			$k = $i+1;
			if($i==$pz) $str_pagelist.="<a class='green'>$k</a>";
			else{$tam=$i; $str_pagelist.="<a href='mana_collection.php?s_u=$s_u&pz=$tam' class='blue'>$k</a>";}
		}
	}
	if(!($pz>=$numshow-1)) { $tam=$pz+1;$str_pagelist.="<a href='mana_collection.php?s_u=$s_u&pz=$tam' class='gray'>sau »</a>";}
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
			if($bt<=$kt) $str_pagelist.="<a href='mana_collection.php?s_u=$s_u&pz=$tam' class='blue'>[$strbtkt]</a> ";
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