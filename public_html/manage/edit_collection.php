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
if(!isset($tion)){
	$qr=mysql_query("select * from tbl_subcollection where idsubcollection='$idsubcollection'");
	$name=outputdata_input(@mysql_result($qr,0,'name'));$name_en=outputdata_input(@mysql_result($qr,0,'name_en'));$meta_key=outputdata_input(@mysql_result($qr,0,'meta_key'));
	$image=@mysql_result($qr,0,'preimage');
 }else{
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
		$qr_sql = mysql_query("select idsubcollection from tbl_subcollection where name_no = '$name_no' and idsubcollection<>'$idsubcollection'");
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
		$qr_sql = mysql_query("select idsubcollection from tbl_subcollection where name_en_no = '$name_en_no' and idsubcollection<>'$idsubcollection'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên album EN đã tồn tại !');</script>";
		}
	}
	
	if ($thanhcong){
		$pic_name=upload_image('picmain',0,1,0,0);
		if(@is_numeric($pic_name)){
			$thanhcong=0;
			$error=$array_error_image[$pic_name];
			echo "<script>alert(\"$error\");</script>";
		}
	}
	
	if ($thanhcong){
		$name=inputdata($name);$name_en=inputdata($name_en);$meta_key=inputdata($meta_key);
		$qr="update tbl_subcollection set name_no='$name_no',name_en='$name_en',name_en_no='$name_en_no',name='$name',meta_key='$meta_key' ";
		if($_FILES['picmain']['name']) {
			@unlink("../multidata/$oldimage");
			$qr.=",preimage='$pic_name'";
		}
		$qr.=" where idsubcollection='$idsubcollection'";
		$query=mysql_query($qr);
		echo "<script>
					alert(\"Đã sửa thành công\");
					location.href='mana_collection.php?pz=$pz&s_u=$s_u';
			 	</script>";
				exit();
	}
}
if(!$image) $image=$oldimage;
$str_image="<a href='../multidata/$image' target='_blank'><img src='../multidata/$image' width='150' border='0'></a>";
?>
<form name="FormName" action="<?=$PHP_SELF?>?act=add&tion=prv&submit=1" method="POST"  onSubmit="return AddCollection();" enctype='multipart/form-data'>
<h1>Sửa album hình</h1>
<u>
<li>Tên album VN<right><input name="name" value="<?=$name?>"/></right></li>
<li>Tên album EN<right><input name="name_en" value="<?=$name_en?>"/></right></li>
<li>Hình chính<right><?=$str_image?><br><input name="picmain" type="file" value="" /><br />Width x Height: 250px x 160px</right></li>
<li>Nội dung thẻ Meta<right ><textarea name="meta_key" rows="5"><?=$meta_key?></textarea></right></li>
<li><right><input name="dangky" type="submit" class="submit" value="Sửa" /></right></li>
<input type="hidden" name="oldimage" value="<?=$image?>">
			<input type="hidden" name="s_u" value="<?=$s_u?>">
			<input type="hidden" name="pz" value="<?=$pz?>">
			<input type="hidden" name="idsubcollection" value="<?=$idsubcollection?>">
</form>
</body>
</html>