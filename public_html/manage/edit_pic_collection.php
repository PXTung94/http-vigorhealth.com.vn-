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
<?
$qr_collection = mysql_query("select name from tbl_subcollection where idsubcollection ='$idsubcollection'");
$name_collection=outputdata(@mysql_result($qr_collection,0,'name'));
?>
<title> <? echo $name_collection ?></title>
<h1>Quản lý Hình ảnh: <?=$name_collection?></h1>
<? if (!$edit){
?>
	<form  action="add_pic_album.php" method="post">
	<ul>
		<li><right><input type="hidden" name="idsubcollection" value="<? echo $idsubcollection ?>"><input name="submit" type="submit" value="Thêm hình" class="submit" ></right></li>
	</ul>
	</form>
<?
}
if($com=="check"){	$tcheck="checked";}

if($com=="uncheck"){$tcheck="";}

if($com=="delete"){

	for($i=1;$i<=$socheck;$i++){

		$b="check".$i;

		$id=$$b;

		if($id){ 
			$nam = mysql_query("select image from tbl_album where idalbum='$id'");
			$namepic = @mysql_result($nam,0,"image");@unlink("../multidata/$namepic");@unlink("../resizemultidata/$namepic");
			$sql_del = mysql_query("delete from tbl_album where (idalbum ='$id')");
		}

	}

}

if($com=="sort"){

	for($i=1;$i<=$socheck;$i++){

		$b="sort".$i;

		$idalbum1=$$b;

		$idalbum2="sx".$idalbum1;

		$sort_v=$$idalbum2;

		if($sort_v){  $sql_qr = mysql_query("update tbl_album set sort='$sort_v' where (idalbum ='$idalbum1')");}
	}
}

if($del){
	$nam = mysql_query("select image from tbl_album where idalbum='$del'");
	$namepic = @mysql_result($nam,0,"image");
	$dele = mysql_query("delete from tbl_album where idalbum='$del'");
	@unlink("../multidata/$namepic");
	@unlink("../resizemultidata/$namepic");
	}

if ($edit){
	$qedit=mysql_query("select * from tbl_album where  idalbum='$edit'");
	$idalbum=$edit;
	$picname=mysql_result($qedit,0,'image');
	echo "
	<form  action='$PHP_SELF?finishedit=1' method='post' enctype='multipart/form-data'>
	<ul>
		<li>Hình cũ:<right><a href='../multidata/$picname' target='_blank'><img src='../resizemultidata/$picname' width='150'  border='0'></a></right></li>
		<li>Hình mới<right ><input name='picfile' type='file' id='picfile' style='width:100%'></right></li>
		<li><right><input name='finishedit' type='submit' value='Sửa' class='submit'></right></li>
	</ul>
	<input type='hidden' name='idalbum' value='$idalbum'>
						<input type='hidden' name='pz' value='$pz'>
						<input type='hidden' name='image_old' value='$picname'>
						<input type='hidden' name='idsubcollection' value='$idsubcollection'>
	</form>";
	
		exit();
}
	if($finishedit){
		if ($_FILES['picfile']['name']) { 
			$pic_name=upload_image('picfile',0,1,0,0);
			resizepic_one($pic_name,220);
			if(@is_numeric($pic_name)){
				$error=$array_error_image[$pic_name];
				echo "<script>alert(\"$error\");</script>";
			}else{ $upl = mysql_query("update tbl_album set image='$pic_name' where idalbum='$idalbum'");}
		}
		echo "<script>alert(\"Đã sửa thành công\");	location.href='$PHP_SELF?idsubcollection=$idsubcollection&pz=$pz&s_u=$s_u';	</script>";
		exit();
	}	
	$numview = 15;
	if($pz=="") $pzz = 0;
	else $pzz = $pz * $numview;
	$getpic = mysql_query("select * from tbl_album  where idsubcollection ='$idsubcollection' order by sort, idalbum limit $pzz,$numview");
	$sql_num = mysql_query("select * from tbl_album  where idsubcollection ='$idsubcollection' order by sort,idalbum");
	$numlist = @mysql_num_rows($sql_num);
	$numshow = (int)$numlist/$numview;
	echo "<form action='edit_pic_collection.php' method='post' name='mainform' id='mainform'><input name='com' type='hidden' value=''>
	<table>";
	$cou= 0;
	$stt=0;
	while($rows = mysql_fetch_array($getpic)){
		$stt++;
		$picname = $rows['image'];
		$idalbum = $rows['idalbum'];
		$pic_sort = $rows['sort'];
		if ($cou%5==0) echo "<tr valign='top'>";
		echo "<td width='20%'><div align='center'>
		<a href='../multidata/$picname' target='_blank'><img src='../resizemultidata/$picname' width=150 border=0></a><br>
		
		<input name='check$stt' type='checkbox' value='$idalbum' $tcheck><input name='sort$stt' type='hidden' value='$idalbum'>Sắp xếp: <input name='sx$idalbum' type='text' value='$pic_sort' size='1' style='width:auto'><br>";
		echo "<a href='$PHP_SELF?del=$idalbum&pz=$pz&idsubcollection=$idsubcollection' onClick=\"return confirm('Bạn chắc chắn muốn xoá ?');\" class='orange'>Xoá</a>
		&nbsp;&nbsp;<a href='$PHP_SELF?edit=$idalbum&pz=$pz&idsubcollection=$idsubcollection' onClick=\"return confirm('Bạn chắc chắn muốn sửa ?');\" class='orange'>Sửa</a>
		</div><br></td>";
		if(($cou!=0) && ($cou%5==4)) echo "</tr>";
		$cou++;	  
		}
		echo "</table>";
