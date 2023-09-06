<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$Routes = [

    '/' => __DIR__ . '/view/pages/welcome.views.php',
    '/login' => __DIR__ . '/view/pages/welcome.views.php',
    '/login_check_otp' => __DIR__ . '/view/pages/login_otp.views.php',
    '/signup' => __DIR__ . '/view/pages/signup.views.php',
    '/signup_check_otp' => __DIR__ . '/view/pages/login_otp.views.php',
    '/dashboard' => __DIR__ . '/view/pages/dashboard.views.php',

];

if(array_key_exists($uri, $Routes)){
    require $Routes[$uri];
}else{
    require __DIR__ . '/view/error.views.php';
}



?>