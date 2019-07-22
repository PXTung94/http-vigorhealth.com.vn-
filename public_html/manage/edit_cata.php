<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
if($skind) $_SESSION["session_skind_admin"]=$skind; else $skind=$_SESSION["session_skind_admin"]; $lb_tieude =$array_page[$skind];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function AddNews()
{
  with (document.FormName)
      {
		if (c_name.value==""){
		       alert("Nhập tiêu đề VN vào !");
               c_name.focus();
               return false;
        }
		if (c_name_en.value==""){
		       alert("Nhập tiêu đề EN vào !");
               c_name_en.focus();
               return false;
        }
		
   }
   return true;

}
</script>
</head>
<body>
<?
if ($edit){
	$sql_qr=mysql_query("select * from tbl_cata where c_id='$edit'");
			$c_id=$edit;
			$rows = mysql_fetch_array($sql_qr);
			$c_name = $rows[c_name];$c_name_en = $rows[c_name_en];$meta_key = outputdata_input($rows[meta_key]);
}
if($submit)
{
	$thanhcong=1;
	if ($thanhcong){
		if($c_name==""){
			$thanhcong=0;
			echo "<script>
				alert('Bạn phải nhập tiêu đề VN vào !');
			</script>";
		}
	}
	if($thanhcong) {
		if (@is_numeric($c_name)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu VN đề phải là chuổi !');</script>";
		}
	}
	if($thanhcong) {
		$c_name_no=RemoveSign($c_name);
		$qr_sql = mysql_query("select c_id from tbl_cata where c_name_no = '$c_name_no' and c_id <> '$c_id'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu VN đề đã tồn tại !');</script>";
		}
	}
	if ($thanhcong){
		if($c_name_en==""){
			$thanhcong=0;
			echo "<script>
				alert('Bạn phải nhập tiêu đề EN vào !');
			</script>";
		}
	}
	if($thanhcong) {
		if (@is_numeric($c_name_en)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu EN đề phải là chuổi !');</script>";
		}
	}
	if($thanhcong) {
		$c_name_en_no=RemoveSign($c_name_en);
		$qr_sql = mysql_query("select c_id from tbl_cata where c_name_en_no = '$c_name_en_no' and c_id <> '$c_id'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu EN đề đã tồn tại !');</script>";
		}
	}
	if($thanhcong) {
		$meta_key=inputdata($meta_key);
		$qr=mysql_query("update tbl_cata set c_name='$c_name',c_name_no='$c_name_no',c_name_en='$c_name_en',c_name_en_no='$c_name_en_no',meta_key='$meta_key' where c_id='$c_id'");
		echo "<script>
					alert('Đã sửa thành công !');
					location.href='mana_cata.php';
				</script>";
		exit();
	}
}
$addform=<<<EOF
<h1>Sửa Danh mục ($lb_tieude)</h1>
<form name="FormName" action="$PHP_SELF?submit=add" method="POST"  onSubmit="return AddNews();">
<ul>
	<li>Tên danh mục VN<right><input type='text' name='c_name' value="$c_name"></right></li>
	<li>Tên danh mục EN<right><input type='text' name='c_name_en' value="$c_name_en"></right></li>
	<li>Content Meta Tag<right ><textarea name="meta_key" rows="3">$meta_key</textarea></right></li>
	<li><a onClick="history.go(-1)" class="blue">Back</a><right><input type="submit" name="submit" value="Sửa Danh mục" class="submit"></right></li>
	<input type='hidden' name='c_id' value="$c_id">
</ul>
</form>
EOF;
echo $addform;
?>
</body>
</html>