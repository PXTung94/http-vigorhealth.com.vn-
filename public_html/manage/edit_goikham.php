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

if ($edit){
	$sql_qr=mysql_query("select * from tbl_goikham where lienketid='$edit'");
	$lienketid=$edit;
	$s_pic=@mysql_result($sql_qr,0,'s_pic');$s_text=outputdata_input(@mysql_result($sql_qr,0,'s_text'));$s_link=outputdata_input(@mysql_result($sql_qr,0,'s_link'));
	$s_text_en=outputdata_input(@mysql_result($sql_qr,0,'s_text_en'));
	$a_gioithieu=outputdata_input(@mysql_result($sql_qr,0,'a_gioithieu'));$a_gioithieu_en=outputdata_input(@mysql_result($sql_qr,0,'a_gioithieu_en'));
}
if($s_pic) $str_pic="<a href='../multidata/$s_pic' target='_blank'><img src='../multidata/$s_pic' width='150'></a><br>"; else $str_pic="";
if($submit){
	$thanhcong=1;
	$pic_name_slide="";
	if ($thanhcong){
		if($_FILES['picfile']['name']){
			$pic_name_slide=upload_image('picfile',0,1,0,0);
			if(@is_numeric($pic_name_slide)){
				$thanhcong=0;
				$error=$array_error_image[$pic_name_slide];
				echo "<script>alert(\"Image Slide: $error\");</script>";
			}
		}
	}
	if ($thanhcong){
		$s_text=inputdata($s_text);$s_link=inputdata($s_link);$s_text_en=inputdata($s_text_en);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$qr="update tbl_goikham set s_text='$s_text',s_link='$s_link',s_text_en='$s_text_en',a_gioithieu='$a_gioithieu',a_gioithieu_en='$a_gioithieu_en'";
		if ($_FILES['picfile']['name']) {@unlink("../multidata/$s_pic");$qr.=",s_pic='$pic_name_slide'";}
		$qr.=" where lienketid='$lienketid'";
		$qrsql=mysql_query($qr);
		echo "<script>
	
					alert('Đã sửa thành công !');
	
					location.href='mana_goikham.php';
	
				</script>";
	
		exit();
	}
}
$addcat=<<<EOF
	<h1>Sửa gói khám</h1>
	<form name="FormName" action="$PHP_SELF?submit=add" method="POST" name="FormName" enctype='multipart/form-data'>
	<ul>
		<li>Tên gói khám VN:<right><input type=text name='s_text' value='$s_text'></right></li>
		<li>Tên gói khám EN:<right><input type=text name='s_text_en' value='$s_text_en'></right></li>
		<li>Hình:<right>$str_pic<input type=file name='picfile' value=''> Width x Height: 60px x 60px</right></li>
		<li>Liên kết:<right><input type=text name='s_link' value='$s_link'></right></li>
		<li>Giới thiệu VN<right><textarea name='a_gioithieu' rows='3'>$a_gioithieu</textarea></right></li>
		<li>Giới thiệu EN<right><textarea name='a_gioithieu_en' rows='3'>$a_gioithieu_en</textarea></right></li>
		<li><right><input type="submit" value="Sửa" class="submit"></right></li>
	</ul><input type='hidden' name='lienketid' value="$lienketid"><input type=hidden name='s_pic' value='$s_pic'>
</form>
EOF;
echo $addcat;
?>
</body>
</html>