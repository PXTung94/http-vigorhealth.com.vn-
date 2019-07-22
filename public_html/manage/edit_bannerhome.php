<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<script language="Javascript1.2">
function CheckFormRegWebsite(){
  with (document.FormName){
		if (a_name.value==""){
            alert("Bạn phải nhập tiêu đề VN vào !");
            a_name.focus();
            return false;
        }
		if (a_name_en.value==""){
            alert("Bạn phải nhập tiêu đề EN vào !");
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
if((!$dangky)&&($edit)){
	$a_id=$edit;
	$qr_sql = mysql_query("select * from tbl_bannerhome where a_id = '$edit'");
	$a_name =outputdata_input(@mysql_result($qr_sql,0,'a_name'));$a_name_en =outputdata_input(@mysql_result($qr_sql,0,'a_name_en'));
	$a_gioithieu =outputdata_input(@mysql_result($qr_sql,0,'a_gioithieu'));$a_gioithieu_en =outputdata_input(@mysql_result($qr_sql,0,'a_gioithieu_en'));
	$c_id=@mysql_result($qr_sql,0,'c_id');	
	$a_pic=@mysql_result($qr_sql,0,'a_pic');
}
if($a_pic) $str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../multidata/$a_pic' width='150'></a>"; else $str_pic="";
if(($dangky) && ($action=="check")){
	$thanhcong=1;
	$a_name=trim($a_name);$a_name_en=trim($a_name_en);
	if ($thanhcong){
		$pic_name=upload_image('picfile',0,1,0,0);
		if(@is_numeric($pic_name)){
			$thanhcong=0;
			$error=$array_error_image[$pic_name];
			echo "<script>alert(\"$error\");</script>";
		}
	}
	
	if ($thanhcong){
		$a_name=inputdata($a_name);$a_name_en=inputdata($a_name_en);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$query="update tbl_bannerhome set a_name='$a_name',a_gioithieu='$a_gioithieu',a_name_en='$a_name_en',a_gioithieu_en='$a_gioithieu_en',c_id='$c_id'";
		if ($_FILES['picfile']['name']) {
			@unlink("../multidata/$a_pic");
			$query.=" ,a_pic='$pic_name'";
		}
		$query.=" where a_id='$a_id'";
		
		$upd = mysql_query($query);
		echo "<script>
					alert('Đã sửa thành công.');
					location.href='mana_bannerhome.php?bs=$bs&pz=$pz';
			</script>";
	}
}
?>
<form name="FormName"  onSubmit="return CheckFormRegWebsite();" action="edit_bannerhome.php?action=check" method="post" enctype="multipart/form-data">
<h1>Sửa Banner</h1>
<ul>
<li>Tiêu đề VN<right><input name="a_name" value="<?=$a_name?>"/></right></li>
<li>Tiêu đề EN<right><input name="a_name_en" value="<?=$a_name_en?>"/></right></li>
<li>Danh mục<right><select name='c_id'><?
	foreach ($array_loaibanner as $c_id1 => $c_name){
		if($c_id==$c_id1) echo "<option value='$c_id1' selected>$c_name</option>";else echo "<option value='$c_id1'>$c_name</option>";
	}
	?></select>
</right></li>
<? if($a_pic){?><li>Hình cũ<right><?=$str_pic?></right></li><? }?>
	<li>Hình mới<right><input name="picfile" type="file" value="" /></right></li>
<li>Giới thiệu VN<right><textarea name="a_gioithieu" rows="5"><?=$a_gioithieu?></textarea></right></li>
<li>Giới thiệu EN<right><textarea name="a_gioithieu_en" rows="5"><?=$a_gioithieu_en?></textarea></right></li>
<li><a onClick="history.go(-1)" class="blue">Back</a><right><input name="dangky" type="submit" class="submit" value="Sửa"/></right></li>
</ul>
<input type=hidden name='pz' value='<?=$pz?>'>
<input type=hidden name='bs' value='<?=$bs?>'>
<input type=hidden name='a_id' value='<?=$a_id?>'>
<input type=hidden name='a_pic' value='<?=$a_pic?>'>
</form>
</body>
</html>