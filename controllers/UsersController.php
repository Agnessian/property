<?php
namespace app\controllers;

use app\Router;
use app\models\Users;

class UsersController{
    public function login(Router $router){
        $errors = [];

        $userData = [
            'email' => '',
            'password' => ''
        ];

        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            $userData['email'] = $_POST['email'];
            $userData['password'] = $_POST['password'];

            $User = new Users();
            $User->load($userData);
            $errors = $User->validate_login();

            if(empty($errors)){
                if($_SESSION['roleId'] == 3){
                    header('location: /agent_dashboard');
                }elseif($_SESSION['roleId'] == 2){
                    header('location: /admin_dashboard');
                }else{
                    header('location: /');
                }
                
            }
        }
        $router->renderView('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }
   
    public function sign_up(Router $router){
        $errors = [];
        $userData = [
            'first_name' => '',
            'userFile' => '',
            'last_name' => '',
            'phone_no' => '',
            'password' => '',
            'confirm_password' => '',
            'email' => '',

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['first_name'] = $_POST['first_name'];
            $userData['userFile'] = $_FILES['user_image'];
            $userData['last_name'] = $_POST['last_name'];
            $userData['phone_no'] = (int)$_POST['phone_no'];
            $userData['password'] = $_POST['password'];
            $userData['confirm_password'] = $_POST['confirm_password'];
            $userData['email'] = $_POST['email'];

            $User = new Users();
                $User->load($userData);
                
                $errors = $User->validate_signup();
                if(empty($errors)){
                    header('Location: /login');
                    exit;
                } 
        }
        $router->renderView('users/sign_up',[
            'errors' => $errors,
            'user' => $userData
        ]);
    }

    public function settings(Router $router){
        if(loggedIn()){
                $errors = []; 
                    $id = $_SESSION['userId']; 
                
                if(!$id){
                    header('Location: /');
                    exit;
                }
                
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    
                    $userData['first_name'] = $_POST['first_name'];
                    $userData['userFile'] = $_FILES['file'] ?? null;
                    $userData['imagePath'] = $userData['image'] ?? null;
                    $userData['last_name'] = $_POST['last_name'];
                    $userData['phone_no'] = (int)$_POST['phone_no'];;
                    $userData['email'] = $_POST['email'];
                    $userData['id'] = $id;
// die($_POST['phone_no']);
                    $User = new Users();
                    $User->load($userData);
                    
                    $errors = $User->validate_update();
        
                    if(empty($errors)){
                        header('location: /settings');         
                    }
                }
                $router->renderView('users/settings', [
                    'user' => $userData,
                    'errors_info' => $errors
                ]);
        }else{
            header('location: /login');
        }
    }

