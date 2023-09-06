<?php
$active_class = 'signup';
// initializing the header file
// require __DIR__ . '/inc/_header.php';



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
        <div class="section_box">

        <form action="" method="post">

        <div class="mb-4 ">

        <label for="username">Username</label>

        <input type="text"  name="" id="username" class="form-control">

        
        </div>

        <div class="mb-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="" id="email">
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" name="" id="password" class="form-control">
        </div>
        <div class="mb-4">
            <label for="password">Confirm Password</label>
            <input type="password" name="" id="password" class="form-control">
        </div>

        <div class="container">
            <button class="btn btn-primary">Signup</button>
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