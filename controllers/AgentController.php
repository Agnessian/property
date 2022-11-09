<?php
namespace app\controllers;

use app\Router;

class AgentController{

    public function agents(Router $router){
        if(loggedIn()){
            $search = $_GET['search'] ?? '';
            $agents =  $router->db->getAgents($search);
            $router->renderView('agents/agents',[
                'search'=>$search,
                'agents'=> $agents
             ]);
        }else{
            header('Location: /login' );
        }
        
    }

    public function dashboard(Router $router){
        if(loggedIn()){
            if($_SESSION['roleId'] == 3){
           $router->renderView('agents/dashboard'); 
            }
        }else{
            header('Location: /login' );
        }
        
    }

    public function showAgentProperty(Router $router)
    {
        if(loggedIn()){
            if($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 2){
                $id = $_GET['agent'] ?? null;
                if(!$id){
                    header('Location: /properties');
                    exit;
                }else{
                    $property =  $router->db->getPropertyByAgent($id);
                }

                $router->renderView('property/properties', [
                    'property' => $property
                ]);
            }else{
                header('Location: /' );
            }
        }else{
            header('Location: /login' );
        }
    }


}