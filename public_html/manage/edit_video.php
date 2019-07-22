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

function AddNews()

{

  with (document.FormName)

      {

		if (v_name.value==""){

		       alert("Bạn phải nhập tiêu đề VN vào !");

               v_name.focus();

               return false;

        }
		if (v_name_en.value==""){

		       alert("Bạn phải nhập tiêu đề EN vào !");

               v_name_en.focus();

               return false;

        }
		
   }

   return true;



}

</script>

<?
if ($edit){
	$sql_qr=mysql_query("select * from tbl_video where v_id='$edit'");
	$v_id=$edit;
	$v_name = outputdata_input(@mysql_result($sql_qr,0,"v_name"));
	$v_lienket = outputdata_input(@mysql_result($sql_qr,0,"v_lienket"));
	$v_des = outputdata_input(@mysql_result($sql_qr,0,"v_des"));
	$v_des_en = outputdata_input(@mysql_result($sql_qr,0,"v_des_en"));
	$v_name_en = outputdata_input(@mysql_result($sql_qr,0,"v_name_en"));
	$v_short = outputdata_input(@mysql_result($sql_qr,0,"v_short"));
	$v_short_en = outputdata_input(@mysql_result($sql_qr,0,"v_short_en"));
	$v_pic = trim(@mysql_result($sql_qr,0,"v_pic"));
}
$str_pic="<a href='../multidata/$v_pic' target='_blank'><img src='../multidata/$v_pic' width='120'></a>";
if($submit){
	$thanhcong=1;
	if($thanhcong) {
		if (@is_numeric($v_name)){
			$thanhcong=0;
			echo "<script>alert('Tiêu đề VN phải là chuỗi !');</script>";
		}
	}
	
	if($thanhcong) {
		$v_name_no=RemoveSign($v_name);
		$qr_sql = mysql_query("select v_id from tbl_video where v_name_no = '$v_name_no' and v_id <> '$v_id'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tiêu đề VN đã tồn tại!');</script>";
		}
	}
	if($thanhcong) {
		if (@is_numeric($v_name_en)){
			$thanhcong=0;
			echo "<script>alert('Tiêu đề EN phải là chuỗi !');</script>";
		}
	}
	if($thanhcong) {
		$v_name_en_no=RemoveSign($v_name_en);
		$qr_sql = mysql_query("select v_id from tbl_video where v_name_en_no = '$v_name_en_no' and v_id <> '$v_id'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tiêu đề EN đã tồn tại !');</script>";
		}
	}
	if ($thanhcong){
		$pic_name=upload_image('picfile',0,1,0,0);
		if(@is_numeric($pic_name)){
			$thanhcong=0;
			$error=$array_error_image[$pic_name];
			echo "<script>alert(\"$error\");</script>";
		}
	}
	if($thanhcong){
		$v_lienket=inputdata($v_lienket);$v_name=inputdata($v_name);$v_name_en=inputdata($v_name_en);
		$v_short=inputdata($v_short);$v_des=inputdata($v_des);$v_short_en=inputdata($v_short_en);$v_des_en=inputdata($v_des_en);
		$qr="update tbl_video set v_name='$v_name',v_name_no='$v_name_no',v_lienket='$v_lienket',v_name_en='$v_name_en',v_name_en_no='$v_name_en_no'
		,v_short='$v_short',v_short_en='$v_short_en',v_des='$v_des',v_des_en='$v_des_en'";
		if ($_FILES['picfile']['name']) {
			@unlink("../multidata/$v_pic");
			$qr.=" ,v_pic='$pic_name'";
		}
		$qr.=" where v_id='$v_id'";
		$qrsql=mysql_query($qr);
		echo "<script>alert('Đã sửa thành công!');location.href='mana_video.php?pz=$pz';</script>";
		exit();
	}
}
?>

<h2>Sửa video</h2>

<form action="<?=$PHP_SELF?>?submit=add" method="post" onSubmit="return AddNews();"  enctype="multipart/form-data">
	<ul>
		<li>Tiêu đề VN<right><input type="text" name="v_name" value="<?=$v_name?>"></right></li>
		<li>Tiêu đề EN<right><input type="text" name="v_name_en" value="<?=$v_name_en?>"></right></li>
		<li>Đường dẫn<right><textarea name="v_lienket" rows="3"><?=$v_lienket?></textarea></right></li>
		<? if($v_pic){?><li>Hình cũ<right><?=$str_pic?></right></li><? }?>
		<li>Hình mới<right><input name="picfile" type="file" value=""/>Width x Height: 200px × 110px</right></li>
		<li>Giới thiệu VN<right ><textarea name="v_short" rows="5"><?=$v_short?></textarea></right></li>
		<li>Giới thiệu EN<right ><textarea name="v_short_en" rows="5"><?=$v_short_en?></textarea></right></li>
		<li>Chi tiết VN<right ><textarea name="v_des" rows="20"><?=$v_des?></textarea></right></li>
		<li>Chi tiết EN<right ><textarea name="v_des_en" rows="20"><?=$v_des_en?></textarea></right></li>
		<li><right><input type="submit" value="Sửa" class="submit"></right></li>
	</ul><input type='hidden' name='v_id' value="<?=$v_id?>"><input type=hidden name='v_pic' value='<?=$v_pic?>'>
	<input type=hidden name='pz' value='<?=$pz?>'>
	</form>

</body>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('v_des');CKEDITOR.replace('v_des_en');
</script>