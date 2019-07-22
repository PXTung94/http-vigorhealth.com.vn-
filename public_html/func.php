<?

	function strip_unicode($str)

	{

		if (!$str)

			return NULL;

		

		$unicode = array(

					'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),

					'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),

					'd'=>array('đ'),

					'D'=>array('Đ'),

					'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),

					'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),

					'i'=>array('í','ì','ỉ','ĩ','ị'),

					'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),

					'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),

					'O'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),

					'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),

					'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),

					'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),

					'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ')

				);

		

		foreach ($unicode as $non_unicode=>$uni)

		{

			foreach ($uni as $value)

			$str = str_replace($value,$non_unicode,$str);

		}

		

		return $str;

	}

	

	function utf_to_iso($str)

	{

		if (!$str)

			return false;

		

		$utf_code = array(

						'á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ',

						'Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ',

						'đ',

						'Đ',

						'é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ',

						'É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ',

						'í','ì','ỉ','ĩ','ị',

						'Í','Ì','Ỉ','Ĩ','Ị',

						'ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ',

						'Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ',

						'ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự',

						'Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự',

						'ý','ỳ','ỷ','ỹ','ỵ',

						'Ý','Ỳ','Ỷ','Ỹ','Ỵ'

					);

			

		$iso_code = array(

						'&aacute;','&agrave;','&#7843;','&atilde;','&#7841;','&#259;','&#7855;','&#7863;','&#7857;','&#7859;','&#7861;','&acirc;','&#7845;','&#7847;','&#7849;','&#7851;','&#7853;',

						'&Aacute;','&Agrave;','&#7842;','&Atilde;','&#7840;','&#258;','&#7854;','&#7862;','&#7856;','&#7858;','&#7860;','&Acirc;','&#7844;','&#7846;','&#7848;','&#7850;','&#7852;',

						'&#273;',

						'&#272;',

						'&eacute;','&egrave;','&#7867;','&#7869;','&#7865;','&ecirc;','&#7871;','&#7873;','&#7875;','&#7877;','&#7879;',

						'&Eacute;','&Egrave;','&#7866;','&#7868;','&#7864;','&Ecirc;','&#7870;','&#7872;','&#7874;','&#7876;','&#7878;',

						'&iacute;','&igrave;','&#7881;','&#297;','&#7883;',

						'&Iacute;','&Igrave;','&#7880;','&#296;','&#7882;',

						'&oacute;','&ograve;','&#7887;','&otilde;','&#7885;','&ocirc;','&#7889;','&#7891;','&#7893;','&#7895;','&#7897;','&#417;','&#7899;','&#7901;','&#7903;','&#7905;','&#7907;',

						'&Oacute;','&Ograve;','&#7886;','&Otilde;','&#7884;','&Ocirc;','&#7888;','&#7890;','&#7892;','&#7894;','&#7896;','&#416;','&#7898;','&#7900;','&#7902;','&#7904;','&#7906;',

						'&uacute;','&ugrave;','&#7911;','&#361;','&#7909;','&#432;','&#7913;','&#7915;','&#7917;','&#7919;','&#7921;',

						'&Uacute;','&Ugrave;','&#7910;','&#360;','&#7908;','&#431;','&#7912;','&#7914;','&#7916;','&#7918;','&#7920;',

						'&yacute;','&#7923;','&#7927;','&#7929;','&#7925;',

						'&Yacute;','&#7922;','&#7926;','&#7928;','&#7924;'

					);

		

		$str = str_replace($utf_code, $iso_code, $str);

		

		return $str;

	}



function sendsmtpmail($sender_name,$sender_email,$to_email,$to_name,$subject,$mess)

		{

			// example on using PHPMailer with GMAIL 

			require_once( dirname(__FILE__) . '/class.phpmailer.php' );

			require_once( dirname(__FILE__) . '/class.smtp.php' );

			

			$mail=new PHPMailer();

			

			$mail->IsSMTP();

			$mail->SMTPAuth   = true;                  // enable SMTP authentication

			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

			$mail->Port       = 465;                   // set the SMTP port 

			

			$mail->Username   = "no.reply.vuoncamxuc@gmail.com";  	// GMAIL username

			$mail->Password   = "no.reply.vuoncamxuc";           // GMAIL password

			

			$mail->From       = $sender_email;

			$mail->FromName   = $sender_name;

			$mail->Subject    = $subject;

			$mail->Body       = $mess;                      //HTML Body

			//$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body

			

			$mail->WordWrap   = 50; // set word wrap

			

			$mail->AddAddress($to_email,$to_name);

			$mail->AddReplyTo($sender_email,$sender_name);

			//$mail->AddAttachment("/path/to/file.zip");             // attachment

			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send())

				{

					echo "Mailer Error: " . $mail->ErrorInfo;

					return 0;

				}

			else

				{

					//echo "Done.";

					return 1;

				}	

		}

//sendsmtpmail("khong biet","thanghoa@yahoo.com","thanhchi43@yahoo.com","Phan na","khong biet","hahaha")

?>