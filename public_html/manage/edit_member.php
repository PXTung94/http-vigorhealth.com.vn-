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
if($tion=="save"){
	$thanhcong=1;
	$d_password=trim($d_password);
	if(($thanhcong)&&($d_password)){
		if (strlen(trim($d_password))<4) {
			$thanhcong=0;
				echo "<script>
						alert(\"Mật khẩu ít nhất phải là 4 ký tự.\");
					</script>";
		}
	}
	if($thanhcong){
		$checkuser = mysql_query("select d_email from date_user where d_email='$d_email' and d_userid <>'$d_userid'");
		$u = @mysql_result($checkuser,0,"d_email");
		if ($u){
			$thanhcong=0;
			echo "<script>
				alert(\"Địa chỉ email đã được đăng ký. \");
			</script>";
		}
	}
	
		
	if($thanhcong){
		$d_fullname=inputdata($d_fullname);
		$d_address=inputdata($d_address);
		$d_comment=inputdata($d_comment);
		$query="update  date_user set d_fullname='$d_fullname',d_address='$d_address',d_phone='$d_phone',d_email='$d_email' ";
		
		if($d_password){
			$d_password_md5=md5($d_password);
			$query.=",d_password='$d_password_md5'";
		}
		
		$query.="where d_userid='$d_userid'";
		$sql = mysql_query($query);	
		echo"<script>
			alert('Đã sửa xong.');
			location.href='mana_member.php?pz=$pz&bs=$bs';
		</script>";
		exit();
	}
}else{
	if($edit){
		$d_userid=$edit;
		$sql =mysql_query("select * from date_user where d_userid='$d_userid'");
		$rows=@mysql_fetch_array($sql);
		$d_fullname=outputdata_input($rows['d_fullname']);
		$d_phone=trim($rows['d_phone']);
		$d_email=trim($rows['d_email']);
		$d_address=outputdata_input($rows['d_address']);
		$d_username = $rows[d_username];
	}
}
?>
<form  action="edit_member.php?act=addcat&tion=save" method="post" name='FormUpdate'  onsubmit="return CheckFormMailUpdate();">
<h2>Thay đổi thông tin khách hàng</h2>
<ul>
<li>Họ tên<span><input name="d_fullname" value="<?=$d_fullname?>"/></span></li>
<li>Email<span><input name="d_email" value="<?=$d_email?>"/></span></li>
<li>Địa chỉ<span><input name="d_address" value="<?=$d_address?>"/></span></li>
<li>Điện thoại<span><input name="d_phone" value="<?=$d_phone?>"/></span></li>
<li>Tên đăng nhập<span><input name="d_username" value="<?=$d_username?>" readonly=""/></span></li>
<li>Mật khẩu<span><input name="d_password" value=""/><br />Để trống nếu không thay đổi Mật khẩu </span></li>
<li><a onClick="history.go(-1)" class="blue">Back</a><span><input name="dangky" type="submit" class="submit" value="Sửa"/></span></li>
</ul>
<input type=hidden name='pz' value='<?=$pz?>'>
<input type=hidden name='bs' value='<?=$bs?>'>
<input type=hidden name='d_userid' value='<?=$d_userid?>'>
</form>
</body>
</html>
<script language="javascript">
	function CheckFormMailUpdate(){
		with(document.FormUpdate){
			if(d_fullname.value == ""){
				alert('Bạn phải nhập họ tên vào !');
				d_fullname.focus();
				return false;
			}
			
			if (d_email.value==""){
					alert("Bạn phải nhập địa chỉ email vào !");
					d_email.focus();
					return false;
			}else{
				if(d_email.value.indexOf("@")<0||d_email.value.indexOf(".")<0){
					alert("Địa chỉ email không chính xác !");
					d_email.focus();
					return false;
				}
			}		
			
			if(d_phone.value == ""){
				alert('Bạn phải nhập số điện thoại vào')
				d_phone.focus()
				return false
			}
			if(d_address.value == ""){
				alert('Bạn phải nhập địa chỉ vào !');
				d_address.focus();
				return false;
			}
			
		}
	 return true;
}
</script>