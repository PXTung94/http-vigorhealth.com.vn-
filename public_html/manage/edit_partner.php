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
	$sql_qr=mysql_query("select * from tbl_banner where lienketid='$edit'");
	$lienketid=$edit;
	$s_pic=@mysql_result($sql_qr,0,'s_pic');$s_text=outputdata_input(@mysql_result($sql_qr,0,'s_text'));$s_link=outputdata_input(@mysql_result($sql_qr,0,'s_link'));
	$s_text_en=outputdata_input(@mysql_result($sql_qr,0,'s_text_en'));
}
if($s_pic){
	$type=strtolower(substr($s_pic, -3));
	if($type=="swf")
		$str_pic="<embed width='180' height='270' align='middle' quality='high' wmode='transparent' allowscriptaccess='always' flashvars='google.com.vn;targer='_blank'' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' alt='' src='../multidata/$s_pic'>";
	else $str_pic="<a href='../multidata/$s_pic' target='_blank'><img src='../multidata/$s_pic' width='150'></a><br>"; 
}else $str_pic="";
if($submit){
	$thanhcong=1;
	$pic_name_slide="";
	if ($thanhcong){
		if($_FILES['picfile']['name']){
			$type=strtolower(substr($_FILES['picfile']['name'], -3));
			if($type=="swf"){
				$pic_name_slide=upload_file('picfile',0);
				if(@is_numeric($pic_name_slide)){
					$thanhcong=0;
					$error=$array_error_file[$pic_name_slide];
					echo "<script>alert(\"$error\");</script>";
				}
			}else{
				$pic_name_slide=upload_image('picfile',0,1,0,0);
				if(@is_numeric($pic_name_slide)){
					$thanhcong=0;
					$error=$array_error_image[$pic_name_slide];
					echo "<script>alert(\"Image Slide: $error\");</script>";
				}
			}
		}
	}
	if ($thanhcong){
		$s_text=inputdata($s_text);$s_link=inputdata($s_link);$s_text_en=inputdata($s_text_en);
		$qr="update tbl_banner set s_text='$s_text',s_link='$s_link',s_text_en='$s_text_en'";
		if ($_FILES['picfile']['name']) {@unlink("../multidata/$s_pic");$qr.=",s_pic='$pic_name_slide'";}
		$qr.=" where lienketid='$lienketid'";
		$qrsql=mysql_query($qr);
		echo "<script>
	
					alert('Đã sửa thành công !');
	
					location.href='mana_partner.php';
	
				</script>";
	
		exit();
	}
}
$addcat=<<<EOF
	<h1>Sửa Banner Left</h1>
	<form name="FormName" action="$PHP_SELF?submit=add" method="POST" name="FormName" enctype='multipart/form-data'>
	<ul>
		<li>Tiêu đề VN:<right><input type=text name='s_text' value='$s_text'></right></li>
		<li>Tiêu đề EN:<right><input type=text name='s_text_en' value='$s_text_en'></right></li>
		<li>Hình / Flash:<right>$str_pic<input type=file name='picfile' value=''> Width: 300px (Nếu nhập hình)</right></li>
		<li>Liên kết:<right><input type=text name='s_link' value='$s_link'></right></li>
		
		<li><right><input type="submit" value="Sửa" class="submit"></right></li>
	</ul><input type='hidden' name='lienketid' value="$lienketid"><input type=hidden name='s_pic' value='$s_pic'>
</form>
EOF;
echo $addcat;
?>
</body>
</html>