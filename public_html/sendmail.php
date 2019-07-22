<? @session_start();
include("allhead.php");
include("func.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if($faqsubmit){
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $s_fullname<$s_email>\r\n";
	$subject="Gui cau hoi - $dia_chi_trang_web";
	$body="<p><strong>Title</strong><br>$s_tieude
	<p><strong>Fullname</strong><br>$s_fullname
	<p><strong>Address</strong><br>$s_address
	<p><strong>Email</strong><br>$s_email
	<p><strong>Phone</strong><br>$s_dienthoai
	<p><strong>Question</strong><br>$s_message";
	$irand=$_SESSION["session_sendmail_irand_guicauhoi"];
	if ($irand==$mabaove){	
		if(($s_fullname)&&($s_address) &&($s_email) &&($s_dienthoai)&&($s_message)){
			$body = utf_to_iso($body);
			$sender = sendsmtpmail(strip_unicode($s_fullname),$email,$dia_chi_mail_admin,$ten_admin_trang_web,$subject,$body);
		}
	}
	
	$irand=rand(10000,999999);
	$_SESSION["session_sendmail_irand_guicauhoi"]=$irand;
	echo "<script language=javascript>alert('$lb_guicauhoi_ok');location='$sub_root';</script>";
}else{
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $s_fullname<$s_email>\r\n";
	$subject="Contact us - $dia_chi_trang_web";
	$body="<p><strong>Fullname</strong><br>$s_fullname
	<p><strong>Address</strong><br>$s_address
	<p><strong>Email</strong><br>$s_email
	<p><strong>Phone</strong><br>$s_dienthoai
	<p><strong>Message</strong><br>$s_message";
	$irand=$_SESSION["session_sendmail_irand_contact"];
	if ($irand==$mabaove){	
		if(($s_fullname)&&($s_address) &&($s_email) &&($s_dienthoai)&&($s_message)){
			$body = utf_to_iso($body);
			$sender = sendsmtpmail(strip_unicode($s_fullname),$email,$dia_chi_mail_admin,$ten_admin_trang_web,$subject,$body);
		}
	}
	
	$irand=rand(10000,999999);
	$_SESSION["session_sendmail_irand_contact"]=$irand;
	echo "<script language=javascript>alert('$lb_lienhe_ok');location='$sub_root';</script>";
}
echo "<script language=javascript>location='$sub_root';</script>";
?>