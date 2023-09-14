<?php
require_once __DIR__ . '/inc/session_start.php';

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
$controllers->check_loggedin_status();


?>



<!-- the main section starts here -->
    <main>

    <div class="container-fluid " >
        <div class="row">
            <?php

            require_once __DIR__ . '/inc/sidebar.php';

            ?>
            <div class="col-md-10 col-sm-12">
                <div class="container main_display_section">
               <?php

                require_once __DIR__ . '/inc/search_bar.php';

               ?>

                <div class="welcome_section fs-4">
                    Subjects
                </div>

                <div class="description mt-4">
                   <button type="submit" class="btn btn-primary"><a href="/insert_subjects" class=" text-light nav-link">Add Subjects</a></button> 
                    <a href="" class="ms-4 mb-4">All Subjects</a>
                    <a href="" class="ms-4 mb-4">Hard Subjects</a>
                    <a href="" class="ms-4 mb-4">Easy Subjects</a>
                </div>




                </div>




            </div>
        </div>
    </div>
    
    </main>

    <!-- the main section ends here -->


<?php

// initializing the footer scripts file
require __DIR__ . '/inc/_footer_scripts.php';

?>