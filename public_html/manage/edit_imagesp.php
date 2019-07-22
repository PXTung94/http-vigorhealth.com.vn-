<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<title>Thay đổi hình ảnh</title>
<?
if((!$dangky)&&($edit)){
	$id=$edit;
	$qr_sql = mysql_query("select * from tbl_hinhanhsp where id = '$edit' and a_id = '$a_id'");
	$a_pic=@mysql_result($qr_sql,0,'a_picother');
}
$str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../resizemultidata/$a_pic' width='130' border='0' class='border_images'></a>";
if(($dangky) && ($action=="check")){
	$thanhcong=1;
	$pic_name=upload_image('picfile',0,1,0,130);
	if(@is_numeric($pic_name)){
		$thanhcong=0;
		$error=$array_error_image[$pic_name];
		echo "<script>alert(\"$error\");</script>";
	}
	if ($thanhcong){
		$thoigiandk=date("Ymd");
		
		if ($_FILES['picfile']['name']) {
			$query="update tbl_hinhanhsp set ";
			@unlink("../resizemultidata/$a_pic");
			@unlink("../multidata/$a_pic");
			$query.=" a_picother='$pic_name'";
			$query.=" where id='$id' and a_id='$a_id'";
			$upd = mysql_query($query);
		}
		
		echo "<script>
				alert('Đã cập nhật thành công !');
				location.href='picmanagesp.php?a_id=$a_id&bs=$bs&pz=$pz';
			</script>";
		exit();
	}else{
		echo "<script>
					alert('Error, Edit is not successful  !');
			</script>";
	}
}
?>
<form name="FormName"   action="edit_imagesp.php?action=check" method="post" enctype="multipart/form-data">
<h1>Thay đổi hình ảnh</h1>
<ul>
    <li>Hình cũ<right><?=$str_pic?></right></li>
    <li>Hình mới<right><input name="picfile" type="file" value=""></right></li>
    <li><right> Valid file extensions for images are .JPG, .PNG and .GIF</right></li>
    <li><a onClick="history.go(-1)" class="blue">Back</a><right><input name="dangky" type="submit" class="submit" value="Cập nhật" /></right></li>
</ul>
<input type=hidden name='pz' value='<?=$pz?>'>
<input type=hidden name='bs' value='<?=$bs?>'>
<input type=hidden name='a_id' value='<?=$a_id?>'>
<input type=hidden name='id' value='<?=$id?>'>
<input type=hidden name='a_pic' value='<?=$a_pic?>'>
</form>
</body>
</html>