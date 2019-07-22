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
<script language="javascript">
function AddCollection()
{
  with (document.FormName)
      {
         if (name.value==""){
		       alert("Bạn phải nhập tên VN vào !");
               name.focus();
               return false;
        }
		if (name_en.value==""){
		       alert("Bạn phải nhập tên EN vào !");
               name_en.focus();
               return false;
        }
		
	
   }
   return true;
}

</script>
</head>
<body>

<?
if (($submit) && ($act=="add")){
	$thanhcong=1;
	$name=trim($name);
	if($thanhcong) {
		if (@is_numeric($name)){
			$thanhcong=0;
			echo "<script>alert('Tên album VN phải là chuổi !');</script>";
		}
	}
	
	if($thanhcong) {
		$name_no=RemoveSign($name);
		$qr_sql = mysql_query("select idsubcollection from tbl_subcollection where name_no = '$name_no'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên album VN đã tồn tại !');</script>";
		}
	}
	$name_en=trim($name_en);
	if($thanhcong) {
		if (@is_numeric($name_en)){
			$thanhcong=0;
			echo "<script>alert('Tên album EN phải là chuổi !');</script>";
		}
	}
	
	if($thanhcong) {
		$name_en_no=RemoveSign($name_en);
		$qr_sql = mysql_query("select idsubcollection from tbl_subcollection where name_en_no = '$name_en_no'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên album EN đã tồn tại !');</script>";
		}
	}
	if ($thanhcong){
		$pic_name=upload_image('picmain',0,0,0,0);
		if(@is_numeric($pic_name)){
			$thanhcong=0;
			$error=$array_error_image[$pic_name];
			echo "<script>alert(\"$error\");</script>";
		}
	}
	if($thanhcong){
		$name=inputdata($name);$name_en=inputdata($name_en);$meta_key=inputdata($meta_key);
		$qr="insert into tbl_subcollection(name,name_no,name_en,name_en_no,preimage,hienthi,meta_key) 
		values ('$name','$name_no','$name_en','$name_en_no','$pic_name','$active','$meta_key')";
		$query=mysql_query($qr);
		$qr=mysql_query("select idsubcollection from tbl_subcollection order by idsubcollection desc limit 0,1");
		$idsubcollection=@mysql_result($qr,0,'idsubcollection');
		echo "<script>
					location.href='add_pic_album.php?idsubcollection=$idsubcollection';
		 	</script>";
		exit();
	}
}
?>
<form name="FormName" action="<?=$PHP_SELF?>?act=add&submit=1" method="POST"  enctype="multipart/form-data" onSubmit="return AddCollection();">
<h1>Nhập album hình</h1>
<ul>
<li>Tên album VN<right><input name="name" value="<?=$name?>"/></right></li>
<li>Tên album EN<right><input name="name_en" value="<?=$name_en?>"/></right></li>
<li>Hình chính<right><input name="picmain" type="file" value="" /><br />Width x Height: 250px x 160px</right></li>
<li>Nội dung thẻ Meta<right ><textarea name="meta_key" rows="5"><?=$meta_key?></textarea></right></li>
<li>Hiển thị/Ẩn<right><input name="active" type="radio" value="1" checked style="width:auto"> Hiển thị <input name="active" type="radio" value="0" style="width:auto"> Ẩn</right></li>
<li><right><input name="dangky" type="submit" class="submit" value="Nhập" /></right></li>
</ul>
</form>
</body>
</html>