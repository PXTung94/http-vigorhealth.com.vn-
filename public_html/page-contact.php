<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<?
$irand=rand(10000,999999);$_SESSION["session_sendmail_irand_contact"]=$irand;
?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/lien-he"><?=$lb_lienhe?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_lienhe_chungtoi?></h1></div>
    </div>
    <div id="contact">
    	<div id="map">
        	<? $kind=26;$qr=mysql_query("select * from tbl_page where kind='$kind'");if (@mysql_num_rows($qr)){echo outputdata(@mysql_result($qr,0,'content'));}?>
        </div><!--end map-->
	    <div id="showText" class="textInside">
	       <?
$kind=2;
$qr=mysql_query("select * from tbl_page where kind='$kind'");
if (@mysql_num_rows($qr)){
    $id_id=trim(@mysql_result($qr,0,'id'));
    if($se_lang=="vn") $content=outputdata(@mysql_result($qr,0,'content')); else $content=outputdata(@mysql_result($qr,0,'content_en'));
    $sql_picogiua = mysql_query("select * from tbl_pic_page where n_id='$id_id' and kind=$kind order by n_vitri");
    while($rowspic = mysql_fetch_array($sql_picogiua)){
        $n_vitri = $rowspic[n_vitri];
        $p_pic = $rowspic[p_pic];
        $chuoitim="{{image".$n_vitri."}}";
        $chuoithay="$sub_multidata/".$p_pic;
        $content=str_replace($chuoitim,$chuoithay,$content);
    }
    $content=str_replace("$"."irand",$irand,$content);
    echo $content;
}
?>
	    </div><!--end showText-->
		<div class="clr"></div>
    </div><!--end contact-->
	<div class="pageNav"><div class="rightTitle"><h1><?=$lb_form_lienhe?></h1></div></div>
    <div id="contact">
        <form action="<?=$sub_root?>/send-mail" method="post" name="FormNameContact" id="FormNameContact" >
        	<em><?=$lb_cam_on?></em>
            <div class="clr" style="height:20px;"></div>
            <div class="formCol Left">
            	<li><span><?=$lb_hoten?></span><input name="s_fullname" type="text" /></li>
            	<li><span><?=$lb_diachi_homthu?></span><input name="s_email" type="text" /></li>
            	<li><span><?=$lb_diachi?></span><input name="s_address" type="text" /></li>
            	<li><span><?=$lb_sodt?> </span><input name="s_dienthoai" type="text" /></li>
            </div>
            <div class="formCol Right">
            	<li><span><?=$lb_machong_spam?> <strong><?=$irand;?></strong></span><input name="mabaove" type="text" /></li>
            	<li><span><?=$lb_noidung?></span><textarea name="s_message" cols="" rows=""></textarea></li>
                <div class="clr"></div>
                <a onclick="RefreshFormMailContact()" style="cursor:pointer"><?=$lb_lamlai?></a><a onclick="CheckFormMailContact()" style="cursor:pointer" ><?=$lb_guiemail?></a>
            </div>
            <div class="clr"></div>
        <input name="mabaovehidden" type="hidden" id="mabaovehidden" value="<?=$irand;?>"> </form>
    </div><!--end contact-->
    <div class="clr"></div>
</div><!--end colRight-->
<script language="javascript">
	function RefreshFormMailContact(){
		with(document.FormNameContact){	
			s_fullname.value = "";
			s_address.value = "";
			s_email.value="";
			s_message.value = "";
			s_dienthoai.value = "";
			mabaove.value = "";
		}
	 	return true;
	}
	function CheckFormMailContact(){
		with(document.FormNameContact){
			if(s_fullname.value == ""){
				alert('<?=$lb_input_hoten?> !');
				s_fullname.focus();
				return false;
			}
			if(s_address.value == ""){
				alert('<?=$lb_input_diachi?> !');
				s_address.focus();
				return false;
			}
			if(s_email.value == ""){
					alert("<?=$lb_input_email?> !");
					s_email.focus();
					return false;
			}else{
				if(s_email.value.indexOf("@")<0||s_email.value.indexOf(".")<0){
					alert("<?=$lb_input_email_error?> !");
					s_email.focus();
					return false;
				}
			}		
			if(s_dienthoai.value == ""){
				alert('<?=$lb_input_dienthoai?>')
				s_dienthoai.focus()
				return false
			}
			if(s_message.value == ""){
				alert('<?=$lb_input_noidung?> !');
				s_message.focus();
				return false;
			}
			if(mabaove.value!=mabaovehidden.value){
				alert('<?=$lb_input_mabaove?> !')
				mabaove.focus()
				return false
			}
			
		}
	document.FormNameContact.submit();
	 return true;
}
</script>