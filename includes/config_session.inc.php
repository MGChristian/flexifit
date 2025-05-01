<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    // 'domain' => 'mgchristian.helioho.st',
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

date_default_timezone_set("Asia/Manila");
session_start();

if (!isset($_SESION['last_regenaration'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION['last_regenartion'] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id()
{
    session_regenerate_id();
    $_SESSION['last_regeneration'] = time();
}
