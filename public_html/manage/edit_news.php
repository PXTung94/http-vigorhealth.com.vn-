<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
if($skind) $_SESSION["session_skind_admin"]=$skind; else $skind=$_SESSION["session_skind_admin"]; $lb_tieude ="Sửa ".$array_page[$skind];
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
	$qr_sql = mysql_query("select * from tbl_news where a_id = '$edit'");
	$a_name =outputdata_input(@mysql_result($qr_sql,0,'a_name'));$a_name_en =outputdata_input(@mysql_result($qr_sql,0,'a_name_en'));
	$a_gioithieu =outputdata_input(@mysql_result($qr_sql,0,'a_gioithieu'));$a_gioithieu_en =outputdata_input(@mysql_result($qr_sql,0,'a_gioithieu_en'));
	$a_des =outputdata_input(@mysql_result($qr_sql,0,'a_des'));$a_des_en =outputdata_input(@mysql_result($qr_sql,0,'a_des_en'));
	$meta_key =outputdata_input(@mysql_result($qr_sql,0,'meta_key'));
	$c_id=@mysql_result($qr_sql,0,'c_id');	
	$a_pic=@mysql_result($qr_sql,0,'a_pic');
	$a_ghichu =outputdata_input(@mysql_result($qr_sql,0,'a_ghichu'));$a_ghichu_en =outputdata_input(@mysql_result($qr_sql,0,'a_ghichu_en'));
}
if($a_pic) $str_pic="<a href='../multidata/$a_pic' target='_blank'><img src='../multidata/$a_pic' width='150'></a>"; else $str_pic="";
if(($dangky) && ($action=="check")){
	$thanhcong=1;
	$a_name=trim($a_name);
	if(is_numeric($a_name)){
		$thanhcong=0;
		echo "<script>alert('Tiêu đề VN phải là chuỗi !');</script>";
	}
	if ($thanhcong){
		$a_name_no=RemoveSign($a_name);$bd=0;$a_name_no_goc=$a_name_no;
		$qr_sql = mysql_query("select a_id from tbl_news where (a_name_no = '$a_name_no') and (a_id <> '$a_id')");
		$sopt=@mysql_num_rows($qr_sql);
		while($sopt){
			$bd++;
			$a_name_no=$a_name_no_goc."-".$bd;
			$qr_sql = mysql_query("select a_id from tbl_news where (a_name_no = '$a_name_no') and (a_id <> '$a_id')");
			$sopt=@mysql_num_rows($qr_sql);
		}
	}
	if ($thanhcong){
		$a_name_en=trim($a_name_en);
		if(is_numeric($a_name_en)){
			$thanhcong=0;
			echo "<script>alert('Tiêu đề EN phải là chuỗi !');</script>";
		}
	}
	if ($thanhcong){
		$a_name_en_no=RemoveSign($a_name_en);$bd=0;$a_name_en_no_goc=$a_name_en_no;
		$qr_sql = mysql_query("select a_id from tbl_news where (a_name_en_no = '$a_name_en_no') and (a_id <> '$a_id')");
		$sopt=@mysql_num_rows($qr_sql);
		while($sopt){
			$bd++;
			$a_name_en_no=$a_name_en_no_goc."-".$bd;
			$qr_sql = mysql_query("select a_id from tbl_news where (a_name_en_no = '$a_name_en_no') and (a_id <> '$a_id')");
			$sopt=@mysql_num_rows($qr_sql);
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
	
	if ($thanhcong){
		$a_name=inputdata($a_name);$a_name_en=inputdata($a_name_en);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$a_des=inputdata($a_des);$a_des_en=inputdata($a_des_en);$meta_key=inputdata($meta_key);$a_ghichu=inputdata($a_ghichu);$a_ghichu_en=inputdata($a_ghichu_en);
		$query="update tbl_news set a_name='$a_name',a_name_no = '$a_name_no',a_des='$a_des',a_gioithieu='$a_gioithieu',a_name_en='$a_name_en',a_name_en_no='$a_name_en_no'
		,meta_key='$meta_key',a_gioithieu_en='$a_gioithieu_en',a_des_en='$a_des_en',a_ghichu='$a_ghichu',a_ghichu_en='$a_ghichu_en'";
		if ($_FILES['picfile']['name']) {
			@unlink("../multidata/$a_pic");
			$query.=" ,a_pic='$pic_name'";
		}
		
		$query.=",c_id='$c_id' where a_id='$a_id'";
		
		$upd = mysql_query($query);
		echo "<script>
					alert('Đã sửa thành công.');
					location.href='mana_news.php?bs=$bs&pz=$pz';
			</script>";
	}
}
?>
<form name="FormName"  onSubmit="return CheckFormRegWebsite();" action="edit_news.php?action=check" method="post" enctype="multipart/form-data">
<h1><?=$lb_tieude?></h1>
<ul>
<li>Tiêu đề VN<right><input name="a_name" value="<?=$a_name?>"/></right></li>
<li>Tiêu đề EN<right><input name="a_name_en" value="<?=$a_name_en?>"/></right></li>
<? if(($skind<=3)||($skind==6)){ ?>
<li>Danh mục<right><select name='c_id'><?
	$qr_catadv=mysql_query("select * from tbl_cata where c_kind='$skind' order by c_sort, c_id");
	while ($rows=mysql_fetch_array($qr_catadv)){
	$c_id1=$rows[c_id];
	$c_name=trim($rows[c_name]);
	if($c_id==$c_id1) echo "<option value='$c_id1' selected>$c_name</option>";else echo "<option value='$c_id1'>$c_name</option>";
	}
	?></select>
</right></li>
<? }else{?>
<li>Ghi chú VN<right><input name="a_ghichu" value="<?=$a_ghichu?>"/></right></li>
<li>Ghi chú EN<right><input name="a_ghichu_en" value="<?=$a_ghichu_en?>"/></right></li>
<? }?>
<? if($skind!=7){ ?>
<? if($a_pic){?><li>Hình cũ<right><?=$str_pic?></right></li><? }?>
	<li>Hình mới<right><input name="picfile" type="file" value="" /><br /><? if($skind==4) echo "Max-Width x Max-Height: 150px x 150px"; elseif($skind==5) echo "Max-Width x Max-Height: 200px x 200px"; else  echo "Width: 270px"; ?></right></li>
<? }?>
<li>Giới thiệu VN<right><textarea name="a_gioithieu" rows="5"><?=$a_gioithieu?></textarea></right></li>
<li>Giới thiệu EN<right><textarea name="a_gioithieu_en" rows="5"><?=$a_gioithieu_en?></textarea></right></li>
<li>Nội dung VN<right><textarea name="a_des" id="a_des" rows="20"><?=$a_des?></textarea></right></li>
<li>Nội dung EN<right><textarea name="a_des_en" id="a_des_en" rows="20"><?=$a_des_en?></textarea></right></li>
<li>Content Meta Tag<right ><textarea name="meta_key" rows="3"><?=$meta_key?></textarea></right></li>
<li><a onClick="history.go(-1)" class="blue">Back</a><right><input name="dangky" type="submit" class="submit" value="Sửa"/></right></li>
</ul>
<input type=hidden name='pz' value='<?=$pz?>'>
<input type=hidden name='bs' value='<?=$bs?>'>
<input type=hidden name='a_id' value='<?=$a_id?>'>
<input type=hidden name='a_pic' value='<?=$a_pic?>'>
</form>
</body>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('a_des');CKEDITOR.replace('a_des_en');
</script>