<?php
namespace app\controllers;

use app\Router;
use app\models\Property;
use Mailer;
use app\functions\RandomFunction;

class PropertyController
{
    public function create(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
                
            $errors =[];
        $propertyData =[
            'property_image' => '',
            'property_price' > '',
            'description' => '',
            'property_address' => '',
            'property_status' => '',
            'property_type' => '',
            'bed' => '',
            'bath' => '',
            'kitchen' => '',
            'unique_code' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                /* echo'<pre>';
                var_dump($_FILES['property_image']);
                echo'</pre>';
            die(); */
                $propertyData['propertyFile'] = $_FILES['property_image'] ?? null;
                $propertyData['property_image'] = $_POST['property_image'] ?? null;
                $propertyData['property_address'] = $_POST['property_address'];
                $propertyData['property_status'] = $_POST['property_status'];
                $propertyData['property_type'] = $_POST['property_type'];
                $propertyData['description'] = $_POST['description'];
                $propertyData['property_price'] = (float)$_POST['property_price'];
                $propertyData['bed'] = (int)$_POST['bed'];
                $propertyData['bath'] = (int)$_POST['bath'];
                $propertyData['kitchen'] = (int)$_POST['kitchen'];
                $propertyData['unique_code'] = RandomFunction::randomString(5);

                $property = new Property();
                $property->load($propertyData);
                $errors = $property->save();
                if(empty($errors)){
                    header('Location: /agent_actions');
                    exit;
                }
            }
                
        
        $router->renderView('property/create', [
            'property' => $propertyData,
            'errors' => $errors
        ]);
        }else{
            header('Location: /properties');
            exit;
        }
        }else{
            header('Location: /login');
            exit;
        }
    }

    public function showActions(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 2){
                $property =  $router->db->getProperty();
        
                $router->renderView('property/property_actions', [
                    'property' => $property
                ]);
            }else{
                header('Location: /properties' );
            }
        }else{
            header('Location: /login' );
        }
        
    }

    public function showAgentActions(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
                $property =  $router->db->getPropertyByAgent();
                $router->renderView('property/property_actions', [
                    'property' => $property
                ]);
            }else{
                header('Location: /agent_actions' );
            }
        }else{
            header('Location: /login' );
        }
        
    }
   

    public function update(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
            
            $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }
        $errors =[];
        $propertyData = $router->db->getPropertyById($id);
        $UniqueCode = $propertyData['unique_code'];
        $images =  $router->db->getimagesByUniqueCode($UniqueCode);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propertyData['propertyFile'] = $_FILES['property_image'] ?? null;
            $propertyData['imagePath'] = $images->imagePath ?? null;
           
            $propertyData['property_address'] = $_POST['property_address'];
            $propertyData['property_status'] = $_POST['property_status'];
            $propertyData['property_type'] = $_POST['property_type'];
            $propertyData['description'] = $_POST['description'];
            $propertyData['property_price'] = (float)$_POST['property_price'];
            $propertyData['bed'] = (int)$_POST['bed'];
            $propertyData['bath'] = (int)$_POST['bath'];
            $propertyData['kitchen'] = (int)$_POST['kitchen'];
            
            $property = new Property();
            $property->load($propertyData);
            $errors = $property->save();
            if(empty($errors)){
                header('Location: /agent_actions');
                exit;
            }
        }
    
        $router->renderView('property/update', [
            'property' => $propertyData,
            'images' => $images,
            'errors' => $errors
        ]);
     }else{
        header('Location: /properties');
        exit;
     }
    }else{
        header('Location: /login');
        exit;
    }
    }

    public function update_image(Router $router){
        
        if(loggedIn()){
            $UniqueCode= $_GET['id'] ?? null;
                if(!$UniqueCode){
                    header('Location: /agent_actions');
                    exit;
                }
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // This gets the folder name from the image path
                   $FolderName[] = explode('/',$_POST['imagePath']);
                   foreach ($FolderName as $FolderName){
                    $imageData['FolderName'] = $FolderName[1];
                   }
                    
                    $imageData['propertyFile'] = $_FILES['property_image'] ?? null;
                    $imageData['unique_code'] = $UniqueCode ?? null;

                    if(!$imageData['propertyFile'] || !$imageData['FolderName'] || !$imageData['unique_code']){
                        header('Location: /agent_actions');
                        exit;
                    }
                    
                    $property = new Property();
                    $property->load_image($imageData);
                    $property->save_image();
                    header("Location: /property/update_image?id=$UniqueCode");
                }
                    $images =  $router->db->getimagesByUniqueCode($UniqueCode);
                    
                    $router->renderView('property/update_image', [
                        'images' => $images
                    ]);
                
            }else{
                header('Location: /properties');
            exit;
            }
        }else{
            header('Location: /login');
            exit;
        }
        
    }


    public static function delete_image(Router $router)
    {
        $imageData['id'] = $_POST['image_id'] ?? null;
        $imageData['imagePath'] = $_POST['imagePath'] ?? null;
        $imageData['unique_code'] = $_POST['unique_code'] ?? null;
        
        if(!$imageData['id'] || !$imageData['imagePath'] || !$imageData['unique_code']){
            header('Location: /agent_actions');
            exit;
        }

        $property = new Property();
            $property->load_image($imageData);
            $property->save_image();
        $router->db->deleteImage($imageData['id']);
        // this will go back to the last page
        $UniqueCode = $_POST['unique_code'];
        header("Location: /property/update_image?id=$UniqueCode");
    }

    public static function delete(Router $router)
    {
        $property_id = $_POST['property_id'] ?? null;
        $imageData['unique_code'] = $_POST['unique_code'] ?? 'null';

        if(!$property_id || !$imageData['unique_code']){
            header('Location: /agent_actions');
            exit;
        }

        // this deletes the selected property from the database
        $router->db->deleteProperty($property_id);

            $property = new Property();
            // this gets all the images fom the image table to be deleted, unlinks them and delete all from the database
            $images =  $router->db->getimagesByUniqueCode($imageData['unique_code']);
            foreach ($images as $image){
                $imageData['imagePath'] = $image['imagePath'];
                $property->load_image($imageData);
                $property->save_image();
                $router->db->deleteAllImage($imageData['unique_code']);
            }  
            // end 
            if($_SESSION['roleId'] == 3){
                header('Location: /agent_actions');
            }else{
                header('Location: /properties');
            }
        
    }
    
    public function properties(Router $router)
    {
        $property =  $router->db->getProperty();
        $router->renderView('property/properties', [
            'property' => $property
        ]);
    }
    
    public function single_property(Router $router){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /properties');
            exit;
        }

        $property =  $router->db->getPropertyById($id);
        // this gets all the images using the unique code
        $UniqueCode = $property['unique_code'];
        $images =  $router->db->getimagesByUniqueCode($UniqueCode);

        $router->renderView('property/property-single', [
            'property' => $property,
            'images' => $images
        ]);
    }

    public function request_mail(Router $router)
    {
         
        $property_id = $_POST['request_id'];
           
            if(!$property_id){
                header('Location: /properties');
                exit;
            }

            // $properties =  $router->db->getAgentByProperty($property_id);
            // echo "<pre>";
            // var_dump($properties);
            // echo "</pre>";
            $property =  $router->db->getpropertyById($property_id);
             /* echo "<pre>";
            var_dump($property);
            echo "</pre>"; */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(loggedIn()){
                $FolderNamedminEmail = 'oladepe1103@gmail.com';
                $FolderNamegentEmail = 'peteroffodile@gmail.com';
                $email = $_SESSION['email'];
                $message = ucwords($_SESSION['last_name']." ".$_SESSION['first_name' ]) . " ( email address: ". $email. " Phone no: ". $_SESSION['phone_no']. " ) ". " requested for property". 
                
                "<br>Address: ".$property['property_address'].
                "<br>status: ".$property['property_status'].
                "<br>type: ".$property['property_type'].
                "<br><br>The agent in charge of this property is ".ucwords($property['last_name']." ".$property['first_name'])." with user id ".$property['id'];
                // die(var_dump($property_id));
                
                
                    $mail = new Mailer();
                    $mail->receiver = $FolderNamedminEmail;
                    $mail->reciever2 = $FolderNamegentEmail;
                    $mail->subject = "Property Request";
                    $template = $mail->mailTemplate();
                    $sitename = 'Agnes.con';
        
                    $mail->body = $mail->inject($template, $sitename, "Property Request <br> ", " $message <br><br> Thanks <br> from $sitename...");
                    //  die($mail->body);		
                        if($mail->sendmessage()){
                            
                            header('Location: /property/request_message');
                            exit;
                        }else{
                            die('not sent');
                            exit;
                                // die(' not sent'); 
                            }
            }else{
                header('Location: /login');
                exit;
            }
            
             
				
            
        } 
    }

    public function request_message(Router $router){
        $router->renderView('property/request');
    }
    
}