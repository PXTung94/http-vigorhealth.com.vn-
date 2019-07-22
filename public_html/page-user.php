<? include("allhead.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
if($action=="nhanmail")	{
	if ($loaidangky=="dangky"){
		$sqln = mysql_query("select email from tb_nhanquangcao where email='$emailnhanqc'");
		if (@mysql_num_rows($sqln)){
			echo"<script>
					alert(\"$lb_diachi_dadangky\");
					location.href='$sub_root';
				</script>";
			exit();
	
		}else {
				$sqln = mysql_query("insert into tb_nhanquangcao(email) VALUES('$emailnhanqc')");
				echo"<script>
						alert(\"$lb_dangky_thanhcong\");
						location.href='$sub_root';
					</script>";	
				exit();
			}
	}else{
			$sqln = mysql_query("delete from tb_nhanquangcao where email='$emailnhanqc'");
			echo"<script>
						alert(\"$lb_gobo_ok\");
						location.href='$sub_root';
					</script>";
				exit();
		}
				
}
?>