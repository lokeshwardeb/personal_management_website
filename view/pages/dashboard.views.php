<?php
$active_class = 'login';
// initializing the header file
require __DIR__ . '/inc/_header.php';



// the required files
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../model/sql.modal.php';
require_once __DIR__ . '/../../controller/controllers.php';

$conn = new conn;

$model = new modal_sql;
$model->get_data("users");

$controllers = new controllers;



?>



<!-- the main section starts here -->
    <main>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                d
            </div>
            <div class="col-md-8 col-sm-12"></div>
        </div>
    </div>
    
    </main>

    <!-- the main section ends here -->


<?php

// initializing the footer scripts file
require __DIR__ . '/inc/_footer_scripts.php';

?>