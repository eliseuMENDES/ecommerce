<?php
 
namespace Hcode;

use Rain\Tpl;

class Mailer {
 
    $const USERNAME = "cursophp7code@gmail.com";
    $const PASSWORD = "<?password?>";
    $const NAME_FROM = "Hcode Store";

    private $mail;

	public function __construct($toAddress, $toName, $subject, $tplName, $data = array())
	{
     
        $config = array
      (
       "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/vies/email/",
       "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
       "debug"         => false
      );

      Tpl::configure( $config );

      $tpl = new Tpl;

      foreach ($data as $key => $value) {

      	$tpl->assign($key, $value)

      }

      $html = $tpl->draw($tplName ,true);

	  $this->mail = new \PHPMailer();

//Tell PHPMailer to use SMTP
$this->mail->isSMTP();

$this->mail->SMTPDebug = 0;

//Set the hostname of the mail server
$this->mail->Host = 'smtp.gmail.com';

$this->mail->Port = 465;

//Set the encryption mechanism to use:
$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$this->mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$this->mail->Username = Mailer::USERNAME;

//Password to use for SMTP authentication
$this->mail->Password = '<?senha?>';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
//$this->mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$this->mail->addAddress($toAddress, $toName);

//Set the subject line
$this->mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$this->mail->msgHTML($html);

//Replace the plain text body with one created manually
$this->mail->AltBody = 'This is a plain-text message body';


  }

  public function send()
  {

  	return $this->mail->send();
  }

}

?>