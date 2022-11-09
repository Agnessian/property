<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require '../vendor/autoload.php';


class Mailer{
    public $mail;
    public $receiver;
    public $receiver2;
    public $subject;
    public $body;

    public function __construct(){
        //Instantiation and passing `true` enables exceptions
        $this->mail = new PHPMailer(true);
    }

    public function sendmessage(){
        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                 //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'exactcapitalsfinance.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'admin@global-linksb.com';                     //SMTP username
            $this->mail->Password   = 'admin@global-linksb123';                               //SMTP password
            $this->mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $this->mail->setFrom('admin@global-linksb.com', 'My Real Estate Site');
            $this->mail->addAddress($this->receiver);               //Name is optional

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;

            $this->mail->send();
            
            if($this->receiver2){
                $this->mail->ClearAllRecipients();
                $this->mail->addAddress($this->receiver2);
                $this->mail->isHTML(true);
                $this->mail->Subject = $this->subject;
                $this->mail->Body    = $this->body;
                $this->mail->send();
            }

            return true;
        } catch (Exception $e) {
            
            //  return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return false;

        }
    }

    public function mailTemplate(){
        ob_start();
        require_once __DIR__ .'/../views/home/message'. '.php';
        return ob_get_clean();
    }

    public function inject($template, $sitetitle, $caption, $body)
    {
        $template = str_replace('[site_title]', $sitetitle, $template);
        $template = str_replace('[caption]', $caption, $template);
        $template = str_replace('[body]', $body, $template);
        $template = str_replace('[site_title]', $sitetitle, $template);

        return $template;
    }
    
}