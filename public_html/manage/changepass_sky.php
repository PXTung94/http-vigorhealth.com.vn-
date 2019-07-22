<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style218.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){$(window).resize(function(){$('#mainlblock').css({position:'absolute',left:($(window).width()-$('#mainlblock').outerWidth())/2,top:($(window).height()-$('#mainlblock').outerHeight())/2});});$(window).resize();});var is={ie:navigator.appName=='Microsoft Internet Explorer',java:navigator.javaEnabled(),ns:navigator.appName=='Netscape',ua:navigator.userAgent.toLowerCase(),version:parseFloat(navigator.appVersion.substr(21))||parseFloat(navigator.appVersion),win:navigator.platform=='Win32'}
is.mac=is.ua.indexOf('mac')>=0;if(is.ua.indexOf('opera')>=0){is.ie=is.ns=false;is.opera=true;}
if(is.ua.indexOf('gecko')>=0){is.ie=is.ns=false;is.gecko=true;}
</script>
<?
 if ($submit) {
	$skyadmin=$_SESSION["session_vigor_admin"];
	$username=trim($username);
	$password=md5(trim($password));	
	$qrup=mysql_query("update tbl_admin set ad_user='$username',ad_pass='$password' where ad_id='$skyadmin'");
	echo "<script>alert(\"Successful change password!\");window.top.location.href='index.html';</script>";
	exit();
}
?>				
<title>Change Password</title>
</head>
<body>
<form name="form1" method="post" action="changepass_sky.php">
<div id="mainlblock">
	<div id="content">        
        <p><h1>Change Password</h1>
        
        <p>New Username<br />
        <input name="username" type="text">
                
        <p>New Password<br />
        <input name="password" type="password">

        <p>Re Enter New Password<br />
        <input name="password" type="password">
        
        <p><input name="submit" type="submit" class="submit" value="Change Password">
        
        <p>Can not Change Your Password ?<br />
        Please <a href="email:his@vigorhealth.com.vn" target="_blank">Contact us </a> or call <strong>0936 797 410</strong> for assistance.
    </div>
</div>
</form>
</body>
</html>