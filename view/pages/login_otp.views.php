<?php
require_once __DIR__ . '/inc/session_start.php';
$active_class = "Verify your otp";
// initializing the header file
require_once __DIR__ . '/inc/_header.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../model/sql.modal.php';
require_once __DIR__ . '/../../controller/controllers.php';

$controllers = new controllers;




?>
<!-- the main section starts here -->
    <main>

    <div class="container">
        <div class="section_title text-center m-auto mt-4 fs-2 text-primary">
        Welcome to iManage
        </div>
        <div class="section_box">
            <div class="box-display">
                <?php

                    echo $controllers->login_otp_verify();           


                ?>
            </div>

        <form action="" method="post">

        <div class="mb-4 ">

        <label for="username">Your otp </label>

        <input type="text"  name="submit_otp" id="username" class="form-control">

        
        </div>

        

        
        <div class="container">
            <button class="btn btn-primary" name="submit_otp_btn">Confirm otp</button>
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