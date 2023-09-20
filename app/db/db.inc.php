<?php
/* HIDE ERRORS */
error_reporting(0); // 1 = Show errors, 0 = Hide errors

/* COMMENT OUT THE FIRST LINE, AND UNCOMMENT 3 LINES BELOW TO ENABLE ERROR REPORTING */
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Load database credentials from file
$dbConfig = parse_ini_file("/config/secure/.env");

// Set the Timezone
date_default_timezone_set($dbConfig["TZ"]);

// Connect to the database
$conn = new mysqli($dbConfig["MYSQL_SERVER"], $dbConfig["MYSQL_USER"], $dbConfig["MYSQL_PASSWORD"], $dbConfig["MYSQL_DATABASE"]);
if ($conn->connect_error) {
    die("Database Connection Failed!<br>Site may be undergoing maintenance...");
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getDeviceAgent()
{
    if (!empty($_SERVER["HTTP_USER_AGENT"])) {
        $agent = $_SERVER["HTTP_USER_AGENT"];
    }
    return $agent;
}

function generateUUID($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function convert_filesize($bytes, $decimals = 2)
{
    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[$factor];
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}
