<?php
namespace app\models;

use app\Database;
use Mailer;

class Admin extends Database{
    public ?string $name= null;
    public ?string  $email = null;
    public ?string  $subject = null;
    public ?string  $message = null;

   /*  public function load(){
        $data['name = $data['name'];
        $data['email = $data['email_address'];
        $data['subject = $data['subject'];
        $data['message = $data['Message'];
    } */
    public function save($data){

        $adminEmail = 'oladepe1103@gmail.com';
        $email = $data['email'];
        $message = $data['message'];
        $subject = $data['subject'];
        
        if(empty($errors)){
            $mail = new Mailer();
            $mail->receiver = $adminEmail;
                    $mail->subject = $subject;
                    $template = $mail->mailTemplate();
                    $sitename = 'Agnes.con';
                    $mail->body = $mail->inject($template, $sitename, "Form Submission <br> ", " $message from $email. <br> Thanks <br> from $sitename...");
                    
                    if($mail->sendmessage()){
                        header('Location: /');
                        exit;
                    }else{
                        $errors = 'msg, An error might have occured';
                        header('Location: /contact_us');
                        exit;
                    }
            header('Location: /properties');
            exit;
        }
       
         return $errors;
    }
}