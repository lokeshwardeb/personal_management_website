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
// $controllers->check_subject_info_status();


?>



<!-- the main section starts here -->
<main>

    <div class="container-fluid ">
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

                    <div class="box_sections mt-4">
                        <div class="row d-flex">

                            <div href="" class="nav-link col-12 bg-light text-primary border-start border-dark  border-5 pt-4 fs-5" style="height: 250px !important; ">



                                <?php

                                $result = $controllers->subject_info();


                                if ($result) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo ' <div class="ms-4" >Subject Name : ' . $row['subject_name'] . '</div>';
                                            echo ' <div class="ms-4" >Subject Description : ' . $row['subject_description'] . '</div>';
                                            echo ' <div class="ms-4" >Subject Starting Semester : ' . $row['subject_starting_semester'] . '</div>';
                                            echo ' <div class="ms-4" >Subject Opinion : ' . $row['subject_opinion'] . '</div>';
                                        }
                                    }
                                }






                                ?>

                            </div>

                            <div class="container files_section mt-4 mb-4">
                                <div class="section_title fs-4 text-center">
                                    Subjects Files
                                </div>
                                <div class="box_sections">
                                    <?php

                                    $controllers->upload_files();


                                    ?>
                                </div>

                                <div class="section_files">
                                   
                                   <div class="container">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="file_name">File Name</label>
                                            <input type="text" name="file_name" id="" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_name">File Subject Name</label>
                                            <input type="text" name="file_subject_name" id="" class="form-control"required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="upload_file">Upload File</label>
                                            <input type="file" name="img" id="upload_file" class="form-control" required>
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label for="file_name">File Name</label>
                                            <input type="text" name="file_name" id="" class="form-control">
                                        </div> -->
                                        <div class="mb-3">
                                            
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        
                                    </form>
                                   </div>
                                </div>

                            </div>

                                        <!-- <a href="" class="nav-link col-4 bg-light text-primary border-start border-primary  border-5 pt-4 fs-4" style="height: 250px !important; ">
                                        <div class="ms-4" >Physics</div>
                                        </a> -->


                        </div>
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