<? include("check.php");
include("../config/config.php");
include("../config/sql.php");
$_SESSION['ses_add_pic_idsubcollection']=$idsubcollection;
$qr_collection = mysql_query("select name from tbl_subcollection where idsubcollection ='$idsubcollection'");
$name_collection=outputdata(@mysql_result($qr_collection,0,'name'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<link href="css/style218.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title><?=$name_collection ?></title>
<style type="text/css">

a:link.up {
	color: #FFF;
	text-decoration: none;
	float:left;
	background:#333;
	margin-right: 15px;
	font-weight: bold;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	}
a:visited.up {
	color: #FFF;
	}
a:hover.up {
	color: #FFFF00;
	}
@import url("Aeolus/formIE.css");
</style>
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<script type="text/javascript" src="js/plupload.js"></script>
<script type="text/javascript" src="js/plupload.gears.js"></script>
<script type="text/javascript" src="/js/plupload.silverlight.js"></script>
<script type="text/javascript" src="js/plupload.flash.js"></script>
<script type="text/javascript" src="js/plupload.browserplus.js"></script>
<script type="text/javascript" src="js/plupload.html4.js"></script>
<script type="text/javascript" src="js/plupload.html5.js"></script>

<!-- <script type="text/javascript"  src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script> -->

</head>
<body>

<h1>Thêm hình: <?=$name_collection ?></h1>
<div id="container">
    <div id="filelist">No runtime found.</div>
    <br />
    <a id="pickfiles" href="javascript:;" class="up">Chọn File</a> 
    <a id="uploadfiles" href="javascript:;" class="up">Upload File</a>
</div>


<script type="text/javascript">
// Custom example logic
function $(id) {
	return document.getElementById(id);	
}


var uploader = new plupload.Uploader({
	runtimes : 'gears,html5,flash,silverlight,browserplus',
	browse_button : 'pickfiles',
	container: 'container',
	max_file_size : '10mb',
	url : 'upload.php',
	//resize : {width : 320, height : 240, quality : 90},
	flash_swf_url : 'js/plupload.flash.swf',
	silverlight_xap_url : 'js/plupload.silverlight.xap',
	filters : [
		{title : "Image files", extensions : "jpg,gif,png"},
		{title : "Zip files", extensions : "zip"}
	]
});

uploader.bind('Init', function(up, params) {
	$('filelist').innerHTML = "<div></div>";
});

uploader.bind('FilesAdded', function(up, files) {
	for (var i in files) {
		$('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
	}
});

uploader.bind('UploadProgress', function(up, file) {
	$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});

$('uploadfiles').onclick = function() {
	uploader.start();
	return false;
};

uploader.init();
</script>
<br /><br /><br />
<p>
 <input name="submit" class="submit" type="button" value="Kết thúc" size="30"  onclick="javascript:location.href='edit_pic_collection.php?idsubcollection=<?=$idsubcollection?>';"></p>
</body>
</html>