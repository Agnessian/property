<?php

use app\controllers\PropertyController;
use app\controllers\HomeController;
use app\controllers\UsersController;
use app\controllers\AdminController;
use app\controllers\AgentController;
use app\Router;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__."/../functions/Helper.php";
require_once __DIR__."/../functions/Mailer.php";

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/contact_us', [HomeController::class, 'contact']);
$router->post('/contact_us', [HomeController::class, 'contact']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/property/create', [PropertyController::class, 'create']);
$router->get('/properties', [PropertyController::class, 'properties']);
$router->post('/property/create', [PropertyController::class, 'create']);
$router->get('/property/update', [PropertyController::class, 'update']);
$router->post('/property/update', [PropertyController::class, 'update']);
$router->get('/property_actions', [PropertyController::class, 'showActions']);
$router->get('/agent_actions', [PropertyController::class, 'showAgentActions']);
$router->post('/property/delete', [PropertyController::class, 'delete']);
$router->get('/users', [UsersController::class, 'allUsers']);
$router->get('/settings', [UsersController::class, 'settings']);
$router->post('/settings', [UsersController::class, 'settings']);
$router->post('/update_socials', [UsersController::class, 'updateSocials']);
$router->post('/reset_password', [UsersController::class, 'resetPassword']);
$router->get('/reset_password', [UsersController::class, 'resetPassword']);
$router->get('/forgot_password', [UsersController::class, 'forgotPassword']);
$router->post('/forgot_password', [UsersController::class, 'forgotPassword']);
$router->get('/password_reset', [UsersController::class, 'password_reset']);


$router->get('/user_settings', [UsersController::class, 'user_settings']);
$router->post('/user_settings', [UsersController::class, 'user_settings']);
$router->post('/user_update_socials', [UsersController::class, 'user_updateSocials']);
$router->post('/user_reset_password', [UsersController::class, 'user_resetPassword']);
$router->get('/user_reset_password', [UsersController::class, 'user_resetPassword']);

$router->get('/single_property', [PropertyController::class, 'single_property']);
$router->post('/property/request', [PropertyController::class, 'request_mail']);
$router->get('/property/request', [PropertyController::class, 'request_mail']);
$router->get('/property/request_message', [PropertyController::class, 'request_message']);
$router->get('/property/update_image', [PropertyController::class, 'update_image']);
$router->post('/property/update_image', [PropertyController::class, 'update_image']);
$router->post('/property/delete_image', [PropertyController::class, 'delete_image']);
$router->get('/login', [UsersController::class, 'login']);
$router->post('/login', [UsersController::class, 'login']);
$router->post('/sign_up', [UsersController::class, 'sign_up']);
$router->get('/sign_up', [UsersController::class, 'sign_up']);
$router->get('/request', [UsersController::class, 'request']);
$router->post('/request', [UsersController::class, 'request']);
$router->get('/log_out', [UsersController::class, 'log_out']);
$router->get('/agent_request', [AdminController::class, 'agent_request']);
$router->get('/request_list', [AdminController::class, 'request_list']);
$router->get('/admin_dashboard', [AdminController::class, 'dashboard']);
$router->get('/request_accept', [AdminController::class, 'request_accept']);
$router->get('/request_decline', [AdminController::class, 'request_decline']);
$router->get('/agent_dashboard', [AgentController::class, 'dashboard']);
$router->get('/agent_property', [AgentController::class, 'showAgentProperty']);
$router->get('/agents', [AgentController::class, 'agents']);


$router->resolve();