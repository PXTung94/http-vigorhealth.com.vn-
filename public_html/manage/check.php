<? session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!empty($_GET)) {extract($_GET);} else if (!empty($HTTP_GET_VARS)) {extract($HTTP_GET_VARS);}
if (!empty($_POST)) {extract($_POST);} else if (!empty($HTTP_POST_VARS)) {extract($HTTP_POST_VARS);} 
// tu 1 den 20 trang binh thuong
// tu 21 den 25 la trang khong can anh
// tu 26 den 30 la trang chung
// tu 31 tro len la hinh anh
$array_loaitrangtinh=array(1=>"Giới thiệu về chúng tôi",2=>"Liên hệ",3=>"Khách hàng",4=>"Nhân sự Chủ lực",5=>"Đội ngũ Bác sỹ Trang chủ",26=>"Google Map"
,21=>"Tel - Giờ tư vấn (Bên trái)",23=>"Giới thiệu Gói khám",24=>"Địa chỉ (Đầu trang)",25=>"Địa chỉ (Cột bên trái)",27=>"Giới thiệu đội ngũ (Trang chủ)",28=>"Địa chỉ (cuối trang)");
$array_page=array(4=>"Cảm nghĩ khách hàng",5=>"Nhân lực chủ lực",1=>"Tin tức",7=>"Diễn đàn");
$array_loaibanner=array(1=>"Trang chủ",2=>"Giới thiệu",3=>"Dịch vụ",4=>"Cảm nghĩ khách hàng",5=>"Nhân sự chủ lực",6=>"Tin tức",7=>"Diễn đàn",8=>"Khách hàng",9=>"Thư viện ảnh");
$array_meta=array(1=>"Cảm nghĩ khách hàng",2=>"Nhân sự chủ lực",3=>"Tin tức",4=>"Diễn đàn",5=>"Đặt câu hỏi",6=>"Liên hệ",7=>"Khách hàng",8=>"Thư viện ảnh",9=>"Sitemap"
,10=>"Video");
function dinhdangso($so){
	$so=trim($so);
	if(is_numeric($so)){
		if(($so)==floor($so)) return $so.".0"; else return $so;
	}else return $so;
}
function xulytien($strso){
	 $strso = str_replace(".", "",$strso);
	 $strso = str_replace(" ", "",$strso);
	 $strso = str_replace(",", ".",$strso);
	 return $strso;
}
$array_error_file=array("0"=>"Please choose file download.","-1"=>"File tag is invalid","-2"=>"","-3"=>"Error upload to server");
function upload_file($imagename,$vitri){
/* 
	= 0: neu khong chon file anh
	=-1: tag khong thoa man dieu kien 
	=-2: loi upload len server
	=-3: loi resize image
*/
	if($vitri){
		$vitri--;
		$name_name=$_FILES[$imagename]['name'][$vitri];
		$tmp_name=$_FILES[$imagename]['tmp_name'][$vitri];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}else{
		$name_name=$_FILES[$imagename]['name'];
		$tmp_name=$_FILES[$imagename]['tmp_name'];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}
	$type=strtolower(substr($name_name, -3));
	$type=strtolower($type);
	if  (!(($type=="pdf") ||($type=="jpg")||($type=="png")||($type=="gif")||($type=="bmp")||($type=="mp3")||($type=="mp4")||($type=="flv")||($type=="doc")||($type=="xls")||($type=="rar")||($type=="zip")||($type=="swf"))){ 
		$type=strtolower(substr($name_name, -4));
		if  (!(($type=="docx")||($type=="xlsx"))){ 
			return -1;exit();
		}else{$pic_name=RemoveSign(substr($name_name, 0,strlen($name_name)-4));}
	}else{$pic_name=RemoveSign(substr($name_name, 0,strlen($name_name)-3));}
	$pic_name=kiemtratenfiletrung($pic_name,$type);
	if (!(@copy("$tmp_name", "../multidata/$pic_name"))){ return -2;exit();}	
	return $pic_name;
}