    public function allUsers(Router $router){
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
            $search = $_GET['search'] ?? '';
            $users =  $router->db->getAllUsers($search);
            // i used the same file because it has the same structure needed for the data coming from the database
            $router->renderView('agents/agents',[
                'search'=>$search,
                'agents'=> $users
             ]);
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /login' );
        }
        
    }

    public function resetPassword(Router $router){
        if(loggedIn()){
                 $errors = [];
                        $id = $_SESSION['userId']; 

                    if(!$id){
                        header('Location: /');
                        exit;
                    }
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    $userData['confirm_password'] = $_POST['confirm_password'];
                    $userData['password'] = $_POST['password'];
                    $userData['id'] = $_SESSION['userId'];
        
                    $User = new Users();
                    $User->load($userData);
                    $errors = $User->reset_password();

                    
                }$router->renderView('users/settings', [
                        'user' => $userData,
                        'errors_password' => $errors
                    ]);
        }else{
            header('location: /login');
        }
    }

    public function updateSocials(Router $router){
        if(loggedIn()){

                $id = $_SESSION['userId']; 

            if(!$id){
                header('Location: /');
                exit;
            }
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    $userData['instagram'] = $_POST['instagram'];
                    $userData['twitter'] = $_POST['twitter'];
                    $userData['facebook'] = $_POST['facebook'];
                    $userData['linkedin'] = $_POST['linkedin'];
                    $userData['id'] = $_SESSION['userId'];

                    $User = new Users();
                    $User->load($userData);
                    $User->validate_socials();

                    header('location: /settings'); 
                }
        }else{
            header('Location: /login');
        }
    }

    public function user_settings(Router $router){
        if(loggedIn()){
                $errors = [];
                if($_SESSION['roleId'] == 2){
                    $id = $_GET['id'] ?? null;
                }
                
                if(!$id){
                    header('Location: /');
                    exit;
                }
                
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    
                    $userData['first_name'] = $_POST['first_name'];
                    $userData['userFile'] = $_FILES['file'] ?? null;
                    $userData['imagePath'] = $userData['image'] ?? null;
                    $userData['last_name'] = $_POST['last_name'];
                    $userData['phone_no'] = (int)$_POST['phone_no'];;
                    $userData['email'] = $_POST['email'];
                    $userData['id'] = $id;

                    $User = new Users();
                    $User->load($userData);
                    
                    $errors = $User->validate_update();
        
                    if(empty($errors)){
                        header('location: /settings');         
                    }
                }
                $router->renderView('users/user_settings', [
                    'user' => $userData,
                    'errors_info' => $errors
                ]);
        }else{
            header('location: /login');
        }
    }

    public function user_resetPassword(Router $router){
        if(loggedIn()){
                 $errors = [];
                 if($_SESSION['roleId'] == 2){
                    $id = $_GET['id'] ?? null;
                 }

                    if(!$id){
                        header('Location: /');
                        exit;
                    }
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    $userData['confirm_password'] = $_POST['confirm_password'];
                    $userData['password'] = $_POST['password'];
                    $userData['id'] = $id;
        
                    $User = new Users();
                    $User->load($userData);
                    $errors = $User->reset_password();

                    
                }$router->renderView('users/user_settings', [
                        'user' => $userData,
                        'errors_password' => $errors
                    ]);
        }else{
            header('location: /login');
        }
    }

    public function user_updateSocials(Router $router){
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
                $id = $_GET['id'] ?? null;
            }

            if(!$id){
                header('Location: /');
                exit;
            }
                $userData = $router->db->getUserById($id);
        
                if($_SERVER["REQUEST_METHOD"] === 'POST'){
                    $userData['instagram'] = $_POST['instagram'];
                    $userData['twitter'] = $_POST['twitter'];
                    $userData['facebook'] = $_POST['facebook'];
                    $userData['linkedin'] = $_POST['linkedin'];
                    $userData['id'] = $id;

                    $User = new Users();
                    $User->load($userData);
                    $User->validate_socials();

                    header('location: /user_settings'); 
                }
        }else{
            header('Location: /login');
        }
    }

    public function forgotPassword(Router $router){
        $errors = [];
        $userData = [
            'email' => '',

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['email'] = $_POST['email'];

            // this is for the model
                $User = new Users();
                $User->load($userData);
                $errors = $User->forgot_password();

                if(empty($errors)){
                    header('Location: /password_reset');
                    exit;
                } 
        }
        $router->renderView('users/forgot_password',[
            'errors' => $errors,
            'user' => $userData
        ]);
    }

    public function password_reset(Router $router){
        if(loggedIn()){
           $router->renderView('users/password_reset_message'); 
        }else{
            header('Location: /login');
        }
        
    }

// this is the agent request
    public function request(Router $router)
    {
        if(loggedIn()){
            $errors = [];
        $requestData =[
            'reason'=> '',
            'years_of_experience'=>'',
            'description'=>'',
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $result = $router->db->checkAgentRequestExist($_SESSION['userId']);
            // // die(var_dump($result));
            // if($result == 1){
            //     header('Location: /login'); 
            // }else{
                $requestData['reason'] = $_POST['reason'];
                $requestData['years_of_experience'] = (int)$_POST['years_of_experience'];
                $requestData['description'] = $_POST['description'];

                $User = new Users();
                    $User->load($requestData);
                    $errors = $User->validate_request();
                    if(empty($errors)){
                        header('Location: /');
                        exit;
                }
            // }
            
        }
       
             $router->renderView('users/request_form',[
            'errors' => $errors,
            'request' => $requestData
        ]);
       
        }else{
            header('location: /login');
        }
    }
    public function request_message(Router $router){
        $router->renderView('user/request');
    }

    public function log_out()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['roleId']);
        unset($_SESSION['email']);
        unset($_SESSION['last_name']);
        unset($_SESSION['first_name']);
        unset($_SESSION['phone_no']);
        unset($_SESSION['password']);
        unset($_SESSION['user_image']);
        session_destroy();
        header('location: /login');
    }
}