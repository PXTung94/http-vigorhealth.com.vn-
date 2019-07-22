<? @session_start();?>
<!DOCTYPE HTML>
<html lang="en">
    <? include("allhead.php"); ?>
<head>
<meta name="google-site-verification" content="cZ7W0b7w1e5jtLQyi7xI8NJw9yxlNuBnqgWWHdyfQ7o" />
<meta charset="UTF-8">
<? include("page-meta.php");?>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/style218.css"/>
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/jquery.onebyone.css"/>
<link rel="stylesheet" type="text/css" href="<?=$sub_root?>/css/animate.css"/>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.carouFredSel.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?=$sub_root?>/js/jquery.onebyone.min.js"></script>



<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1286956864682241');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1286956864682241&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<!-- Google Tag Manager cua nha cung cap -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T3TTBSW');</script>
<!-- End Google Tag Manager -->

<script type="text/javascript" src="<?=$sub_root?>/js/script218.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110374928-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
 
  gtag('config', 'UA-110374928-1');
</script>
<!--
<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'vigorhealth.com.vn'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var refferer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//vigorhealth.com.vn/lhc_web/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+refferer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
-->
</head>
<body>

    <!-- Google Tag Manager (noscript) cua nha cung cap-->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3TTBSW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<div id="container">
		<?php
				if ($_GET["page"]=="page-demo1")
				{
					include "page-demo1.php";
				}
				else {
			?>
		<?php include "header.php";?>
		
			<div class="pagewrap">
				<?php
					if (isset($_GET["page"]))
					{
						$page=$_GET["page"];
						$page.=".php";
						if($page=="index.php")
						$page="page-home.php";
						$page = str_replace("http","XXX",$page);
						$page = str_replace("https","XXX",$page);
						$page = str_replace("ftp","XXX",$page);
						$page = str_replace("ftps","XXX",$page);
						
						if (is_file($page)){
							
							include $page;
						}
						else echo "<div class='construction'>Under Construction</div>";
					}
					else 
						include "page-home.php";
				?>
				<div id="colLeft">
					<?php include "left-column.php";?>
				</div><!--end colLeft-->
				<div class="clr"></div>
			</div><!--end pagewra`p-->
		
		<? 
$FX_DataCounter=$_SESSION["session_FX_DataCounter"];
if(!$FX_DataCounter) {
	$sql_visited = mysql_query("SELECT * FROM tbl_visited");
	if(@mysql_num_rows($sql_visited)){
		$visited = @mysql_result($sql_visited,0,'visited');
		$visited=$visited+1;
		mysql_query("UPDATE tbl_visited SET visited='$visited'"); 
	}else{
		$visited=1;
		mysql_query("INSERT INTO tbl_visited(visited) VALUES ('$visited')"); 
	}
	$_SESSION["session_FX_DataCounter"]=$visited;
}else{
	$sql_visited = mysql_query("SELECT * FROM tbl_visited");
	$visited = @mysql_result($sql_visited,0,'visited');
	$_SESSION["session_FX_DataCounter"]=$visited;
}
$table="visitorsonline";
$SID = session_id();$time = time();$dag = date("z");$nu = time()-300; 
$sidcheck = mysql_query("SELECT count(*) FROM $table WHERE SID='$SID'");
$sid_check = mysql_result($sidcheck,0);
if ($sid_check == "0") {
	mysql_query("INSERT INTO $table VALUES ('$SID','$time','$dag')"); 
} else { 
	mysql_query("UPDATE $table SET time='$time' WHERE SID='$SID'"); 
}
$count_users = mysql_query("SELECT count(*) FROM $table WHERE time>$nu AND day=$dag");
$users_online = mysql_result($count_users,0);
mysql_query("DELETE FROM $table WHERE time<$nu");
mysql_query("DELETE FROM $table WHERE day != $dag");
?>
        <div id="footerMain">
        	<div id="footer" class="pagewrap">
            	<ul><? $kind=28;$qr=mysql_query("select * from tbl_page where kind='$kind'");
		if (@mysql_num_rows($qr)){if($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en')); else echo outputdata(@mysql_result($qr,0,'content'));}?></ul>
            	<li>© <?=$lb_banquyen?></li>
            	<li class="right"><?=$lb_viengtham?>: <? echo $_SESSION["session_FX_DataCounter"]; ?> | <?=$lb_dangxem?>: <?=$users_online?></li>
                <div class="clr"></div>
            </div>
        </div><!--end footerMain-->       
        <div class="cr"></div>
    </div><!--end container-->
    <div id="backTop"><?=$lb_top?></div>
    <div id="copyright"><a href="http://vigorhealth.com.vn" target="_blank" title="thiet ke web, thiết kế web">Phòng Công Nghệ Thông Tin</a> <a href="http://vigorhealth.com.vn" title="VigorHealth">VigorHealth</a></div>
    <?php } ?>
 
<div style>
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "691508844258108", // Facebook page ID
            call_to_action: "Chát Facebook", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
    
    
  
</body>

<script>
	$( document ).ready(function() {		
		$("#CallButton").attr("href", "tel:19001856");		
	});
</script>
</html>