<?php

define('BP', __DIR__ . DIRECTORY_SEPARATOR);
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('session.gc_maxlifetime', 3600);


session_set_cookie_params(3600);
session_start();

require_once 'vendor/autoload.php';

$page = !empty($_GET['page']) ? $_GET['page'] : null;

try {
    switch ($page) {
        case 'create':
            $controller = new \Masha\Controller\TaskController();
            $controller->createAction();
            break;
        case 'create-post':
            $controller = new \Masha\Controller\TaskController();
            $controller->createPostAction();
            break;
        case 'edit':
            $controller = new \Masha\Controller\TaskController();
            $controller->editAction();
            break;
        case 'edit-post':
            $controller = new \Masha\Controller\TaskController();
            $controller->editPostAction();
            break;
        case 'login':
            $controller = new \Masha\Controller\AdminController();
            $controller->loginAction();
            break;
        case 'login-post':
            $controller = new \Masha\Controller\AdminController();
            $controller->loginPostAction();
            break;
        case 'logout':
            $controller = new \Masha\Controller\AdminController();
            $controller->logoutAction();
            break;
        case 'mark':
            $controller = new \Masha\Controller\TaskController();
            $controller->markAction();
            break;
        default:
            $controller = new \Masha\Controller\TaskController();
            $controller->indexAction();
            break;
    }
} catch (\Masha\Exception\SimpleException $e) {
    $controller = new \Masha\Controller\TaskController();
    $controller->redirect('/', $e->getMessage());
} catch (\Exception $e) {
    echo $e->getMessage();
    exit(1);
}

