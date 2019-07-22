<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div class="leftGroup left">
	<div class="leftBox" id="timeWork">
	    <? $kind=21;$qr=mysql_query("select * from tbl_page where kind='$kind'");
		if (@mysql_num_rows($qr)){if($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en')); else echo outputdata(@mysql_result($qr,0,'content'));}?>
	</div><!--end leftBox-->
	<div class="leftBox" id="follow">
	    <div class="leftTitle">&rarr; <?=$lb_ketnoi_chungtoi?></div>
	    <ul>
	        <a href="https://www.facebook.com/vigorhealth.vietnam" class="facebook" target="_blank">facebook</a>
	        <a href="#" class="twitter" target="_blank">twitter</a>
	        <a href="#" class="flickr" target="_blank">flickr</a>
	        <a href="#" class="youtube" target="_blank">youtube</a>
	        <div class="clr"></div>
	    </ul>
	    <div class="clr"></div>
	</div><!--end leftBox-->
	<div class="leftBox ">
		<div class="leftTitle">&rarr; Thông báo sở y tế</div>
		<ul style="color: #fff;    background: #A6CE39;    line-height: 30px;    padding: 0 12px;    margin-bottom: 3px;">
			<a href="http://www.medinet.gov.vn/thong-bao-tb1013.aspx" ><b style="color: #fff;">Thông báo TB1013: </b> http://www.medinet.gov.vn/thong-bao-tb1013.aspx</a></br>
            <a href="http://www.medinet.gov.vn/van-ban-vb25.aspx" ><b style="color: #fff;">Văn bản VB25:</b> http://www.medinet.gov.vn/van-ban-vb25.aspx</a>
	        <div class="clr"></div>
	    </ul>
	    <div class="clr"></div>
            
        </div>
	<div class="leftBox" id="leftReg">
	    <div class="leftTitle"><?=$lb_dangky_nhantin?></div>
	   <form name="FormQC" action="<?=$sub_root?>/dang-ky-nhan-tin" method="post">
	        <input name="emailnhanqc" type="text" placeholder="<?=$lb_nhan_email?>" value="<?=$lb_nhan_email?>" onFocus="if (this.value == '<?=$lb_nhan_email?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=$lb_nhan_email?>';}"><a onclick="CheckNhanQC()" style="cursor:pointer">GO</a>
	        <div class="clr"></div>
	    <input name="loaidangky" type="hidden" value="dangky" /></form>
		<script language="javascript">
function CheckNhanQC()
{
  with (document.FormQC)
      {
                if ((emailnhanqc.value=="")||(emailnhanqc.value=="<?=$lb_nhan_email?>"))
                {
                        alert("<?=$lb_nhap_email_vao?>");
                        emailnhanqc.focus();
                        return false;
                }
                else
                {
                        if(emailnhanqc.value.indexOf("@")<0||emailnhanqc.value.indexOf(".")<0)
                        {
                                alert("<?=$lb_diachi_email_sai?>");
                                emailnhanqc.focus();
                                return false;
                        }
                }              				
        }
		document.FormQC.loaidangky.value="dangky";
		document.FormQC.submit();
        return true;
}
</script>
	</div><!--end leftBox-->
</div><!--end leftGroup left-->
<div class="leftGroup right none749">
	<div class="leftBox">
	    <div class="leftTitle">
	    	<?=$lb_gift_card?>
	    	<div class="slidePagi" id="giftPagi"></div>
	    </div>
	    <div class="leftSlide" id="giftCart">
	    	<ul>
			<?
	$sql_banner = mysql_query("select * from  tbl_banner where hienthi=1 order by sapxep,lienketid");
	while($rowsbn = mysql_fetch_array($sql_banner)){
		if($se_lang=="eng") {$s_text = outputdata($rowsbn[s_text_en]);}else{$s_text = outputdata($rowsbn[s_text]);}
		$s_pic = $rowsbn[s_pic];$s_link = outputdata($rowsbn[s_link]);
		$type=strtolower(substr($s_pic, -3));
		if($type=="swf")
			echo"<li><a href='$s_link'><embed width='100%' height='540' align='middle' quality='high' wmode='transparent' allowscriptaccess='always' flashvars='google.com.vn;targer='_blank'' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' alt='' src='$sub_multidata/$s_pic'></a></li>";
		else echo "<li><a href='$s_link'><img src='$sub_multidata/$s_pic' width='394' alt='$s_text'/></a></li>";
	}
	?>
	        </ul>
	    </div>
        <script type="text/javascript">
		jQuery(document).ready(function(){
			$("#giftCart ul").imagesLoaded(function(){
		    	$("#giftCart ul").carouFredSel({
					circular: false,
					infinite: true,
					width: "100%",
					pagination: "#giftPagi",
					auto 	: {
						pauseDuration : 4000,
						pauseOnHover: true
					},
					scroll	: {
						items	: 1,
						fx		: 'linear',
						duration: 500,
					},
					swipe: {
						onMouse: true,
						onTouch: true,
					},
					items : {
						height: "variable"
					}
				});
			});
		});
	    </script>
	</div><!--end leftBox-->
	<div class="leftBox">
	    <div class="leftTitle">
	       <?=$lb_camnghi_khachhang_hoa?>
	        <div class="slidePagi" id="thinkPagi"></div>
	    </div>
	    <div class="leftSlide" id="leftThink">
	        <ul>
			<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (c_kind='4') order by  a_id  desc limit 0,4");
	while($rows = mysql_fetch_array($sql_list)){
		$a_pic = $rows[a_pic];$a_name_no = outputdata($rows[a_name_no]);
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_gioithieu = outputdata($rows[a_gioithieu_en]);$a_ghichu = outputdata($rows[a_ghichu_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_gioithieu = outputdata($rows[a_gioithieu]);$a_ghichu = outputdata($rows[a_ghichu]);}
		echo "<li>
	                <div class='top'>
	                    <a href='$sub_root/cam-nghi-khach-hang/$a_name_no'><h1>$a_name</h1></a>
						<h2>$a_gioithieu</h2>
	                </div>
	                <div class='bottom'>
	                    <span style='background-image: url($sub_multidata/$a_pic);'>avatar</span>
	                    <p>$a_ghichu</p>
	                </div>
	            </li>";
	}
	?>
	        </ul>
	        <div class="clr"></div>
	    </div><!--end leftThink-->
	    <script type="text/javascript">
		jQuery(document).ready(function(){
	    	$("#leftThink ul").carouFredSel({
				circular: false,
				infinite: true,
				pagination: "#thinkPagi",
				auto 	: {
					pauseDuration : 5000,
					pauseOnHover: true
				},
				scroll	: {
					items	: 1,
					fx		: 'crossfade',
					duration: 500,
				},
				items : {
					height: "variable"
				}
			});
		});
	    </script>
	</div><!--end leftBox-->
	<div class="leftBox" id="leftTop">
    	<? $kind=25;$qr=mysql_query("select * from tbl_page where kind='$kind'");
		if (@mysql_num_rows($qr)){if($se_lang=="eng")echo outputdata(@mysql_result($qr,0,'content_en')); else echo outputdata(@mysql_result($qr,0,'content'));}?>
	</div><!--end leftBox-->
</div><!--end leftGroup right-->
<div class="clr"></div>