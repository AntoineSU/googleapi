<?php
    require __DIR__ . "/vendor/autoload.php";

    session_start();

    $client = new Google_Client();
    $client->setApplicationName('Formation Google API');
    $client->addScope("https://www.googleapis.com/auth/spreadsheets");
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setApprovalPrompt("force");

    $client->authenticate($_GET["code"]);

    $access_token = $client->getAccessToken();
    $refresh_token = $client->getRefreshToken();

    $_SESSION["access_token"] = $access_token;
    setcookie("refresh_token", $refresh_token, time() + (3600 * 24 * 3650), "/");

    header("Location: ./");