<? session_start();

if (!empty($_GET)) {extract($_GET);} else if (!empty($HTTP_GET_VARS)) {extract($HTTP_GET_VARS);}
if (!empty($_POST)) {extract($_POST);} else if (!empty($HTTP_POST_VARS)) {extract($HTTP_POST_VARS);} 

include("config/config.php");
include("config/sql.php");
if((!$lang) || (($lang!="vn") && ($lang!="eng"))){
	if(!$_SESSION["session_se_lang"]){
		$lang="vn";$se_lang=$lang;$_SESSION["session_se_lang"]=$se_lang;
	}else{
		$se_lang=$_SESSION["session_se_lang"];$lang=$se_lang;
	}
}else{
		$se_lang=$lang;$_SESSION["session_se_lang"]=$se_lang; 
}
if ($se_lang=="eng"){include ("lang/eng.php");} else {include ("lang/vn.php");}
include("common.php");
function dinhdangso($so){
	$so=trim($so);
	if(is_numeric($so)){
		if(($so)==floor($so)) return $so.".0"; else return $so;
	}else return $so;
}
function lienketpzbs($pz,$bs){
	$lk="";$bs="";
	if(!$pz) $pz="0";
	if(!$bs) $bs="0";
	if ((!$pz) && ($bs)) $lk="/0/$bs";
	if (($pz) && (!$bs)) $lk="/$pz";
	if (($pz) && ($bs)) $lk="/$pz/$bs";
	return $lk;
}
function mb_strtolower_define($chuoinguon,$trangthai){
	$thuong=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử",
	"ữ","ỳ","ý","ỵ","ỷ","ỹ","đ");
	$hoa=array("À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ","È","É","Ẹ","Ẻ","Ẽ","Ê","Ề" ,"Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ","Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ","Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử",
	"Ữ","Ỳ","Ý","Ỵ","Ỷ","Ỹ","Đ");
	return @strtolower(@str_replace($hoa,$thuong,$chuoinguon));
}
function mb_strtoupper_define($chuoinguon,$trangthai){
	$thuong=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử",
	"ữ","ỳ","ý","ỵ","ỷ","ỹ","đ");
	$hoa=array("À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ","È","É","Ẹ","Ẻ","Ẽ","Ê","Ề" ,"Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ","Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ","Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử",
	"Ữ","Ỳ","Ý","Ỵ","Ỷ","Ỹ","Đ");
	return @strtoupper(@str_replace($thuong,$hoa,$chuoinguon));
}
function RemoveSign($strremovesign){
	$strremovesign=trim($strremovesign);
	$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử",
	"ữ","ỳ","ý","ỵ","ỷ","ỹ","đ","ê","ù","à","'","&","/"," ",":","+",".","\"","@"," ","φ","?","\\");
	$khongDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u",
	"u","y","y","y","y","y","d","e","u","a","","-","-","-","","-","","","","","","","-");
	if (function_exists('mb_strtolower')) $strremovesign=mb_strtolower($strremovesign,"UTF-8"); else $strremovesign=mb_strtolower_define($strremovesign,"UTF-8");
	$strremovesign=@str_replace($coDau,$khongDau,$strremovesign);
	$strremovesign=@str_replace("/","",$strremovesign);
	$posvitri = strpos($strremovesign,"--");
	while (!($posvitri === false)) {
		$strremovesign=@str_replace("--","-",$strremovesign);
		$posvitri = strpos($strremovesign,"--");
	}
	return $strremovesign;
}
if (!($_SESSION["session_page_session"])){
	$page_session = md5(uniqid(rand(), true));
	$_SESSION["session_page_session"]=$page_session;
	$sess_date=date('YmdHis');
	$_SESSION["session_sess_date"]=$sess_date;
}
?>