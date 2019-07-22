<? @session_start();?>
<!DOCTYPE HTML>
<html lang="en">
<? include("allhead.php"); ?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/login.css"/>
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/form.css"/>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.form.js" ></script>
<script language="javascript">
	$(function(){$('.left').jqTransform({imgPath:'<?=$sub_image?>/form/'});})
</script>
</head>
<body>
	<title>Đăng nhập</title>
    <div id="container">
		<div id="loginMain">
	    	<div id="login">
	        	<form action="http://healthcare.com.vn/report/login.php" method="post" name="FormLogin" id="FormLogin">
	            	<div id="top">
	                	<a href="<?=$sub_root?>" id="logo"><img src="<?=$sub_image?>/logo.png" width="190" height="100" alt=""></a>
	                	<h1><?=$lb_login_xemhoso?></h1>
	                    <div class="clr"></div>
	                </div><!--end top-->
	                <div id="main">
	                	<div id="content">
	                    	<li><span>ID:</span><input name="id" type="text"><div class="clr"></div></li>
	                    	<li><span><?=$lb_matkhau?>:</span><input name="password" type="password"><div class="clr"></div></li>
	                    	<li><span>&nbsp;</span><a onclick="FormLogin.submit()"  style="cursor:pointer"class="butLog"><label><?=$lb_dangnhap?></label></a><div class="clr"></div></li>
	                    </div><!--end content-->
	                   
                        <div class="clr"></div>
	                </div><!--end main-->
	                <div id="bottom">
	                	<div class="left">&nbsp;</div>
	                    <a href="<?=$sub_root?>" class="back"><label><?=$lb_trangchu?></label></a>
	                </div>
                    <div class="clr"></div>
	            </form>
	        </div><!--end login-->
	    </div><!--end loginMain-->
	    <div id="footerMain">
	        <div id="footer"><li>© <?=$lb_banquyen?></li></div>
	    </div><!--end footerMain-->
    </div><!--end container-->
</body>
</html>