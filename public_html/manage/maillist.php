<?
include("check.php");
include("../config/config.php");
include("../config/sql.php");
include_once('../func.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
		function is_email_valid($email) { 
		  if(eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) return TRUE; 
		  else return FALSE; 
		}
		if($submitbutton){
				$bodyhell = "$noidungthongtincangoi ";
				$bodyhell = str_replace("\'","'",$bodyhell);
				if(!is_email_valid($email)) {echo"Email không đúng" ; exit();}
				
				$subject = $tieude;

				$from="\"$tengoi\" <$email>";
				$headers="Content-Type: text/html; charset=utf-8\n";
				$headers.="From: $from\nX-Mailer: System33r";
				$k=0;
				if ($kinduser==1) $counter=mysql_query("select * from tb_nhanquangcao where (id in($str_dssendmail))");
				else $counter=mysql_query("select * from tb_nhanquangcao");
					while($countmail = mysql_fetch_array($counter)){
					$toemail = $countmail['email'];
					$body = utf_to_iso($bodyhell);
					$sender = sendsmtpmail(strip_unicode($tengoi),$email,$toemail,"",$subject,$body);
					//@mail($toemail,$subject,$bodyhell,$headers);
					echo $toemail." -\\- ";			
					flush(); 
					usleep(500);
					$k++;
				}
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><br><b>Đã gửi ".$k." emails</b>";
				exit();		
		}	
?>		
<form action="maillist.php" method="POST">
<h1>Gửi email</h1>
<u>
<li>Người gửi<right> <input type="text" name="tengoi" value="<?=$ten_admin_trang_web?>"></right></li>
<li>Địa chỉ Email<right><input name="email" type="text" value="<?=$dia_chi_mail_admin?>" /></right></li>
<li>Tiêu đề<right><input name="tieude" type="text" value="" /></right></li>
<li>Nội dung<right><textarea name="noidungthongtincangoi" rows="3"></textarea></right></li>
<li><right><input name="submitbutton" type="submit" class="submit" value="Gửi" /></right></li>
</ul>
 <input type="hidden" name="kinduser" value="<?=$kinduser?>" />
  <input type="hidden" name="str_dssendmail" value="<?=$str_dssendmail?>" />
</form>
</body>
</html>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('noidungthongtincangoi');
</script>