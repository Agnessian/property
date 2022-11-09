<?php
namespace app\controllers;

use app\models\Home;

use app\Router;
use Mailer;

class HomeController{

    public function index(Router $router)
    {
        // die($_SESSION['roleId']. " ". $_SESSION['userId']);
        $search = $_GET['search'] ?? '';
        $property =  $router->db->getProperty($search);
        $agents =  $router->db->getAgents();
        $router->renderView('home/index', [
            'property' => $property,
            'search'=>$search,
            'agent'=>$agents
        ]);
    }

    public function contact(Router $router){
        $errors = [];
        $data = [
            'email' =>'',
            'name' => '',
            'subject' => '',
            'Message' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data['email'] = $_POST['email'];
                $data['name'] = $_POST['name'];
                $data['subject'] = $_POST['subject'];
                $data['Message'] = $_POST['Message'];

            $adminEmail = 'oladepe1103@gmail.com';
            $email = $data['email'];
            $message = $data['Message'];
            
            $contact = new Home();
            $contact->load($data);
            $errors = $contact->save();
            
            if(empty($errors)){
                $mail = new Mailer();
                $mail->receiver = $adminEmail;
				$mail->subject = "Form Submission".$data['subject'];
				$template = $mail->mailTemplate();
				$sitename = 'Agnes.con';
				$mail->body = $mail->inject($template, $sitename, "Form Submission <br> ", " $message from $email. <br> Thanks <br> from $sitename...");
						
					if($mail->sendmessage()){
                        header('Location: /');
                        exit;
					}else{
                        die('not sent');
                    }
            }
        }

        $router->renderView('home/contact', [
            'errors' => $errors
        ]);
    }

    public function about(Router $router){
        $router->renderView('home/about');
    }
}