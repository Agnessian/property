<?php
namespace app;

use PDO;
use app\models\Property;
use app\models\Users;
use app\models\Admin; 
use app\models\Agent;
class Database
{
    public static Database $db;
    public function __construct()
    
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=property_crud', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        self::$db = $this;
    
    } 

    public function  getproperty($search = '')
    {
        // INNER JOIN users ON property.user_id = users.id
        if($search){
            $statement = $this->pdo->prepare('SELECT * FROM property INNER JOIN property_image ON property.unique_code = property_image.unique_code WHERE property_address LIKE :property OR property_type LIKE :property GROUP BY property.unique_code ORDER BY property.created_time DESC');
            $statement->bindValue(':property', "%$search%");
        } else{
             $statement = $this->pdo->prepare('SELECT * FROM property LEFT JOIN property_image ON property.unique_code = property_image.unique_code  GROUP BY property.unique_code ORDER BY property.created_time DESC');
        }
            $statement -> execute();
            return $statement -> fetchAll(PDO::FETCH_ASSOC);

    }



    public function getPropertyByAgent($id = '' ){
        if(!$id){
            $statement= $this->pdo->prepare ("SELECT * FROM property LEFT JOIN users ON property.user_id = users.id LEFT JOIN property_image ON property.unique_code = property_image.unique_code WHERE user_id = :user_id GROUP BY property.unique_code ORDER BY property.created_time DESC");
            $statement->bindValue(':user_id', $_SESSION['userId']);
        }else{
            $statement= $this->pdo->prepare ("SELECT * FROM property LEFT JOIN users ON property.user_id = users.id LEFT JOIN property_image ON property.unique_code = property_image.unique_code WHERE user_id = :user_id GROUP BY property.unique_code ORDER BY property.created_time DESC");
            $statement->bindValue(':user_id', $id);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function  getAgentByProperty($property_id){
            $statement= $this->pdo->prepare ("SELECT * FROM property INNER JOIN users ON property.user_id = users.id WHERE property_id = :property_id ORDER BY users.id DESC");
            $statement->bindValue(':property_id', $property_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
    public function getpropertyById($id)
    {
        $statement= $this->pdo->prepare ('SELECT * FROM property INNER JOIN property_image ON property.unique_code = property_image.unique_code INNER JOIN users ON property.user_id = users.id WHERE property_id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function getimagesByUniqueCode($UniqueCode)
    {
        $statement= $this->pdo->prepare ('SELECT * FROM property_image  WHERE unique_code = :UniqueCode');
        $statement->bindValue(':UniqueCode', $UniqueCode);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function createproperty(property $property)
    {
        $statement = $this->pdo->prepare("INSERT INTO property ( user_id, unique_code, description, property_price, property_address, bed, bath, kitchen, property_status, property_type, created_time)
                                                         VALUES(:agent_id, :unique_code, :description, :property_price, :property_address, :bed, :bath, :kitchen,  :property_status, :property_type, :date)"); 
        $statement->bindValue(':agent_id', $_SESSION['userId']);
        $statement->bindValue(':unique_code', $property->unique_code);
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':property_price', $property->property_price);
        $statement->bindValue(':property_address', $property->property_address);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':kitchen', $property->kitchen);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':property_type', $property->property_type);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $yes = $statement->execute();
        if($yes){
            
            foreach($property->imagePath as $i => $image ){
                // var_dump($image);
                $code = $property->unique_code;
                $statement= $this->pdo->prepare ("INSERT INTO property_image(imagePath, unique_code)
                                                                        VALUES(:imagePath, :unique_code)");
                $statement->bindValue(':imagePath', $image);
                $statement->bindValue(':unique_code', $code);
                $statement->execute();
            }/* die(); */
            
        }
    }

    public function updateproperty(property $property)
    {
        $statement = $this->pdo->prepare("UPDATE property SET 
                                description=:description,
                                property_price=:property_price,
                                property_address=:property_address,
                                bed=:bed,
                                bath=:bath,
                                kitchen=:kitchen,
                                property_status=:property_status, 
                                property_type=:property_type WHERE property_id=:property_id"); 
        $statement->bindValue(':description', $property->description);
        $statement->bindValue(':property_price', $property->property_price);
        $statement->bindValue(':property_address', $property->property_address);
        $statement->bindValue(':bed', $property->bed);
        $statement->bindValue(':bath', $property->bath);
        $statement->bindValue(':kitchen', $property->kitchen);
        $statement->bindValue(':property_status', $property->property_status);
        $statement->bindValue(':property_type', $property->property_type);
        $statement->bindValue(':property_id', $property->property_id);
        $statement->execute();
    }

    public function deleteProperty($property_id)
    {
        $statement = $this->pdo->prepare('DELETE FROM property WHERE property_id =:property_id');
        $statement->bindValue(':property_id', $property_id);
        $statement->execute();
    }

    public function deleteImage($id)
    {
            $statement = $this->pdo->prepare('DELETE FROM property_image WHERE id =:id');
            $statement->bindValue(':id', $id);
            $statement->execute();
        
    }

    public function deleteAllImage($UniqueCode)
    {
            $statement = $this->pdo->prepare('DELETE FROM property_image WHERE unique_code =:unique_code');
            $statement->bindValue(':unique_code', $UniqueCode);
            $statement->execute();
        
    }
    // we are creating new images while the user thinks he/she is updating
    public function updateImage(property $property)
    {
        foreach($property->imagePath as $i => $image ){
            $code = $property->unique_code;
            $statement= $this->pdo->prepare ("INSERT INTO property_image(imagePath, unique_code)
                                                                    VALUES(:imagePath, :unique_code)");
            $statement->bindValue(':imagePath', $image);
            $statement->bindValue(':unique_code', $code);
            $statement->execute();
        }
    }

    public function CreateUser(Users $Users){
        $role_id =1;
        
        $statement = $this->pdo->prepare("INSERT INTO users ( first_name, last_name, email_address, phone_no, password, user_image, role_id)
                                                         VALUES(:first_name, :last_name, :email, :phone_no, :password, :user_image, :role_id)"); 
        $statement->bindValue(':first_name', $Users->first_name);
        $statement->bindValue(':last_name', $Users->last_name);
        $statement->bindValue(':email', $Users->email);
        $statement->bindValue(':phone_no', $Users->phone_no);
        $statement->bindValue(':user_image', $Users->imagePath);
        $statement->bindValue(':password', $Users->password);
        $statement->bindValue(':role_id', $role_id);
        $statement->execute();
    }

    public function updateUser(Users $Users)
    {
        $statement = $this->pdo->prepare("UPDATE users SET 
                                first_name=:first_name,
                                last_name=:last_name,
                                email_address=:email,
                                phone_no=:phone_no,
                                user_image=:user_image WHERE id=:id"); 
        $statement->bindValue(':first_name', $Users->first_name);
        $statement->bindValue(':last_name', $Users->last_name);
        $statement->bindValue(':email', $Users->email);
        $statement->bindValue(':phone_no', $Users->phone_no);
        $statement->bindValue(':user_image', $Users->imagePath);
        $statement->bindValue(':id', $Users->id);
        $statement->execute();
    }

    public function updateSocials(Users $Users)
    {
        $statement = $this->pdo->prepare("UPDATE users SET 
                                instagram=:instagram,
                                twitter=:twitter,
                                facebook=:facebook,
                                linkedin=:linkedin WHERE id=:id"); 
        $statement->bindValue(':instagram', $Users->instagram);
        $statement->bindValue(':twitter', $Users->twitter);
        $statement->bindValue(':facebook', $Users->facebook);
        $statement->bindValue(':linkedin', $Users->linkedin);
        $statement->bindValue(':id', $Users->id);
        $statement->execute();
    }
// this update password is for reset since the person is logged in already
    public function updateUserPassword(Users $users)
    {
        $statement = $this->pdo->prepare("UPDATE users SET 
                                password=:password WHERE id=:id"); 
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':id', $this->id);
        $statement->execute();
    }

    // this update password is for forgot password s
    public function updateForgotPassword(Users $users)
    {
        $statement = $this->pdo->prepare("UPDATE users SET 
                                password=:password WHERE id=:id"); 
        $statement->bindValue(':password', $users->password);
        $statement->bindValue(':id', $users->id);
        $statement->execute();
    }

    public function getAllUsers($search='')
    {
        if($search){
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE email_address LIKE :search  ORDER BY id DESC');
            $statement->bindValue(':search', "%$search%");
        } else{
            $statement= $this->pdo->prepare ("SELECT * FROM  users ORDER BY id DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $statement= $this->pdo->prepare ('SELECT * FROM users WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function getUser($email, $password){
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email_address = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $hashpass = $row['password'] ?? null;
        if (password_verify($password, $hashpass)) {
            return $row;
        } else {
            return false;
        }
    }
// this gets all the email in the database
    public function getEmail($email){
        $statement = $this->pdo->prepare('SELECT email_address FROM users WHERE email_address = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
    }
// this is to verify if the user is using the same email when updating
    public function getUserEmail(){
        $statement = $this->pdo->prepare('SELECT email_address FROM users WHERE id = :id');
        $statement->bindValue(':id', $_SESSION['userId']);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    // this gets the user by email when user forgets password
    public function getUserByEmail($email){
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email_address = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createRequest(Users $Users){
       (int) $status=1;
        /* 1 means pending(request) */
        $statement = $this->pdo->prepare("INSERT INTO agent_request (reason, years_of_experience, user_id, status, agent_description)
                                                         VALUES(:reason, :years_of_experience, :user_id, :status, :description)"); 
        $statement->bindValue(':reason', $Users->reason);
        $statement->bindValue(':years_of_experience', $Users->years_of_experience);
        $statement->bindValue(':user_id', $_SESSION['userId']);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':description', $Users->description);
        $statement->execute();
    }


    public function getPendingRequest()
    {
        (int)$status = 1;
        $join_str = "agent_request INNER JOIN users ON users.id=agent_request.user_id";
        $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN users ON agent_request.user_id = users.id WHERE status = :status ORDER BY agent_request.id DESC");
        // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
        $statement->bindValue(':status', $status);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAllRequest()
    {
        $join_str = "agent_request INNER JOIN users ON users.id=agent_request.user_id";
        $statement= $this->pdo->prepare ("SELECT * FROM agent_request INNER JOIN users ON agent_request.user_id = users.id ORDER BY agent_request.id DESC");
        // $statement= $this->pdo->prepare ("SELECT * FROM $join_str ORDER BY agent_request.id DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function checkAgentRequestExist($userId)
    {
        $statement = $this->pdo->prepare('SELECT user_id FROM agent_request WHERE user_id = :userId');
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function acceptRequest($user_id)
    {
        (int) $status = 2;

        $statement = $this->pdo->prepare("UPDATE agent_request SET status=:status WHERE user_id = :user_id"); 
        $statement->bindValue(':status', $status);
        $statement->bindValue(':user_id', $user_id);
        $yes = $statement->execute();
        if($yes == 1){
            $role_id = 3;
            $statement = $this->pdo->prepare("UPDATE users SET role_id = :role_id WHERE id = :user_id"); 
            $statement->bindValue(':role_id', $role_id);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
        }
    }

    public function declineRequest($user_id)
    {
        (int) $status = 3;

        $statement = $this->pdo->prepare("UPDATE agent_request SET status=:status WHERE user_id=:user_id"); 
        $statement->bindValue(':status', $status);
        $statement->bindValue(':user_id', $user_id);
        $yes = $statement->execute();
        if($yes == 1){
            $role_id = 1;
            $statement = $this->pdo->prepare("UPDATE users SET role_id = :role_id WHERE id = :user_id"); 
            $statement->bindValue(':role_id', $role_id);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
        }
    }

    public function getAgents($search='')
    {
        $role_id =3;
        if($search){
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE email_address LIKE :search AND role_id = :role_id ORDER BY id DESC');
            $statement->bindValue(':search', "%$search%");
            $statement->bindValue(':role_id', $role_id);
        } else{
            $statement= $this->pdo->prepare ("SELECT * FROM  users WHERE role_id = :role_id ORDER BY id DESC");
            $statement->bindValue(':role_id', $role_id);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}