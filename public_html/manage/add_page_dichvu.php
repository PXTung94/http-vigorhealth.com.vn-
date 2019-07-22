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
<?
if($tion=="save")
{
	$ok=0;$k=0;
	foreach ($page_name_arr as  $page_name){
		$page_name=trim($page_name);
		$page_name_en=$page_name_arr_en[$k];
		if(($page_name)&&($page_name_en)){
			$page_name_no=RemoveSign($page_name);$page_name_en_no=RemoveSign($page_name_en);
			$page_name_no_goc=$page_name_no;$page_name_en_no_goc=$page_name_en_no;
			
			$sql_qr = mysql_query("select page_name from tbl_pagename_dichvu where (page_name_no='$page_name_no')");
			$sodong=@mysql_num_rows($sql_qr);$i=0;
			while($sodong){
				$i++;
				$page_name_no=$page_name_no_goc."-".$i;
				$sql_qr = mysql_query("select page_name from tbl_pagename_dichvu where (page_name_no='$page_name_no')");
				$sodong=@mysql_num_rows($sql_qr);
			}
			
			$sql_qr = mysql_query("select page_name from tbl_pagename_dichvu where (page_name_en_no='$page_name_en_no')");
			$sodong=@mysql_num_rows($sql_qr);$i=0;
			while($sodong){
				$i++;
				$page_name_en_no=$page_name_en_no_goc."-".$i;
				$sql_qr = mysql_query("select page_name from tbl_pagename_dichvu where (page_name_en_no='$page_name_en_no')");
				$sodong=@mysql_num_rows($sql_qr);
			}
			$query = mysql_query("insert into tbl_pagename_dichvu(page_name,page_name_no,page_of,page_name_en,page_name_en_no,page_parent) values 
			('$page_name','$page_name_no','$active','$page_name_en','$page_name_en_no','$page_parent')");
			$ok=1;
		}
		$k++;
	}
		if($ok){
			echo "<script>alert('Nhập thành công!');</script>";
		}
		echo "<script>location.href='add_page_dichvu.php?page_parent=$page_parent';</script>";
		
		exit();
	//}
}
$str_collection="<select name='page_parent'><option value='0' selected>Chọn danh mục</option>";
$sql_level_cata = mysql_query("select  * from tbl_pagename_dichvu where page_parent=0 order by page_sort,page_id");
while($rowscata = mysql_fetch_array($sql_level_cata)){
	$cid  = $rowscata[page_id];
	$page_name = trim($rowscata[page_name]);
	$page_name_en = trim($rowscata[page_name_en]);
	if($cid == $page_parent) $str_collection.= "<option value='$cid' selected>$page_name / $page_name_en</option>";
	else $str_collection.= "<option value='$cid'>$page_name / $page_name_en</option>";
}
$str_collection.= "</select>";
$str_name="";
for($i=1;$i<=5;$i++) 
	$str_name.="<li>Tên VN thứ $i<right><input type=text name='page_name_arr[]' value='' style='width:40%'>
	Tên EN thứ $i&nbsp;<input type=text name='page_name_arr_en[]' value='' style='width:40%'></right></li>";
/////////////
$addcat=<<<EOF
	<h1>Nhập Danh mục Dịch vụ</h1>
	<form action="$PHP_SELF?act=addcat&tion=save" method="post">
		<ul>
			<li>Danh mục<right>$str_collection</li>
			$str_name
			<li>Hiển thị/Ẩn<right><input name="active" type="radio" value="1" checked style="width:auto"> Hiển thị <input name="active" type="radio" value="0" style="width:auto"> Ẩn</li>
			<li><right><input type="submit" class="submit" value="Nhập Danh mục"></right></li>
		</ul>
	</form>
EOF;
echo $addcat;
?>
</body>
</html>