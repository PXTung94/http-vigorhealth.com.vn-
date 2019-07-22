<? include("check.php");
include("../config/config.php");
include("../config/sql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin: 0;
	padding: 0px;
	font-size:15px;
	line-height:20px;
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
	line-height:20px;
	font-family: Arial, Helvetica, sans-serif;
	color:#000;
}
#bg-left {
	width:230px;
	padding:15px;
	height:100%;
	background-image: url(images/bg-left.jpg);
	box-shadow: 2px 0px 4px rgba(0,0,0,.5);
}
.accordion {
	width:100%;
	padding-bottom:15px;
}
.accordion ul {
	display: none;
	background: #FFF;
}
.accordion ul li a{
	display: block;
	color:#000;
}
.accordion ul li{
	padding: 8px 10px 8px 24px;
	margin-bottom:1px;
	background: #A9A9A9 url('images/arrow-more.png') no-repeat 10px center;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	-o-transition: all .3s;
	transition: all .3s;
}
.accordion ul li:hover, .accordion ul li.focus, .focus{
	background: #FFF url('images/arrow-more.png') no-repeat 210px center;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	-o-transition: all .3s;
	transition: all .3s;
}
.accordion h3 {
	padding: 8px 10px;
	margin-bottom:1px;
	background: #0078a5 url('images/arrow-square.png') no-repeat 205px -42px;
	cursor: pointer;
	color:#FFF;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	-o-transition: all .3s;
	transition: all .3s;
}
.accordion h3:hover, .accordion h3.active, .active  {
	background: #003C52 url('images/arrow-square.png') no-repeat 205px 15px;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	-o-transition: all .3s;
	transition: all .3s;
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
span, span a{
	font-size:13px;
	color:#333;
}
span a:hover{
	text-decoration:underline;
}
</style>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
$(document).ready(function() {
$('.accordion h3').eq(2).addClass('active');
	$('.accordion ul').eq(2).show();
	$(".accordion h3").click(function(){
		$(this).next("ul").slideToggle("slow")
		.siblings("ul:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});

	$("ul li").click(function() {
		$("ul li").removeClass("focus");
		$(this).addClass("focus");
	});
});
</script>
<body>
<div id="bg-left">
<div class="accordion">
     <h3>Nội dung Trang Giới thiệu</h3>
    <ul>
        <li><a href="add_page_ctrinh.php" target="main">Nhập Danh mục</a></li>
        <li><a href="mana_page_ctrinh.php" target="main">Quản lý Danh mục</a></li>
        <li><a href="add_pageotherstatics_ctrinh.php" target="main">Nhập Nội dung</a></li>
    </ul>
	 
	<h3>Cảm nghĩ khách hàng</h3>
    <ul>
		<li><a href="add_news.php?skind=4" target="main">Nhập Cảm nghĩ</a></li>
        <li><a href="mana_news.php?skind=4" target="main">Cảm nghĩ khách hàng</a></li>
		<li><a href="search_news.php?skind=4" target="main">Tìm kiếm Cảm nghĩ</a></li>
    </ul>
	<h3>Nội dung Trang Dịch vụ</h3>
    <ul>
        <li><a href="add_page_dichvu.php" target="main">Nhập Danh mục</a></li>
        <li><a href="mana_page_dichvu.php" target="main">Quản lý Danh mục</a></li>
        <li><a href="add_pageotherstatics_dichvu.php" target="main">Nhập Nội dung</a></li>
    </ul>
	<!----<h3>Nhân lực chủ lực</h3>
    <ul>
		<li><a href="add_news.php?skind=5" target="main">Nhập Nhân lực</a></li>
        <li><a href="mana_news.php?skind=5" target="main">Nhân lực chủ lực</a></li>
		<li><a href="search_news.php?skind=5" target="main">Tìm kiếm Nhân lực</a></li>
    </ul>--->
	<h3>Tin tức</h3>
    <ul>
		<li><a href="add_cata.php?skind=1" target="main">Nhập Danh mục</a></li>
        <li><a href="mana_cata.php?skind=1" target="main">Quản lý Danh mục</a></li>
		<li><a href="add_news.php?skind=1" target="main">Nhập Tin tức</a></li>
        <li><a href="mana_news.php?skind=1" target="main">Tin tức</a></li>
        <li><a href="search_news.php?skind=1" target="main">Tìm kiếm Tin tức</a></li>
    </ul>
	<h3>Diễn đàn</h3>
    <ul>
		<li><a href="add_news.php?skind=7" target="main">Nhập Câu hỏi</a></li>
        <li><a href="mana_news.php?skind=7" target="main">Diễn đàn</a></li>
		<li><a href="search_news.php?skind=7" target="main">Tìm kiếm Câu hỏi</a></li>
    </ul>
	<h3>Thư viện ảnh</h3>
    <ul>	
		<li><a href="add_collection.php" target="main">Nhập Album</a></li>
        <li><a href="mana_collection.php" target="main">Quản lý Album</a></li>
		<li><a href="search_album.php" target="main">Tìm kiếm Album</a></li>
	 </ul>
	
	 <h3>Banner Left</h3>
    <ul>
        <li><a href="add_partner.php" target="main">Nhập Banner Left</a></li>
        <li><a href="mana_partner.php?view=all" target="main">Banner Left</a></li>
    </ul>
	 <h3>Gói khám</h3>
    <ul>
        <li><a href="add_goikham.php" target="main">Nhập Gói khám</a></li>
        <li><a href="mana_goikham.php?view=all" target="main">Gói khám</a></li>
    </ul>
	<!---<h3>Khách hàng</h3>
    <ul>
        <li><a href="add_banner.php" target="main">Nhập Khách hàng</a></li>
        <li><a href="mana_banner.php?view=all" target="main">Khách hàng</a></li>
    </ul>--->
	 <h3>Video</h3>
    <ul>
        <li><a href="add_video.php" target="main">Nhập video</a></li>
        <li><a href="mana_video.php" target="main">Video</a></li>
    </ul>
	<h3>Banners</h3>
    <ul>
        <li><a href="add_bannerhome.php" target="main">Nhập Banner</a></li>
        <li><a href="mana_bannerhome.php" target="main">Banners</a></li>
		<li><a href="search_bannerhome.php" target="main">Tìm kiếm Banner</a></li>
    </ul>
	<h3>Đăng ký nhận tin</h3>
    <ul>
        <li><a href="mana_dknhanmail.php?view=all" target="main">Đăng ký nhận tin</a></li>
       <li><a href="maillist.php" target="main">Gửi mail</a></li>
    </ul>
	<h3>Trang tĩnh</h3>
    <ul><? foreach ($array_loaitrangtinh as $key => $value){
		echo "<li><a href='add_pagestatics.php?kind=$key' target='main'>$value</a></li>";}
	?></ul>
	<h3>Nội dung thẻ Meta</h3>
    	<ul><li><a href='add_meta.php' target='main'>Cập nhật nội dung thẻ Meta</a></li></ul>
</div>
<span>Software update website content. Version 2.0.1. <a href="email:his@vigorhealth.com.vn" target="_blank">Help</a></span>
</div>
</body>
</html>