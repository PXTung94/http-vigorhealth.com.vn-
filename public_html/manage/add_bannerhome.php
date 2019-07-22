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
<script language="Javascript1.2">
function CheckFormAdd(){
  with (document.FormName){
			if (a_name.value==""){
                 alert("Nhập tiêu đề VN vào !");
                 a_name.focus();
                 return false;
            }
			if (a_name_en.value==""){
                 alert("Nhập tiêu đề EN vào !");
                 a_name_en.focus();
                 return false;
            }
			
        }
        return true;
}
</script>
</head>
<body>
<?
if(($dangky) && ($action=="check")){
	$thanhcong=1;
	$a_name=trim($a_name);$a_name_en=trim($a_name_en);
	$pic_name="";
	if ($thanhcong){
		if($_FILES['picfile']['name']){
			$pic_name=upload_image('picfile',0,0,0,0);
			if(@is_numeric($pic_name)){
				$thanhcong=0;
				$error=$array_error_image[$pic_name];
				echo "<script>alert(\"$error\");</script>";
			}
		}
	}
	if ($thanhcong){
		$a_name=inputdata($a_name);$a_name_en=inputdata($a_name_en);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$query="insert into tbl_bannerhome(a_name,a_gioithieu,a_of,a_pic,a_name_en,c_id,a_gioithieu_en) 
		VALUES('$a_name','$a_gioithieu','1','$pic_name','$a_name_en','$c_id','$a_gioithieu_en')";
		
		$upd = mysql_query($query);	
		echo "<script>
					alert('Đã nhập thành công.');
					location.href='add_bannerhome.php';
			</script>";
		exit();
	}
}
?>
<form name="FormName"  onSubmit="return CheckFormAdd();" action="add_bannerhome.php?action=check" method="post" enctype="multipart/form-data">
<h1>Nhập Banner</h1>
<ul>
<li>Tiêu đề VN<right><input name="a_name" value="<?=$a_name?>"/></right></li>
<li>Tiêu đề EN<right><input name="a_name_en" value="<?=$a_name_en?>"/></right></li>
<li>Danh mục<right><select name='c_id'><?
	foreach ($array_loaibanner as $c_id1 => $c_name){
		if($c_id==$c_id1) echo "<option value='$c_id1' selected>$c_name</option>";else echo "<option value='$c_id1'>$c_name</option>";
	}
	?></select>
</right></li>
<li>Hình<right><input name="picfile" type="file" value="" /></right></li>
<li>Giới thiệu VN<right><textarea name="a_gioithieu" rows="5"><?=$a_gioithieu?></textarea></right></li>
<li>Giới thiệu EN<right><textarea name="a_gioithieu_en" rows="5"><?=$a_gioithieu_en?></textarea></right></li>
<li><right><input name="dangky" type="submit" class="submit" value="Nhập" /></right></li>
</ul>
</form>
</body>
</html>