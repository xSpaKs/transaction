<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = explode("transaction", $url)[1];
$url = explode("?", $url)[0];


switch($url)
{
    case '/' :
        include 'home.php';
        break;

    case '/login' : 
        include 'login.php';
        break;

    case '/register' : 
        include 'register.php';
        break;

    case '/logout' : 
        include 'logout.php';
        break;

    case '/transactions' : 
        include 'transactions.php';
        break;

    case '/transactions/edit' : 
        include 'transactions/edit.php';
        break;

    case '/transactions/update' : 
        include 'transactions/update.php';
        break;

    case '/transactions/delete' : 
        include 'transactions/delete.php';
        break;

    default : break;

}