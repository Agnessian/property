<?php
namespace app\models;

use app\functions\Mailer;


class Home{

    public ?string $name= null;
    public ?string  $email = null;
    public ?string  $subject = null;
    public ?string  $message = null;

    public function load($data){
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->subject = $data['subject'];
        $this->message = $data['Message'];
    }
    public function save(){
        /* $errors =[];
        if (!$this->name || !$this->subject || !$this->email || !$this->message){
            $errors[] = 'All fields are required';
        } */

        $errors =[];
        if (!$this->name ){
            $errors[] = 'name';
        }
        if( !$this->subject){
            $errors[] = 'status';
        }
        if(!$this->email){
            $errors[] = 'type';
        }
        if(!$this->message){
            $errors[] = 'bed';
        }

        // $adminEmail = 'oladepe1103@gmail.com';
        // $email = $this->email;
        // $message = $this->message;
        // $subject = $this->subject;
        
       /*  if(empty($errors)){
            $db = Mailer::$db;
            $db->receiver = $adminEmail;
                    $db->subject = "Form Submission".$subject;
                    $template = $db->mailTemplate();
                    $sitename = 'Agnes.con';
                    $db->body = $db->inject($template, $sitename, "Form Submission <br> ", " $message from $email. <br> Thanks <br> from $sitename...");
                    
                    if($db->sendmessage()){
                        header('Location: /');
                        exit;
                    }else{
                        $errors = 'msg, An error might have occured';
                        header('Location: /contact_us');
                        exit;
                    }
            header('Location: /properties');
            exit;
        } */
       
         return $errors;
    }

}