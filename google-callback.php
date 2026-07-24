<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$userModelPath = dirname(__FILE__) . '/App/Models/UserModel.php';
if (!file_exists($userModelPath)) {
    die("UserModel file not found: " . $userModelPath);
}
require_once $userModelPath;

$googleConfigPath = dirname(__FILE__) . '/Configs/google.php';
if (!file_exists($googleConfigPath)) {
    die("Google config file not found: " . $googleConfigPath);
}
require_once $googleConfigPath;
if (!isset($_GET['code'])) {
    die("Không nhận được mã xác thực từ Google");
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die($token['error']);
}

$client->setAccessToken($token);

$googleService = new Google_Service_Oauth2($client);

$user = $googleService->userinfo->get();

if (!class_exists('UserModel')) {
    die("UserModel class not found. Check if the file was loaded correctly.");
}

try {
    $userModel = new UserModel();
} catch (Exception $e) {
    die("Error creating UserModel: " . $e->getMessage());
}

$useremaild = $userModel->getUserByEmail($user->email);
if (!$useremaild) {
    $userModel->taoUser(
        $user->id,
        $user->email,
        $user->name
    );

    $useremaild = $userModel->getUserByEmail($user->email);
}

$_SESSION['user'] = [
    'id' => $useremaild['id'],
    'name' => $useremaild['name'],
    'email' => $useremaild['email'],
    'picture' => $user->picture,
    'role' => $useremaild['role']
];

header("Location: index.php?controller=AuthController&action=dashboard");
exit();