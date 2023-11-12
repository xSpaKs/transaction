<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = explode("exo2", $url)[1];
$url = explode("?", $url)[0];
$url = str_replace("/public", "", $url);

$method = $_SERVER['REQUEST_METHOD'];

switch($url)
{
    case '/' :
        include '../controllers/homeController.php';
        break;

    case '/login' : 
        include '../controllers/loginController.php';
        break;

    case '/register' : 
        include '../controllers/registerController.php';
        break;

    case '/logout' : 
        include '../controllers/logoutController.php';
        break;

    case '/transactions' : 
        include '../controllers/transactionController.php';
        break;

    case '/transactions/create' : 
        include '../controllers/transactionCreateController.php';
        break;

    case '/transactions/edit' : 
        include '../controllers/transactionEditController.php';
        break;

    case '/transactions/update' : 
        include '../controllers/transactionUpdateController.php';
        break;

    case '/transactions/delete' : 
        include '../controllers/transactionDeleteController.php';
        break;

    default : 
        include '../controllers/homeController.php';
        break;

}