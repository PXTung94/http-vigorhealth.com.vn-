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

	function Sendmail()

	{

		if(confirm('Bạn chắc chắn muốn gửi mail ?'))

		{

			document.mainform.com.value='sendmail';

			document.mainform.submit();

		}

	}
	function Exportmail()

	{

		if(confirm('Bạn chắc chắn muốn lấy địa chỉ mail ?'))

		{

			document.mainform.com.value='exportmail';

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
if($com=="check"){	$tcheck="checked";
	}elseif($com=="uncheck"){$tcheck="";
	}elseif($com=="sendmail"){
	$str_dssendmail="0";
	for($i=1;$i<=$socheck;$i++){
		$b="check".$i;$id=$$b;
		if($id) $str_dssendmail.=",".$id;
	}
	$str_dssendmail.=",0";
	if ($str_dssendmail=="0,0"){ echo "<script>alert('Bạn phải chọn mail cần gửi thư');location.href='mana_dknhanmail.php?view=all';</script>";}else{echo "<script>
				location.href='maillist.php?str_dssendmail=$str_dssendmail&kinduser=1';
			</script>";}
}
if($com=="exportmail"){
	$sql_listabc = mysql_query("select * from tb_nhanquangcao order by id ASC");
	$k=0;
	while($rowsabc = mysql_fetch_array($sql_listabc)){
		$emailabc = $rowsabc['email'];
		if($k) echo ", ";
		$k=1;
		echo $emailabc;
	}
	echo "<br><br><a href='mana_dknhanmail.php?view=all&pz=$pz' class='orange'>Nhấn vào đây để quay về trang <strong>danh sách đăng ký nhận mail</strong></a>";
}
if($com=="delete"){
	for($i=1;$i<=$socheck;$i++){
		$b="check".$i;
		$id=$$b;
		if($id){
		  $sql_del = mysql_query("delete from tb_nhanquangcao where (id ='$id')");
			
		}
	}
	echo "<script>
		alert(\"Đã Xóa xong\");
		location.href='mana_dknhanmail.php?view=all&pz=$pz';
		</script>
		";
}
if($edit)
	{
	$sql = mysql_query("select * from tb_nhanquangcao where id = '$edit' limit 1");
	$idcuano = $edit;
	$id = mysql_result($sql,0,"id");
	$email = mysql_result($sql,0,"email");
	echo "<h2>Thay đổi địa chỉ email</h2> <br><form action='mana_dknhanmail.php?editok=ok' method=POST>
	<u>    
		<li>Email<right><input name='email' value='$email'/></right></li>
		<li><right><input name='dangky' type='submit' class='submit' value='Sửa' /></right></li>
</ul>
	<input type='hidden' name='gtno' value='$idcuano'>
	</form>
	";
	}
if($editok)	
	{
	$sql = mysql_query("update tb_nhanquangcao SET email='$email' where id='$gtno'");
	echo "<script>
		alert(\"Đã sửa xong\");
		location.href='mana_dknhanmail.php?view=all&pz=$pz';
		</script>
		";
	}

if($del)
{
	$sql = "delete from tb_nhanquangcao where id = '$del'";
    $result = mysql_query($sql);
	echo "<script>
			alert(\"Đã xóa thành công.\");
			location.href='mana_dknhanmail.php?view=all&pz=$pz';
		</script>
	";
}
if($view){
echo "<h1>Danh sách đăng ký nhận email</h1>";
echo "<form action='mana_dknhanmail.php' method='post' name='mainform' id='mainform'>
          <input name='com' type='hidden' value=''>
<table>
<tr>
	<th width='3%'>Chọn</th>
	<th>Địa chỉ email</th>
	<th width='20%'>Chức năng</th>
</tr>";
$numview = 30;
	if($pz=="") $pzz = 0;
	else $pzz = $pz * $numview;
	$qr="select * from tb_nhanquangcao order by id ASC ";
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
	$id = $rows['id']; 
	$hoten = $rows['hoten'];$email = $rows['email'];
	echo "<tr>
				<td><input name='check$stt' type='checkbox' value='$id' $tcheck></td>
				<td><strong>$email</strong></td>
				<td><a href='mana_dknhanmail.php?edit=$id&pz=$pz' class='orange'>Sửa</a><a href='mana_dknhanmail.php?del=$id&pz=$pz' class='orange' onclick=\"return confirm('Bạn chắc chắn muốn Xoá ?')\">Xoá</a>$ac</td>
			</tr>";

		}
		echo "</table><br>";
		echo "<input onclick=\"CheckAll()\" type=\"button\" value=\"Chọn tất\" name=\"checkall\" class=\"submit\">&nbsp;";
		echo "<input onclick=\"UnCheckAll()\" type=\"button\" value=\"Bỏ tất\" name=\"uncheck\" class=\"submit\">&nbsp;";
		echo "<input onclick=\"DelCheck()\" type=\"button\" value=\"Xoá\" name=\"delete\" class=\"submit\">&nbsp;";
		echo "<input onclick=\"Sendmail()\" type=\"button\" value=\"Gửi mail\" name=\"sendmail\" class=\"submit\">";
		echo "<input onclick=\"Exportmail()\" type=\"button\" value=\"Lấy địa chỉ mail\" name=\"sendmail\" class=\"submit\">";
		echo "<input name='socheck' type='hidden' value='$stt'>";echo "<input name='view' type='hidden' value='$view'>";
		echo"</form>";
		if($finishpage){?>
<br />
<ul>
<li>Hiển thị từ <?=$startpage?> đến <?=$finishpage?> (của <?=$numlist?> tin)
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
			$tam=$bt-1; $str_pagelist.="<a href='mana_dknhanmail.php?bs=$bs&pz=$tam&view=1' class='blue'>[$bt-$kt]</a> ";
		}
	}
	if($pz){$tam=$pz-1; $str_pagelist.="<a href='mana_dknhanmail.php?bs=$bs&pz=$tam&view=1' class='gray'>« trước</a>";}
	if ($batdau <= $ketthuc){
		for($i = $batdau; $i < $ketthuc; $i++){
			$k = $i+1;
			if($i==$pz) $str_pagelist.="<a class='green'>$k</a>";
			else{$tam=$i; $str_pagelist.="<a href='mana_dknhanmail.php?bs=$bs&pz=$tam&view=1' class='blue'>$k</a>";}
		}
	}
	if(!($pz>=$numshow-1)) { $tam=$pz+1;$str_pagelist.="<a href='mana_dknhanmail.php?bs=$bs&pz=$tam&view=1' class='gray'>sau »</a>";}
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
			if($bt<=$kt) $str_pagelist.="<a href='mana_dknhanmail.php?bs=$bs&pz=$tam&view=1' class='blue'>[$strbtkt]</a> ";
		}
	}
}
if($str_pagelist) $str_pagelist="$str_pagelist";
if($str_pagelist){?>
<?=$str_pagelist?>
<? }?>
<? }
?>
</right></li>
</ul>
</body>
</html>
		
		