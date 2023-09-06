<?php
$active_class = 'login';
// initializing the header file
// require __DIR__ . '/inc/_header.php';



// the required files
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../model/sql.modal.php';
require_once __DIR__ . '/../../controller/controllers.php';

$conn = new conn;

$model = new modal_sql;
$model->get_data("users");

$controllers = new controllers;



?>

<!-- login heading starts here -->

<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($active_class) ?> || iManage -- My personal management website</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

<!-- login heading ends here -->


<!-- the main section starts here -->
    <main>

    <div class="container">
        <div class="section_title text-center m-auto mt-4 fs-2 text-primary">
        Welcome to iManage
        </div>
        <div class="section_box mt-4">

        <div class="info_box">
            <?php

            $controllers->login();            


            ?>
        </div>

        <form action="" method="post">

        <div class="mb-4 ">

        <label for="username">Username</label>

        <input type="text"  name="username" id="username" class="form-control">

        
        </div>

        <div class="mb-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="user_email" id="email">
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="container">
            <button class="btn btn-primary" name="login">Login</button>
        </div>

        </form>
        

        </div>
    </div>

    
    </main>

    <!-- the main section ends here -->


<?php

// initializing the footer scripts file
require __DIR__ . '/inc/_footer_scripts.php';

?>