<?php
namespace app\controllers;

use app\Router;
use app\models\Admin;
use Mailer;

class AdminController
{
    public function dashboard(Router $router){
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
                $router->renderView('admin/dashboard');
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /login' );
        }
       
    }

    public function agent_request(Router $router){
        // $requestData =[];
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
                $requestData = $router->db->getPendingRequest();
                $router->renderView('admin/agent_request',[
                    'allAgentRequest'=> $requestData
                ]);
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /login' );
        }
        
    }

    public function request_list(Router $router){
        // $requestData =[];
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
                $requestData = $router->db->getAllRequest();
                $router->renderView('admin/request_list',[
                    'allAgentRequest'=> $requestData
                ]);
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /login' );
        }
    }

    public function request_accept(Router $router){
        $user_id = $_GET['id'] ?? null;
        if(!$user_id){
            header('Location: /agent_request');
            exit;
        }
        $router->db->acceptRequest($user_id);
        $data = $router->db->getUserById($user_id);

        $adminEmail = 'oladepe1103@gmail.com';
            $email = $data['email_address'];
            // this message is going to the user now agent
            $data['message'] = ucwords("dear " .$data['last_name']." ".$data['first_name' ].":<br>").
            "<br>Good day! <br>".
            "<br>We trust this mail meets you well. This is to bring to your notice that you recently forgot your password. This new password has been randomly selected - ". $this->password.
            "<br>Please log in with this new password and reset as soon as possible.";
            $message = '';
            
            $contact = new Admin();
            $errors = $contact->save($data);
            
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
        header('Location: /request_list');
        // you can send a confirmation email using php mailer to the user
    }

    public function request_decline(Router $router){
        $user_id = $_GET['id'] ?? null;
        if(!$user_id){
            header('Location: /agent_request');
            exit;
        }
        $router->db->declineRequest($user_id);
        header('Location: /request_list');
        // you can inform the user that he or she was not accepted or dismembered 
    }
}