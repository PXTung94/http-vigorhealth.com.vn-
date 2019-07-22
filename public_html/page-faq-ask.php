<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<?
$irand=rand(10000,999999);$_SESSION["session_sendmail_irand_guicauhoi"]=$irand;
?>
<div id="colRight">
	<a name="anchor" id="askFaq"></a>
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_dat_cau_hoi?></h1></div>
    </div>
    <div class="clr" style="height:20px;"></div>
    <div id="contact" class="ask">
         <form action="<?=$sub_root?>/send-mail-faq" method="post" name="FormNameContact" id="FormNameContact" >
            <div class="clr" style="height:20px;"></div>
            <div class="formCol Left">
            	<li><span><?=$lb_tieude?></span><input name="s_tieude" type="text" /></li>
				<li><span><?=$lb_hoten?></span><input name="s_fullname" type="text" /></li>
            	<li><span><?=$lb_diachi_homthu?></span><input name="s_email" type="text" /></li>
            	
            	<li><span><?=$lb_sodt?> </span><input name="s_dienthoai" type="text" /></li>
            </div>
            <div class="formCol Right">
            	<li><span><?=$lb_diachi?></span><input name="s_address" type="text" /></li>
				<li><span><?=$lb_machong_spam?> <strong><?=$irand;?></strong></span><input name="mabaove" type="text" /></li>
            	<li><span><?=$lb_noidung_cauhoi?></span><textarea name="s_message" cols="" rows=""></textarea></li>
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
			s_tieude.value = "";
			mabaove.value = "";
		}
	 	return true;
	}
	function CheckFormMailContact(){
		with(document.FormNameContact){
			if(s_tieude.value == ""){
				alert('<?=$lb_input_tieude?> !');
				s_tieude.focus();
				return false;
			}
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
				alert('<?=$lb_input_cauhoi?> !');
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