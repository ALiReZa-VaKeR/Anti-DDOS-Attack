<?php

session_start();
define('FILE_BLOCK_IPS', 'BLOCK_IP.txt');
define('REDIRECT_LINK', './403.html');
define('REDIRECT_HOME_PAGE', 'success.php');

if (!file_exists(FILE_BLOCK_IPS)) {
    fopen(FILE_BLOCK_IPS, "w");
}

$p1 = "در حال بررسی درخواست ...";
$p2 =  "در حال انتقال به صفحه مورد نظر ...";
$user_ip = "127.0.0.1";
if ($_SESSION['time_request'] > time() - 4) {
    header('Location:' . REDIRECT_LINK);
    return;
    $f = fopen(FILE_BLOCK_IPS, "a");
    if (findIPinBlockListIP() != true && filesize(FILE_BLOCK_IPS) <= 1) {
        fwrite($f, $user_ip . " - ");
    }
}


$_SESSION['time_request'] = time();

// Redirect Success
$_SESSION['status'] = "success/1";
print '<script> sessionStorage.setItem("status", "' . $_SESSION['status'] . '");</script>';


function findIPinBlockListIP()
{
    $content = file_get_contents(FILE_BLOCK_IPS);
    $search = getUserIP();
    $result = strstr($content, $search);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
