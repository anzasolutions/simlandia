<?php

/**
 * Perform mail send/receive actions.
 * @author anza
 * @version 11-06-2011
 */
class Mailer
{
	// this is dirty version and must be improved!
	public static function send($email, $subject, $message)
	{
		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
		$mail->IsSMTP(); // telling the class to use SMTP
		try
		{
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "andrzej.zalewski@gmail.com";  // GMAIL username
			$mail->Password   = "S1mL4nd_1981";            // GMAIL password
			$mail->AddReplyTo('name@yourdomain.com', '');
			$mail->AddAddress($email, '');
			$mail->SetFrom('simland@yourdomain.com', '');
			$mail->AddReplyTo('simland@yourdomain.com', '');
			$mail->Subject = $subject;
			$mail->AltBody = ''; // optional - MsgHTML will create an alternate automatically
			$mail->MsgHTML($message);
			$mail->Send();
		}
		catch (phpmailerException $e)
		{
			$e->errorMessage(); //Pretty error messages from PHPMailer
		}
		catch (Exception $e)
		{
			$e->getMessage(); //Boring error messages from anything else!
		}
	}
//	public static function send($email, $activation)
//	{
//		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
//		$mail->IsSMTP(); // telling the class to use SMTP
//		try
//		{
//			$mail->SMTPAuth   = true;                  // enable SMTP authentication
//			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
//			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
//			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//			$mail->Username   = "andrzej.zalewski@gmail.com";  // GMAIL username
//			$mail->Password   = "S1mL4nd_1981";            // GMAIL password
//			$mail->AddReplyTo('name@yourdomain.com', '');
//			$mail->AddAddress($email, '');
//			$mail->SetFrom('simland@yourdomain.com', '');
//			$mail->AddReplyTo('simland@yourdomain.com', '');
//			$mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
//			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
//			$mail->MsgHTML(URL::getInstance()->getCustomActionURL('auth', 'activate') . SLASH . $activation);
//			$mail->Send();
//		}
//		catch (phpmailerException $e)
//		{
//			$e->errorMessage(); //Pretty error messages from PHPMailer
//		}
//		catch (Exception $e)
//		{
//			$e->getMessage(); //Boring error messages from anything else!
//		}
//	}
}

?>