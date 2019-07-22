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
if($tion=="save"){
	$thanhcong=1;
	
	$pic_name_slide="";
	if ($thanhcong){
		if($_FILES['picfile']['name']){
			$pic_name_slide=upload_image('picfile',0,0,0,0);
			if(@is_numeric($pic_name_slide)){
				$thanhcong=0;
				$error=$array_error_image[$pic_name_slide];
				echo "<script>alert(\"$error\");</script>";
			}
		}else{$thanhcong=0;echo "<script>alert('Bạn phải nhập hình ảnh vào !');</script>";}
	}
	if ($thanhcong){
		$s_text=inputdata($s_text);$s_text_en=inputdata($s_text_en);$s_link=inputdata($s_link);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$qr="insert into tbl_goikham(hienthi,s_pic,s_text,s_link,s_text_en,a_gioithieu,a_gioithieu_en) 
		values ('$active','$pic_name_slide','$s_text','$s_link','$s_text_en','$a_gioithieu','$a_gioithieu_en')";
		$query = mysql_query($qr);
		echo "<script>
					alert('Đã nhập thành công !');
						location.href='add_goikham.php';
					</script>";
		exit();
	}
}
$addcat=<<<EOF
	<h1>Nhập Gói khám</h1>
	<form action="add_goikham.php?act=addcat&tion=save" method="post"  name="FormName" enctype="multipart/form-data"> 
	<ul>
		<li>Tên gói khám VN<right><input type=text name='s_text' value='$s_text'></right></li>
		<li>Tên gói khám EN<right><input type=text name='s_text_en' value='$s_text_en'></right></li>
		<li>Hình<right><input type=file name='picfile' value=''>Width x Height: 60px x 60px</right></li>
		<li>Liên kết<right><input type=text name='s_link' value='$s_link'></right></li>
		<li>Giới thiệu VN<right><textarea name='a_gioithieu' rows='3'>$a_gioithieu</textarea></right></li>
		<li>Giới thiệu EN<right><textarea name='a_gioithieu_en' rows='3'>$a_gioithieu_en</textarea></right></li>

		<li>Hiển thị/Ẩn<right><input name="active" type="radio" value="1" checked style="width:auto"> Hiển thị <input name="active" type="radio" value="0" style="width:auto"> Ẩn</right></li>
		<li><right><input type="submit" value="Nhập" class="submit"></right></li>
	</ul>
	</form>
EOF;
echo $addcat;
?>
</body>
</html>