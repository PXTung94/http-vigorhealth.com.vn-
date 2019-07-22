<? include("check.php");
include("../config/config.php");
include("../config/sql.php");
?><?php
/**
 * upload.php
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

// HTTP headers for no cache etc

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
$targetDir = '../multidata/';

//$cleanupTargetDir = false; // Remove old files
//$maxFileAge = 60 * 60; // Temp file age in seconds

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
$chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

// Clean the fileName for security reasons
//$fileName = preg_replace('/[^\w\._]+/', '-', $fileName);
$type=strtolower(substr($fileName, -3));
$pic_name_temp=RemoveSign(substr($fileName, 0,strlen($fileName)-3));
$fileName=kiemtratenfiletrung($pic_name_temp,$type);
// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_a=$fileName_a."_".date('YmdHis')."_".rand(1000,1000000);
	$fileName_b = substr($fileName, $ext);

	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;

	$fileName = $fileName_a . '_' . $count . $fileName_b;
}

// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);

// Look for the content type header
if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

if (isset($_SERVER["CONTENT_TYPE"]))
	$contentType = $_SERVER["CONTENT_TYPE"];

// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
if (strpos($contentType, "multipart") !== false) {
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		if (!(@copy($_FILES['file']['tmp_name'], "../multidata/$fileName"))){ 
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		}
		@unlink($_FILES['file']['tmp_name']);
		//insert_logo("../multidata/$fileName","../multidata/logo/logo-into-images.gif");
		resizepic_one($fileName,220);
		$idsubcollection=$_SESSION['ses_add_pic_idsubcollection'];
		$qr=mysql_query("insert into tbl_album(idsubcollection,image) VALUES('$idsubcollection','$fileName')");
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
} else {
	// Open temp file
	if (!(@copy($_FILES['file']['tmp_name'], "../multidata/$fileName"))){ 
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
	//insert_logo("../multidata/$fileName","../multidata/logo/logo-into-images.gif");
	resizepic_one($fileName,220);
	$idsubcollection=$_SESSION['ses_add_pic_idsubcollection'];
	$qr=mysql_query("insert into tbl_album(idsubcollection,image) VALUES('$idsubcollection','$fileName')");
}

// Return JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

?>