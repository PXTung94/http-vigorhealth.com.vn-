<? include("check.php"); 
include("../config/config.php");
include("../config/sql.php");
if($skind) $_SESSION["session_skind_admin"]=$skind; else $skind=$_SESSION["session_skind_admin"]; $lb_tieude ="Tìm kiếm ".$array_page[$skind];
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

<form name="searchproduct" method="post" action="mana_news.php?timkiem_news=1&skind=<?=$skind?>">
<div id="mainlblock">
	<div id="content">        
        <p>
        <h1><?=$lb_tieude?></h1>
        <p>Từ khóa<br />
        <input type="text" name="value_search" value="<? echo $value_search ?>"/>
		<? if(($skind<=3)||($skind==6)){ ?>
		<p>Danh mục<br />
        <select name="catalogid_search" style="width:100%"><?
		echo "<option value=''>Tất cả</option>";
		$abc = mysql_query("select * from tbl_cata WHERE c_kind='$skind' order by c_sort,c_id");
		$numcata = mysql_num_rows($abc);
		while($rowcata = mysql_fetch_array($abc)){
			$c_name = $rowcata[c_name];
			$c_id = $rowcata[c_id];
			if ($catalogid_search==$c_id){
				echo "<option value='$c_id' selected>$c_name</option>";
			}else{
				echo "<option value='$c_id'>$c_name</option>";
			}
		}	
		?></select>
		 <? }?>
        <p>Trạng thái<br />
        <select name="kind_search" style="width:100%"><?
		$kind_search_array=array(''=>'Tất cả','a_of=1'=>'Hiển thị','a_of=0'=>'Ẩn');
		foreach ($kind_search_array as $key => $value){
			if($key == $kind_search) echo "<option value='$key' selected>$value</option>";
			else echo "<option value='$key'>$value</option>";
		}
		?></select>   
		 
        <p><input name="timkiem_news" type="submit" class="submit" value="Tìm">
    </div>
</div>
</form>
</body>
</html>