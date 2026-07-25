<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Google_Client();

$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);

$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);

$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

$client->setPrompt('select_account');
$client->setApprovalPrompt('force');

$client->addScope("email");

$client->addScope("profile");