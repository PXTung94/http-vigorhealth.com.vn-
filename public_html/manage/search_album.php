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
</head>
<body>
<form name="searchmember" method="post" action="mana_collection.php?timkiem_user=1">
<div id="mainlblock">
	<div id="content">        
        <p><h1>Tìm kiếm album</h1>
        <p>Từ khóa<br />
        <input type="text" name="giatritim" value="<? echo $giatritim ?>"/>
        <p>Sắp xếp<br />
        <select name="sx_order" style="width:100%">
	    <?	
	$sapxep_array=array("sort asc,idsubcollection desc"=>"Sort ASC","sort desc,idsubcollection desc"=>"Sort DESC",
	"idsubcollection DESC"=>"ID DESC","idsubcollection ASC"=>"ID ASC","name_no DESC"=>"Tên album DESC","name_no ASC"=>"Tên album ASC");
	foreach ($sapxep_array as $key => $value){
			if($key == $sx_order) echo "<option value='$key' selected>$value</option>";
			else echo "<option value='$key'>$value</option>";
		}

?></select>
        <p><input name="timkiem_user" type="submit" class="submit" value="Tìm kiếm">
    </div>
</div>
</form>
</body>
</html>