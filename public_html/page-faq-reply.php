<? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "<script>location.href='$sub_root';</script>";exit;}?>
<div id="colRight">
	<div class="pageNav">
    	<ul>
    		<li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
            <li>&rsaquo;</li>
    		<li><a href="<?=$sub_root?>/dien-dan"><?=$lb_diendan?></a></li>
    	</ul>
        <div class="clr"></div>
        <div class="rightTitle"><h1><?=$lb_diendan?></h1></div>
    </div>
	<?
	$sql_list = mysql_query("select * from  tbl_news where (a_of=1) and (a_name_no='$snewsid') and (c_kind='$sckind')");
	if (!(@mysql_num_rows($sql_list))){echo "<script>location.href='$sub_root';</script>";exit();}
	$rows = mysql_fetch_array($sql_list);
		$a_pic = $rows[a_pic];$a_id = $rows[a_id];$a_sort = $rows[a_sort];
		if($se_lang=="eng"){$a_name = outputdata($rows[a_name_en]);$a_des = outputdata($rows[a_des_en]);}
		else{$a_name = outputdata($rows[a_name]);$a_des = outputdata($rows[a_des]);}
				
		$sql_picogiua = mysql_query("select * from tb_hinhgiuatin where a_id='$a_id' order by n_vitri");
		while($rowspic = mysql_fetch_array($sql_picogiua)){
			$n_vitri = $rowspic[n_vitri];
			$p_pic = $rowspic[p_pic];
			$chuoitim="&quot;{{image".$n_vitri."}}&quot;";
			$chuoithay="'"."$sub_multidata/".$p_pic."'";
			$a_des=str_replace($chuoitim,$chuoithay,$a_des);
			$chuoitim="{{image".$n_vitri."}}";
			$chuoithay="$sub_multidata/".$p_pic;
			$a_des=str_replace($chuoitim,$chuoithay,$a_des);
		}
		$a_des=str_replace("&quot;",'"',$a_des);	

	?>
    <div id="showText" class="textInside newsView">
    	<h1 class="linkName"><?=$a_name?></h1>
         <?=$a_des?>
        <div class="clr"></div>
    </div><!--end showText-->
    <div class="clr"></div>
    <div class="pageNav"><div class="rightTitle"><h1><?=$lb_phanhoi?></h1></div></div>
    <a name="anchor" id="replyFaq"></a>
    <div id="comment">
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            var disqus_shortname = 'vigorhealth'; 
        
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <div class="clr"></div>
    </div><!--end comment-->
	<div class="clr"></div>
</div><!--end colRight-->