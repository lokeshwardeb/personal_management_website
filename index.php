<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$Routes = [

    '/' => __DIR__ . '/view/pages/welcome.views.php',
    '/login' => __DIR__ . '/view/pages/welcome.views.php',
    '/login_check_otp' => __DIR__ . '/view/pages/login_otp.views.php',
    '/signup' => __DIR__ . '/view/pages/signup.views.php',
    '/signup_check_otp' => __DIR__ . '/view/pages/login_otp.views.php',
    '/dashboard' => __DIR__ . '/view/pages/dashboard.views.php',
    '/logout' => __DIR__ . '/view/pages/logout.views.php',
    '/subjects' => __DIR__ . '/view/pages/subjects.views.php',
    '/insert_subjects' => __DIR__ . '/view/pages/insert_subjects.views.php',
    '/subject_info' => __DIR__ . '/view/pages/subject_info.views.php',
    '/upload_files' => __DIR__ . '/view/pages/upload_files.views.php',
    '/view_files' => __DIR__ . '/view/pages/view_files.views.php',
    '/check' => __DIR__ . '/view/pages/check_file.views.php',
    '/rename_subject' => __DIR__ . '/view/pages/rename_subject.views.php',
    '/delete_file' => __DIR__ . '/view/pages/delete_file.views.php',

];

if(array_key_exists($uri, $Routes)){
    require $Routes[$uri];
}else{
    require __DIR__ . '/view/error.views.php';
}



?>