echo "</td>
  </tr>
</table>";	
echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Check All\" name=\"checkall\"  class=\"submit\">&nbsp;";

		echo "<input onclick=\"UnCheckAll()\" type=\"button\" value=\"UnCheck All\" name=\"uncheck\"  class=\"submit\">&nbsp;";

echo "<input onclick=\"Sort()\" type=\"button\" value=\"Sắp xếp\" name=\"sort\"  class=\"submit\">&nbsp;&nbsp;";
echo "<input onclick=\"DelCheck()\" type=\"button\" value=\"Xoá\" name=\"delete\"  class=\"submit\">&nbsp;";
		echo "<input name='socheck' type='hidden' value='$stt'>
		<input name='idsubcollection' type='hidden' value='$idsubcollection'>
		<input name='pz' type='hidden' value='$pz'>";

		echo"</form>";	
		
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
			$tam=$bt-1; $str_pagelist.="<a href='edit_pic_collection.php?bs=$bs&pz=$tam&idsubcollection=$idsubcollection' class='blue'>[$bt-$kt]</a> ";
		}
	}
	if($pz){$tam=$pz-1; $str_pagelist.="<a href='edit_pic_collection.php?bs=$bs&pz=$tam&idsubcollection=$idsubcollection' class='gray'>« trước</a>";}
	if ($batdau <= $ketthuc){
		for($i = $batdau; $i < $ketthuc; $i++){
			$k = $i+1;
			if($i==$pz) $str_pagelist.="<a class='green'>$k</a>";
			else{$tam=$i; $str_pagelist.="<a href='edit_pic_collection.php?bs=$bs&pz=$tam&idsubcollection=$idsubcollection' class='blue'>$k</a>";}
		}
	}
	if(!($pz>=$numshow-1)) { $tam=$pz+1;$str_pagelist.="<a href='edit_pic_collection.php?bs=$bs&pz=$tam&idsubcollection=$idsubcollection' class='gray'>sau »</a>";}
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
			if($bt<=$kt) $str_pagelist.="<a href='edit_pic_collection.php?bs=$bs&pz=$tam&idsubcollection=$idsubcollection' class='blue'>[$strbtkt]</a> ";
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