<?php

session_start();

define('FILE_BLOCK_IPS', 'BLOCK_IP.txt');

// $user_ip = $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];

print(filesize(FILE_BLOCK_IPS));

$user_ip = "127.0.0.1";
if ($_SESSION['time_request'] > time() - 4) {
    echo "Blocked IP =>" . $user_ip;
    $f = fopen(FILE_BLOCK_IPS, "a");
    if (findIPinBlockListIP() == true ||  filesize(FILE_BLOCK_IPS) <= 0) {
        fwrite($f, $user_ip . " - ");
    }
}

$_SESSION['time_request'] = time();
// جلوگیری از ثبت مجدد IP

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
