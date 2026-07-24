<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$controller = $_GET['controller'] ?? 'AuthController';
$action = $_GET['action'] ?? 'login';

try {
    require_once __DIR__ . "/App/Controllers/$controller.php";
    $object = new $controller();
    if (method_exists($object, $action)) {
        $object->$action();
    } else {
        echo "404 - Action not found";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}