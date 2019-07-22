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
function Addpage()
{
  with (document.FormName)
      {
		if (page_name.value==""){
		       alert("Nhập tên VN vào !");
               page_name.focus();
               return false;
        }
		if (page_name_en.value==""){
		       alert("Nhập tên EN vào !");
               page_name_en.focus();
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
	$sql_qr=mysql_query("select * from tbl_pagename_ctrinh where page_id='$edit'");
			$page_id=$edit;
			$rows = mysql_fetch_array($sql_qr);
			$page_name = $rows[page_name];
			$page_name_en = $rows[page_name_en];
}
if($submit){
			$page_name_no=RemoveSign($page_name);$page_name_en_no=RemoveSign($page_name_en);
	
			$page_name_no_goc=$page_name_no;$page_name_en_no_goc=$page_name_en_no;
			
			$sql_qr = mysql_query("select page_name from tbl_pagename_ctrinh where (page_name_no='$page_name_no') and (page_id <>'$page_id')");
			$sodong=@mysql_num_rows($sql_qr);$i=0;
			while($sodong){
				$i++;
				$page_name_no=$page_name_no_goc."-".$i;
				$sql_qr = mysql_query("select page_name from tbl_pagename_ctrinh where (page_name_no='$page_name_no') and (page_id <>'$page_id')");
				$sodong=@mysql_num_rows($sql_qr);
			}
			
			$sql_qr = mysql_query("select page_name from tbl_pagename_ctrinh where (page_name_en_no='$page_name_en_no') and (page_id <>'$page_id')");
			$sodong=@mysql_num_rows($sql_qr);$i=0;
			while($sodong){
				$i++;
				$page_name_en_no=$page_name_en_no_goc."-".$i;
				$sql_qr = mysql_query("select page_name from tbl_pagename_ctrinh where (page_name_en_no='$page_name_en_no') and (page_id <>'$page_id')");
				$sodong=@mysql_num_rows($sql_qr);
			}
			$qr=mysql_query("update tbl_pagename_ctrinh set page_name='$page_name',page_name_no='$page_name_no' ,page_name_en='$page_name_en',
page_name_en_no='$page_name_en_no' where page_id='$page_id'");
			echo "<script>
					alert('Đã sửa xong !');
					location.href='mana_page_ctrinh.php?pz=$pz';
				</script>";
		exit();
}
$addform=<<<EOF
<h1>Sửa Danh mục Giới thiệu</h1>
<form name="FormName" action="$PHP_SELF?submit=add" method="POST"  onSubmit="return Addpage();">
<ul>
	<li>Tên VN<right><input type='text' name='page_name' value="$page_name"></right></li>
	<li>Tên EN<right><input type='text' name='page_name_en' value="$page_name_en"></right></li>
	<li><a onClick="history.go(-1)" class="blue">Back</a><right><input type="submit" name="submit" value="Sửa Danh mục" class="submit"></right></li>
	<input type='hidden' name='page_id' value="$page_id">
	<input type='hidden' name='pz' value="$pz">
</form>
EOF;
echo $addform;
?>
</body>
</html>