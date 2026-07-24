<?php

class AuthController
{
    public function login()
    {
        require "./App/Views/Login.php";
    }
    public function dashboard()
    {
        require "./App/Views/Dashboard.php";
    }
    public function logout()
    {
        session_destroy();
        header("Location: ./index.php?controller=AuthController&action=login");
        exit();
    }

    public function googleLogin()
    {
        require_once __DIR__ . '/../../Configs/google.php';

        $loginUrl = $client->createAuthUrl();

        header("Location: " . $loginUrl);
        exit();
    }
}