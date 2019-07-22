<? include("common.php"); ?>
<?
$file = $_GET['file'];
if(isset($_GET['file'])){
    //Please give the Path like this
    $file = 'multidata/'.$_GET['file'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Type: application/octet-stream');
		header('Content-type: image/jpg');
		header('Content-type: image/gif');
		header('Content-type: image/png');
		header('Content-type: application/pdf');
		header('Content-type: application/msword');
		header('Content-type: application/vnd.ms-excel');
		header('Content-type: application/vnd.ms-powerpoint');
		header('Content-type: ');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}
?>