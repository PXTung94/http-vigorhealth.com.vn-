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
</head>
<body>
<?
if($tion=="save")
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
			echo "<script>alert('Tên tiêu đề VN phải là chuổi !');</script>";
		}
	}
	if($thanhcong) {
		$c_name_no=RemoveSign($c_name);
		$qr_sql = mysql_query("select c_id from tbl_cata where c_name_no = '$c_name_no'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu đề VN đã tồn tại !');</script>";
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
			echo "<script>alert('Tên tiêu đề EN phải là chuổi !');</script>";
		}
	}
	if($thanhcong) {
		$c_name_en_no=RemoveSign($c_name_en);
		$qr_sql = mysql_query("select c_id from tbl_cata where c_name_en_no = '$c_name_en_no'");
		if (@mysql_num_rows($qr_sql)){
			$thanhcong=0;
			echo "<script>alert('Tên tiêu đề EN đã tồn tại !');</script>";
		}
	}
	
	if ($thanhcong){
		$meta_key=inputdata($meta_key);
		$query = mysql_query("insert into tbl_cata(c_name,c_name_no,meta_key,c_of,c_kind,c_name_en,c_name_en_no) 
		values ('$c_name','$c_name_no','$meta_key','$active','$skind','$c_name_en','$c_name_en_no')");
		echo "<script>
				alert('Nhập đã thành công !');
					location.href='add_cata.php';
				</script>";
		exit();
	}
}
$addcat=<<<EOF
<h1>Nhập Danh mục ($lb_tieude)</h1>
<form action="$PHP_SELF?act=addcat&tion=save" method="post">
	<ul>
		<li>Tên danh mục VN<right><input type=text name="c_name" value="$c_name"></right></li>
		<li>Tên danh mục EN<right><input type=text name="c_name_en" value="$c_name_en"></right></li>
		
		<li>Content Meta Tag<right ><textarea name="meta_key" rows="3">$meta_key</textarea></right></li>
		<li>Hiển thị/Ẩn<right><input name="active" type="radio" value="1" checked style="width:auto"> Hiển thị <input name="active" type="radio" value="0" style="width:auto"> Ẩn</right></li>
		<li><right><input type="submit" value="Nhập Danh mục" class="submit"></right></li>
	</ul>
</form>
EOF;
echo $addcat;
?>
</body>
</html>