function resizepic($tenfile,$widthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		if ($height>$width){
			$h=$widthresize;
			$w=round($width*$widthresize/$height,0);
		}else{
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}
		
		/*if ($width>$widthresize) {
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}else{
			$h=$height;
			$w=$width;
		}*/
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../resizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/resizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
}


function upload_image1($imagename,$vitri,$edit,$insertlogo,$resize_heigth){
/* 
	= 0: neu khong chon file anh
	=-1: tag khong thoa man dieu kien 
	=-2: loi upload len server
	=-3: loi resize image
*/
	if($vitri){
		$vitri--;
		$name_name=$_FILES[$imagename]['name'][$vitri];
		$tmp_name=$_FILES[$imagename]['tmp_name'][$vitri];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}else{
		$name_name=$_FILES[$imagename]['name'];
		$tmp_name=$_FILES[$imagename]['tmp_name'];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}
	$type=strtolower(substr($name_name, -3));
	$type=strtolower($type);
	if  (!(($type=="bmp") ||($type=="jpg") ||($type=="gif")||($type=="png"))){ return -1;exit();}	
	$pic_name=RemoveSign(substr($name_name, 0,strlen($name_name)-3));
	$pic_name=kiemtratenfiletrung($pic_name,$type);
	if (!(@copy("$tmp_name", "../multidata/$pic_name"))){ return -2;exit();}	
	if ($resize_heigth){
		if (!@resizepic1($pic_name,$resize_heigth)){ return -3;exit();}
	}
	if($insertlogo){ insert_logo("../multidata/$pic_name","../multidata/logo/logo-into-images.gif");}
	return $pic_name;
}
function resizepic1($tenfile,$heigthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		if ($height>$heigthresize) {
			$h=$heigthresize;
			$w=round($width*$heigthresize/$height,0);
		}else{
			$h=$height;
			$w=$width;
		}
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../resizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/resizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
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
function xulytenfile($tenfile){
	$thuong=array(" ","/");
	$hoa=array("_","_");
	return @strtoupper(@str_replace($thuong,$hoa,$tenfile));
}
function kiemtratenfiletrung($tenfile,$typefile){
	$tenfile=str_replace(".","-",$tenfile);
	$tenfilegoc=$tenfile;
	$tenfile_kt="../multidata/".$tenfile.".".$typefile;
	while(file_exists($tenfile_kt)){
		$tenfile=$tenfilegoc."-".rand(10,1000);
		$tenfile_kt="../multidata/".$tenfile.".".$typefile;
		
	}
	return $tenfile.".".$typefile;
}
function RemoveSign($strremovesign){
	$strremovesign=trim($strremovesign);
	$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử",
	"ữ","ỳ","ý","ỵ","ỷ","ỹ","đ","ê","ù","à","'","&","/"," ",":","+",".","\"","@"," ","φ","?","\\","(",")");
	$khongDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u",
	"u","y","y","y","y","y","d","e","u","a","","-","-","-","","-","","","","","","","-","","");
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
function insert_logo($target,$logo_file){
	$vcxtrans=100;$vcxstatus=9; 
	$attachinfo	= getimagesize($target);
	$vcx_logo = imagecreatefromgif($logo_file);
	$logo_w		= imagesx($vcx_logo);
	$logo_h		= imagesy($vcx_logo);
	$img_w		= $attachinfo[0];
	$img_h		= $attachinfo[1];
	$wmwidth	= $img_w - $logo_w;
	$wmheight	= $img_h - $logo_h;
	if ($attachinfo['mime']=="image/bmp"){ return 1; exit();}
	if ((is_readable($logo_file)) && ($wmwidth > 10) && ($wmheight > 10)&& ($img_w >= 250)) {
		switch($attachinfo['mime']) {
			case 'image/jpeg':
				$dst_photo = imagecreatefromjpeg($target); 
				break;
			case 'image/gif':
				$dst_photo = imagecreatefromgif($target);
				break;
			case 'image/png':
				$dst_photo = imagecreatefrompng($target);
				break;
		}
		switch($vcxstatus) {
			case 1:
				$x = +3;
				$y = +3;
				break;
			case 2:
				$x = ($logo_w +	$img_w)	/ 2;
				$y = +3;
				break;
			case 3:
				$x = $img_w - $logo_w-3;
				$y = +3;
				break;
			case 4:
				$x = +3;
				$y = ($logo_h +	$img_h)	/ 2;
				break;
			case 3:
				$x = ($logo_w +	$img_w)	/ 2;
				$y = ($logo_h +	$img_h)	/ 2;
				break;
			case 6:
				$x = $img_w - $logo_w;
				$y = ($logo_h +	$img_h)	/ 2;
				break;
			case 7:
				$x = +3;
				$y = $img_h - $logo_h-3;
				break;
			case 8:
				$x = ($logo_w +	$img_w)	/ 2;
				$y = $img_h - $logo_h;
				break;
			case 9:
				$x = $img_w - $logo_w-3;
				$y = $img_h - $logo_h-3;
				break;
		}
		@imagealphablending($vcx_logo, true);
		@imagecopymerge($dst_photo, $vcx_logo, $x, $y, 0, 0, $logo_w, $logo_h, $vcxtrans);
		@unlink($target);
		switch($attachinfo['mime']) {
			case 'image/jpeg':
				imagejpeg($dst_photo,$target,100); return 1;
				break;
			case 'image/gif':
				imagegif($dst_photo,$target);return 1;
				break;
			case 'image/png':
				imagepng($dst_photo,$target);return 1;
				break;
		}
	}
	return 0;
}
$array_error_image=array("0"=>"Please choose image.","-1"=>"File tag must be *.bmp; *.jpg; *.gif; *.png !","-2"=>"Error upload to server","-3"=>"Error");
function upload_image($imagename,$vitri,$edit,$insertlogo,$resize_width){
/* 
	= 0: neu khong chon file anh
	=-1: tag khong thoa man dieu kien 
	=-2: loi upload len server
	=-3: loi resize image
*/
	if($vitri){
		$vitri--;
		$name_name=$_FILES[$imagename]['name'][$vitri];
		$tmp_name=$_FILES[$imagename]['tmp_name'][$vitri];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}else{
		$name_name=$_FILES[$imagename]['name'];
		$tmp_name=$_FILES[$imagename]['tmp_name'];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}
	$type=strtolower(substr($name_name, -3));
	$type=strtolower($type);
	if  (!(($type=="bmp") ||($type=="jpg") ||($type=="gif")||($type=="png"))){ return -1;exit();}	
	$pic_name=RemoveSign(substr($name_name, 0,strlen($name_name)-3));
	$pic_name=kiemtratenfiletrung($pic_name,$type);
	if (!(@copy("$tmp_name", "../multidata/$pic_name"))){ return -2;exit();}	
	if ($resize_width){
		if (!@resizepic($pic_name,$resize_width)){ return -3;exit();}
	}
	if($insertlogo){ insert_logo("../multidata/$pic_name","../multidata/logo/logo-into-images.gif");}
	return $pic_name;
}
function upload_image_two_resize($imagename,$vitri,$edit,$insertlogo,$resize_width,$resize_second_width){
/* 
	= 0: neu khong chon file anh
	=-1: tag khong thoa man dieu kien 
	=-2: loi upload len server
	=-3: loi resize image
*/
	if($vitri){
		$vitri--;
		$name_name=$_FILES[$imagename]['name'][$vitri];
		$tmp_name=$_FILES[$imagename]['tmp_name'][$vitri];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}else{
		$name_name=$_FILES[$imagename]['name'];
		$tmp_name=$_FILES[$imagename]['tmp_name'];
		if(!($name_name)){ if($edit) return ""; else return 0; exit();}
	}
	$type=strtolower(substr($name_name, -3));
	$type=strtolower($type);
	if  (!(($type=="bmp") ||($type=="jpg") ||($type=="gif")||($type=="png"))){ return -1;exit();}	
	$pic_name=RemoveSign(substr($name_name, 0,strlen($name_name)-3));
	$pic_name=kiemtratenfiletrung($pic_name,$type);
	if (!(@copy("$tmp_name", "../multidata/$pic_name"))){ return -2;exit();}	
	if ($resize_width){
		if (!@resizepic($pic_name,$resize_width)){ return -3;exit();}
	}
	if ($resize_second_width){
		if (!@resizepic_second_width($pic_name,$resize_second_width)){ return -3;exit();}
	}
	if($insertlogo){ insert_logo("../multidata/$pic_name","../multidata/logo/logo-into-images.gif");}
	return $pic_name;
}
function resizepic_second_width($tenfile,$widthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		if ($height>$width){
			$h=$widthresize;
			$w=round($width*$widthresize/$height,0);
		}else{
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../secondresizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/secondresizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
}
function resizepic_three_width($tenfile,$widthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		if ($height>$width){
			$h=$widthresize;
			$w=round($width*$widthresize/$height,0);
		}else{
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../threeresizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/threeresizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
}
function resizepic_one($tenfile,$widthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		/*if ($width>$widthresize) {
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}else{
			$h=$height;
			$w=$width;
		}*/
		
		if ($height>$width){
			$h=$widthresize;
			$w=round($width*$widthresize/$height,0);
		}else{
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../resizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/resizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
}
function resizepic_catalog($tenfile,$widthresize){
	$tennguonanh="../multidata/".$tenfile;
	@list($width, $height,$phanmorong) = getimagesize($tennguonanh);
	if (($phanmorong==1) || ($phanmorong==2) || ($phanmorong==3)){
		/*if ($width>$widthresize) {
			$w=$widthresize;
			$h=round($height*$widthresize/$width,0);
		}else{
			$h=$height;
			$w=$width;
		}*/
		
		//if ($height>$width){
			$h=$widthresize;
			$w=round($width*$widthresize/$height,0);
		//}else{
		//	$w=$widthresize;
		//	$h=round($height*$widthresize/$width,0);
		//}
		if (strtolower($phanmorong)=="1") $imagenguon=imagecreatefromgif ($tennguonanh);
		if (strtolower($phanmorong)=="2") $imagenguon=imagecreatefromjpeg ($tennguonanh);
		if (strtolower($phanmorong)=="3") $imagenguon=imagecreatefrompng ($tennguonanh);
		if (!$imagenguon){
			return 0;
		}else {
			$imagedich=imagecreatetruecolor ($w,$h);
			$a=@imagecopyresampled ($imagedich,$imagenguon,0,0,0,0,$w,$h,$width,$height);
			$tendichanh="../resizemultidata/".$tenfile;
			if (strtolower($phanmorong)=="1") $im=imagegif($imagedich,$tendichanh);
			if (strtolower($phanmorong)=="2") $im=imagejpeg($imagedich,$tendichanh,100);
			if (strtolower($phanmorong)=="3") $im=imagepng($imagedich,$tendichanh);
			imagedestroy($imagedich);
			if ($im) return 1; else return 0;
		}
	}else{
		$tendichanh="/resizemultidata/".$tenfile;
		if (@copy($tennguonanh,$tendichanh)) return 1; else return 0;
		
	}
}
$skyadmin=$_SESSION["session_vigor_admin"];
if($action == "login"){
	$username=trim($username);$password=md5($password);
	include("../config/config.php");
	include("../config/sql.php");
	$sql_check_acc = mysql_query("select * from  tbl_admin where (ad_user='$username') and (ad_pass='$password')");
	if(!@mysql_num_rows($sql_check_acc)){
		echo "<script>alert(\"Login is not successful !\");location.href='login.php';</script>";
		exit();
	}
	$skyadmin =trim(@mysql_result($sql_check_acc,0,'ad_id'));
	$_SESSION["session_vigor_admin"]=$skyadmin;
	echo "<script>location.href='index.html';</script>";
}
if($action == "logout"){
	$_SESSION["session_vigor_admin"]=0;
	echo "<script>window.top.location.href = 'login.php';</script>";
}
if(!$skyadmin){
	echo "<script>window.top.location.href = 'login.php';</script>";
	exit();
}
?>