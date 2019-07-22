<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
if($skind) $_SESSION["session_skind_admin"]=$skind; else $skind=$_SESSION["session_skind_admin"]; $lb_tieude ="Nhập ".$array_page[$skind];
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
	$a_name=trim($a_name);
	if(is_numeric($a_name)){
		$thanhcong=0;
		echo "<script>alert('Tiêu đề VN phải là chuỗi !');</script>";
	}
	if ($thanhcong){
		$a_name_no=RemoveSign($a_name);$bd=0;$a_name_no_goc=$a_name_no;
		$qr_sql = mysql_query("select a_id from tbl_news where (a_name_no = '$a_name_no')");
		$sopt=@mysql_num_rows($qr_sql);
		while($sopt){
			$bd++;
			$a_name_no=$a_name_no_goc."-".$bd;
			$qr_sql = mysql_query("select a_id from tbl_news where (a_name_no = '$a_name_no')");
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
		$qr_sql = mysql_query("select a_id from tbl_news where (a_name_en_no = '$a_name_en_no')");
		$sopt=@mysql_num_rows($qr_sql);
		while($sopt){
			$bd++;
			$a_name_en_no=$a_name_en_no_goc."-".$bd;
			$qr_sql = mysql_query("select a_id from tbl_news where (a_name_en_no = '$a_name_en_no')");
			$sopt=@mysql_num_rows($qr_sql);
		}
	}
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
		$thoigiandk=date("YmdHis");$a_name=inputdata($a_name);$a_name_en=inputdata($a_name_en);$a_gioithieu=inputdata($a_gioithieu);$a_gioithieu_en=inputdata($a_gioithieu_en);
		$a_des=inputdata($a_des);$a_des_en=inputdata($a_des_en);$meta_key=inputdata($meta_key);$a_ghichu=inputdata($a_ghichu);$a_ghichu_en=inputdata($a_ghichu_en);
		$query="insert into tbl_news(a_name,a_name_no,a_gioithieu,a_des,a_of,a_pic,a_date,a_name_en,a_name_en_no,meta_key,c_kind,c_id,a_gioithieu_en,a_des_en,a_ghichu,a_ghichu_en) 
		VALUES('$a_name','$a_name_no','$a_gioithieu','$a_des','1','$pic_name','$thoigiandk','$a_name_en','$a_name_en_no','$meta_key','$skind','$c_id'
		,'$a_gioithieu_en','$a_des_en','$a_ghichu','$a_ghichu_en')";
		$upd = mysql_query($query);
		$q = mysql_query("select a_id from tbl_news where a_date='$thoigiandk' order by  a_id desc limit 0,1");
		$a_id=@mysql_result($q,0,'a_id');
		for ($i=0;$i<20;$i++){
			$k=$i+1;
			$pic_namex=upload_image('hinhanhxengiua',$k,0,0,0);
			if(!@is_numeric($pic_namex))$in_pic=mysql_query("insert into tb_hinhgiuatin(a_id,n_vitri,p_pic) VALUES('$a_id','$k','$pic_namex')");
		}		
		echo "<script>
					alert('Đã nhập thành công.');
					location.href='add_news.php';
			</script>";
		exit();
	}
}
?>
<form name="FormName"  onSubmit="return CheckFormAdd();" action="add_news.php?action=check" method="post" enctype="multipart/form-data">
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
<li>Hình<right><input name="picfile" type="file" value="" /><br /><? if($skind==4) echo "Max-Width x Max-Height: 150px x 150px"; elseif($skind==5) echo "Max-Width x Max-Height: 200px x 200px"; else  echo "Width: 270px"; ?></right></li>
<? }?>
<li>Giới thiệu VN<right><textarea name="a_gioithieu" rows="3"><?=$a_gioithieu?></textarea></right></li>
<li>Giới thiệu EN<right><textarea name="a_gioithieu_en" rows="3"><?=$a_gioithieu_en?></textarea></right></li>
<li>Nội dung VN<right><textarea name="a_des" id="a_des" rows="20"><?=$a_des?></textarea></right></li>
<li>Nội dung EN<right><textarea name="a_des_en" id="a_des_en" rows="20"><?=$a_des_en?></textarea></right></li>
<li>Content Meta Tag<right ><textarea name="meta_key" rows="3"><?=$meta_key?></textarea></right></li>
<li><right><input name="dangky" type="submit" class="submit" value="Nhập" /></right></li>
<li><strong>Hình giữa nội dung</strong><right>&nbsp;</right></li>
<? for ($i=0;$i<10;$i++){
$k=$i+1;
echo "<li>Nhãn {{image$k}}<right><input name='hinhanhxengiua[]' type='file' value=''/></right></li>";}?>
<li><right><input name="dangky" type="submit" class="submit" value="Nhập" /></right></li>
</ul>
</form>
</body>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('a_des');CKEDITOR.replace('a_des_en');
</script>