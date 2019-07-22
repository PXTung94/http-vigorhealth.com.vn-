    <? include("common.php");if (!eregi("index.php", $_SERVER['PHP_SELF'])){echo "
    <script>location.href = '$sub_root';</script>";exit;}?>

    <div id="colRight">
        <div class="pageNav">
            <ul>
                <li><a href="<?=$sub_root?>"><?=$lb_trangchu?></a></li>
                <li>&rsaquo;</li>
                <li><a href="<?=$sub_root?>/site-map">Tuyển dụng</a></li>
            </ul>
            <div class="clr"></div>
        </div>
        <style>
                ol li {
                    margin-left: 35px;
                }

                ol ol li {
                    list-style: circle;
                    padding: 5px;
                }
                
            <!--
            /* Font Definitions */
            @font-face {
                font-family: "Cambria Math";
                panose-1: 2 4 5 3 5 4 6 3 2 4;
            }

            @font-face {
                font-family: Calibri;
                panose-1: 2 15 5 2 2 2 4 3 2 4;
            }

            @font-face {
                font-family: Cambria;
                panose-1: 2 4 5 3 5 4 6 3 2 4;
            }
            /* Style Definitions */
            p.MsoNormal, li.MsoNormal, div.MsoNormal {
                margin-top: 0in;
                margin-right: 0in;
                margin-bottom: 10.0pt;
                margin-left: 0in;
                line-height: 115%;
                font-size: 11.0pt;
                font-family: "Calibri",sans-serif;
            }

            a:link, span.MsoHyperlink {
                color: blue;
                /* text-decoration: underline; */
            }

            a:visited, span.MsoHyperlinkFollowed {
                color: purple;
                text-decoration: underline;
            }

            p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph {
                margin-top: 0in;
                margin-right: 0in;
                margin-bottom: 10.0pt;
                margin-left: .5in;
                line-height: 115%;
                font-size: 11.0pt;
                font-family: "Calibri",sans-serif;
            }

            p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst {
                margin-top: 0in;
                margin-right: 0in;
                margin-bottom: 0in;
                margin-left: .5in;
                margin-bottom: .0001pt;
                line-height: 115%;
                font-size: 11.0pt;
                font-family: "Calibri",sans-serif;
            }

            p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle {
                margin-top: 0in;
                margin-right: 0in;
                margin-bottom: 0in;
                margin-left: .5in;
                margin-bottom: .0001pt;
                line-height: 115%;
                font-size: 11.0pt;
                font-family: "Calibri",sans-serif;
            }

            p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast {
                margin-top: 0in;
                margin-right: 0in;
                margin-bottom: 10.0pt;
                margin-left: .5in;
                line-height: 115%;
                font-size: 11.0pt;
                font-family: "Calibri",sans-serif;
            }

            .MsoChpDefault {
                font-family: "Calibri",sans-serif;
            }

            .MsoPapDefault {
                margin-bottom: 10.0pt;
                line-height: 115%;
            }

            @page WordSection1 {
                size: 8.5in 11.0in;
                margin: 22.5pt 45.0pt 0in 1.0in;
            }

            div.WordSection1 {
                page: WordSection1;
            }
            /* List Definitions */
            ol {
                margin-bottom: 0in;
            }

            ul {
                margin-bottom: 0in;
            }
            -->

            .button_btv {
                width: 49%;
                padding-top: 0.5rem;
                display: inline;
            }
            a.select_button.selected {
                background: linear-gradient(to bottom, #FF9A09 0%, #FF8200 100%) !important;
                color: white !important;
            }
            a.select_button {
                text-align: center;
                float: right;
                margin: 0 0 10px 10px;
                background: #DADADC;
                color: black !important;
                display: block;
                line-height: 30px;
                color: #fff;
                font-size: 15px;
                padding: 0 15px;
            }
            .datalist img{
                width: 100%;
            }
            .datalist {
                display: none;
            }
            .datalist.selected {
                display: block;
            }
        </style>

        <div class="WordSection1" style="padding: 0 20px 20px 20px;">
            <div id="button_select">
                <div class="button_btv">
                    <a class="select_button qlts btn selected" href="javascript:void(0)" data-rel = "qlts">Quản lý tiền sảnh</a>
                </div>
                <div class="button_btv">
                    <a class="select_button hs btn " href="javascript:void(0)" data-rel = "hs">Điều dưỡng đa khoa/Thư ký y khoa</a>
                </div>
                <div class="button_btv">
                    <a class="select_button st btn " href="javascript:void(0)" data-rel = "st">Sale thẻ</a>
                </div>
                <div class="button_btv">
                    <a class="select_button bhyt btn " href="javascript:void(0)" data-rel = "bhyt">BHYT</a>
                </div>
            </div>
            <div id="dashboard">
				<!-- END DASHBOARD STATS -->
				<div class="datalist qlts selected">
					<img src="http://vigorhealth.com.vn/images/ThongtintuyendungQUANLYTIENSANh.jpg" data-animate='fadeInUp' />
				</div>
				<div class="datalist hs ">
					<img src="http://vigorhealth.com.vn/images/ThongtintuyendungDDTKYK.jpg" data-animate='fadeInUp' />
				</div>
				<div class="datalist st ">
					<img src="http://vigorhealth.com.vn/images/Thongtintuyendungnvkdtheyte.jpg" data-animate='fadeInUp' />
				</div>
				<div class="datalist bhyt ">
					<img src="http://vigorhealth.com.vn/images/ThongtintuyendungBHYT.jpg" data-animate='fadeInUp' />
				</div>
			</div>
            <!-- ######## This is a comment, visible only in the source editor  ######## -->
            <!-- <div>
                <h2>Nh&acirc;n Vi&ecirc;n Digital Marketing</h2>
                <ol></ol>
            </div>
            <div>
                <div>
                    <div>
                        <div></div>
                    </div>
                    <div>
                        <ol style="list-style-type: upper-roman;">
                            <li>
                                <strong>M&Ocirc; TẢ C&Ocirc;NG VIỆC :</strong><strong></strong>
                                <ol>
                                    <li>Am hiểu Google Adwords, chạy Google Adwords.</li>
                                    <li>Am hiểu c&aacute;c ch&iacute;nh s&aacute;ch của Google Adwords gi&aacute; đấu thầu từ kh&oacute;a keyword.</li>
                                    <li>Biết SEO Web để tăng xếp hạng t&igrave;m kiếm của Google.</li>
                                    <li>Biết chạy&nbsp;<a href="https://vieclam24h.vn/tiep-thi-quang-cao-c36.html" title="quảng c&aacute;o">quảng c&aacute;o</a>&nbsp;facebook hiểu quả về chi ph&iacute; v&agrave; tăng sự tương t&aacute;c.</li>
                                    <li>Viết b&agrave;i, bi&ecirc;n tập, kiểm so&aacute;t v&agrave; quản l&yacute; nội dung website, fanpage facebook&nbsp;của C&ocirc;ng ty.</li>
                                    <li>Quản l&yacute; chi ph&iacute;, kiểm tra, gi&aacute;m s&aacute;t c&aacute;c hoạt động Marketing Online.</li>
                                    <li>Tăng lượng tương t&aacute;c tr&ecirc;n c&aacute;c trang mạng x&atilde; hội (Facebook, G+ , Linked , Twitter, youtube&hellip;)</li>
                                    <li>Viết b&agrave;i tr&ecirc;n diễn đ&agrave;n / blog / trang web để tăng kết quả SEO Web</li>
                                    <li>Ph&acirc;n t&iacute;ch cơ chế SEO Web để cập nhật đưa ra kế hoạch SEO&nbsp;để duy tr&igrave; thứ hạng Website tr&ecirc;n trang t&igrave;m kiếm Google.</li>
                                    <li>Thiết kế v&agrave; phối hợp với ph&ograve;ng lập tr&igrave;nh l&agrave;m lại Website c&ocirc;ng ty theo chuẩn SEO.</li>
                                    <li>Đ&oacute;ng g&oacute;p &yacute; tưởng để cải thiện lượng truy cập cho website c&ocirc;ng ty v&agrave; theo chuẩn đ&aacute;nh gi&aacute; của Google.</li>
                                    <li>Phối hợp với c&aacute;c bộ phận&nbsp;<a href="https://vieclam24h.vn/nhan-vien-kinh-doanh-c96.html" title="kinh doanh">kinh doanh</a>, chăm s&oacute;c kh&aacute;ch h&agrave;ng để l&agrave;m c&aacute;c chiến dịch quảng c&aacute;o online hay chiến dịch marketing hiểu quả nhất. quảng b&aacute; thương hiệu c&ocirc;ng ty đến nhiều người biết đến.<strong></strong></li>
                                </ol>
                            </li>
                            
                            <li>
                                <strong>Y&Ecirc;U CẦU ỨNG VI&Ecirc;N :</strong>
                                <ol>
                                    <li>C&oacute; &iacute;t nhất 02 năm kinh nghiệm l&agrave;m việc tại vị tr&iacute; tương đương, ưu ti&ecirc;n ứng vi&ecirc;n c&oacute; kinh nghiệm trong ng&agrave;nh y tế, sức khỏe v&agrave; biết chạy chiến dịch Social Media.</li>
                                    <li style="font-weight: 400;">Khả năng nghe, n&oacute;i, đọc, viết tiếng Anh tốt.</li>
                                    <li style="font-weight: 400;">Am hiểu về SEO Web, về c&aacute;c thuật to&aacute;n t&igrave;m kiếm v&agrave; c&aacute;ch thức SEO Web tối ưu h&oacute;a từ kh&oacute;a t&igrave;m kiếm để đưa Website ở vị tr&iacute; TOP của trang t&igrave;m kiếm Google bền vững.</li>
                                    <li style="font-weight: 400;">C&oacute; kiến thức v&agrave; khả năng Thiết kế trang Web tĩnh bằng HTML5 hoặc HTML / CSS3 / JS theo chuẩn SEO Web.<span>&nbsp;</span></li>
                                    <li style="font-weight: 400;">C&oacute; t&iacute;nh S&aacute;ng tạo, tinh thần ham học hỏi, l&agrave;m việc nh&oacute;m v&agrave; khả năng chịu &aacute;p lực trong c&ocirc;ng việc.</li>
                                    <li style="font-weight: 400;"><span>&nbsp;</span>Khả năng l&agrave;m việc trong m&ocirc;i trường Chăm S&oacute;c Kh&aacute;ch H&agrave;ng.</li>
                                </ol>
                            </li>
                          
                            <li>
                                <b>QUYỀN LỢI :&nbsp;</b>
                                <ol>
                                    <li style="font-weight: 400;">Lương thỏa thuận.</li>
                                    <li style="font-weight: 400;"><span></span>Hợp đồng lao động, BHXH, BHYT, BHTN, du lịch nghĩ dưỡng hằng năm v&agrave; c&aacute;c chế độ lao động theo quy định.</li>
                                    <li style="font-weight: 400;"><span></span>Được đ&agrave;o tạo trong m&ocirc;i trường chuy&ecirc;n nghiệp, ti&ecirc;u chuẩn Quốc tế.</li>
                                    <li style="font-weight: 400;"><strong><span></span></strong><strong><u>H&Igrave;NH THỨC NỘP HỒ SƠ:&nbsp;</u></strong><span></span>Trực tiếp tại Ph&ograve;ng kh&aacute;m đa khoa Quốc tế Vigor Health, địa chỉ: Lầu 4, TN Miss &Aacute;o D&agrave;i, số 21 Nguyễn Trung Ngạn, Phường Bến Ngh&eacute;, Quận 1, TP.HCM.<span style="color: #ff0000;"></span></li>
                                    <li style="font-weight: 400;"><span style="color: #ff0000;">Thời gian nộp hồ sơ</span> :<strong>30/04/2018.</strong><strong></strong></li>
                                    <li style="font-weight: 400;"><span></span>Email:<span>&nbsp;</span><a href="mailto:nhansu@healthcare.com.vn">nhansu@healthcare.com.vn</a></li>
                                    <li style="font-weight: 400;"><span></span>Mọi thắc mắc li&ecirc;n hệ: Mrs. Cẩm V&acirc;n- 0918 600 199/ Ms. Ngọc Hiền &ndash; 0911 560 505.<b></b></li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div> -->
            <hr />
        </div>
        <!--end showText-->
        <div class="clr"></div>
    </div><!--end colRight-->

<script type="text/javascript">
	$("a.select_button").click(function(e) {
        $('a.select_button').removeClass('selected');
        $('a.select_button.' + $(this).data('rel')).addClass('selected');
        $('.datalist').removeClass('selected');
        $('.datalist.' + $(this).data('rel')).addClass('selected');
    });
	
	
</script>