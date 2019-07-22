<? include("check.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin: 0px;
	padding: 0px;
	font-size:15px;
	font-family: Arial, Helvetica, sans-serif;
	background-image: url(images/bg.jpg);
	color:#000;
}
* {
	margin: 0px;
	padding: 0px;
	outline: none;
	list-style: none;
	text-decoration: none;
	font-size:15px;
	font-family: Arial, Helvetica, sans-serif;
	color:#000;
}
h1 {
	font-size: 20px;
	float:left;
	padding: 8px 0 0 15px;
	color:#FFF;
}
span{
	float:right;
	padding: 11px 15px 0 0;
}
.blue {
	width:auto;
	padding:4px 10px;
	font-size:13px;
	color: rgba(255,255,255,1);
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
	border-radius: 100px;
	text-decoration:none;
	margin:2px;
	cursor: pointer;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.4);
	box-shadow: 0 1px 2px rgba(0,0,0,.4);
	border: solid 1px #0076a3;
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}
.blue:hover {
	color: rgba(255,255,0,1);
	text-decoration:none;
	background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
	background: -moz-linear-gradient(top,  #0095cc,  #00678e);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
}
.blue:active {
	color: rgba(255,255,0,.5);
	position: relative;
	top: 1px;
	background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
	background: -moz-linear-gradient(top,  #0078a5,  #00adee);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}
#top{
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
	position:relative;
	width:100%;
	height:40px;
	}
</style>
<body>
<div id="top">
    <h1>VIGOR</h1>
    <span><a href=".." class="blue" target="_blank">Trang chủ</a><a href="changepass_sky.php" target="main" class="blue">Thay đổi mật khẩu</a><a href="check.php?action=logout" class="blue">Logout</a></span>
</div>
</body>
</html>