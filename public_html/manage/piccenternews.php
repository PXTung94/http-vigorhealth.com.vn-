<? include("check.php"); 
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
if($submit){
	for ($i=0;$i<20;$i++){
		$k=$i+1;
		$pic_namex=upload_image('hinhanhxengiua',$k,0,0,0);
		if(!@is_numeric($pic_namex)){
			$del_pic=mysql_query("delete from tb_hinhgiuatin where n_vitri='$k' and a_id='$a_id'");
			$in_pic=mysql_query("insert into tb_hinhgiuatin(a_id,n_vitri,p_pic) VALUES('$a_id','$k','$pic_namex')");
		}
	}	
	
		echo "<script>
				alert('Đã cập nhật thành công!');
				location.href='piccenternews.php?a_id=$a_id&bs=$bs&pz=$pz';
			</script>";
			exit();
 }
 if($delit){
	$nam = mysql_query("select p_hinhanh from tb_hinhgiuatin  where id='$delit' and a_id='$a_id'");
	$namepic = @mysql_result($nam,0,"p_pic");
	@unlink("../multidata/$namepic");
	$dele = mysql_query("delete from tb_hinhgiuatin where id='$delit' and a_id='$a_id'");
}
?>
<h1>Hình giữa nội dung tin</h1>
<form  action="piccenternews.php?a_id=<?=$a_id?>&bs=<?=$bs?>&pz=<?=$pz?>" method="post" enctype="multipart/form-data" name="formuploaddata">
<ul>
	<?
    for ($i=0;$i<20;$i++){
        $k=$i+1;
        $str_xoa="";
        $str_hinh="";
        $sql_picogiua = mysql_query("select * from tb_hinhgiuatin where a_id=$a_id and n_vitri=$k order by n_vitri");
        if (@mysql_num_rows($sql_picogiua)){
            $id=mysql_result($sql_picogiua,0,'id');
            $p_pic=mysql_result($sql_picogiua,0,'p_pic');
            $str_xoa="<a href='piccenternews.php?delit=$id&a_id=$a_id&bs=$bs&pz=$pz' class='blue'>Xóa</a>";
            $str_hinh="<a href='../multidata/$p_pic' target='_blank'><img src='../multidata/$p_pic' width='100' border='0'/></a>";
        }
        echo "<li>$str_hinh<right>Hình cho nhãn {{image$k}} $str_xoa<br /><input name='hinhanhxengiua[]' type='file' value=''></right></li>";}
	?>
    <li><a href="mana_news.php?pz=<?=$pz?>&bs=<?=$bs?>" class="blue">Back</a><right><input name="submit" type="submit" value="Cập nhật" class="submit"></right></li>
</ul>
 </form>
</body>
</html>