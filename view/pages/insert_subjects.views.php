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
                <hr>

                <div class="description mt-4 fs-4 ">
                Insert Subjects
                </div>

                <div class="form_section_insert_subjects">
                    <div class="box-section">
                        <?php
                        $controllers->add_subjects();


                        ?>
                    </div>
                    <form action="" method="post" class="pt-4">
                        <div class="mb-3">
                            <label for="subject_name">Subject Name</label>
                        <input type="text" name="subject_name" class="form-control" id="subject_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject_description">Subject Description</label>
                        <input type="text" name="subject_description" class="form-control" id="subject_description" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject_starting_semester">Subject Starting Semester</label>
                        <input type="text" name="subject_starting_semester" class="form-control" id="subject_starting_semester" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject_opinion">Subject Opinion</label>
                        <input type="text" name="subject_opinion" class="form-control" id="subject_opinion" required>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" name="submit">Submit</button>
                        </div>

                    </form>
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