<?
$config = 1;
$db=mysql_connect("$dbhost:$dbport","$dbuser","$dbpass");	
if(is_string($db)){
	die("Could not connect to database server!");
}
$dbuse=mysql_select_db($db_name,$db);
if(!$dbuse){
	die("Could not use database!");
}
$gbtime = time() + (7 * 3600);
function outputdata($chuoichuyendoi){
	return @html_entity_decode ($chuoichuyendoi, ENT_QUOTES);
}
function outputdata_input($chuoichuyendoi){
	$daucandoi=array("'",'"');
	$daudoiqua=array("&#039;",'&quot;');
	$chuoichuyendoi=html_entity_decode ($chuoichuyendoi, ENT_QUOTES);
	return @str_replace($daucandoi,$daudoiqua,$chuoichuyendoi);
}
function inputdata($chuoichuyendoi){
	$chuoichuyendoi=htmlentities ($chuoichuyendoi, ENT_QUOTES);
	return $chuoichuyendoi;
}
function my_html_encode($s) { 
$s = preg_replace("#&(?!\#[0-9]+;)#si", "&amp;", $s); 
$s = str_replace("<","&lt;",$s); 
$s = str_replace(">","&gt;",$s); 
$s = str_replace("\"","&quot;",$s); 
//$s = str_replace(" ", "&nbsp;&nbsp;", $s); 
return $s; 
} 
?>