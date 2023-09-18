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

                            <div href="" class="d-none nav-link col-12 bg-light text-primary border-start border-dark  border-5 pt-4 fs-5" style="height: 250px !important; ">



                                <!--  -->

                            </div>

                            <div class="container files_section mt-4 mb-4">
                                <div class="section_title fs-4 text-center text-danger fw-bold">
                                    Are you want to delete this file ? <br>
                                 
                                </div>
                                <div class="section_title fs-5 text-center text-dark fw-bold">
                                   
                                    Note: You cannot get back the file if you have deleted this once !!
                                </div>

                                <div class="delete_file_section">
                                    <?php

$controllers->delete_file();

?>
                                </div>

                                <div class="delete_file_btn">
                                    <form action="" method="post">
                                    <button type="submit" class="btn btn-danger" name="delete_file">Yes, Delete this file</button>

                                    </form>
                                </div>

                                <div class="section_files">
                                    <div class="add_file_btn">
                                        <?php

                                        $result = $controllers->subject_info();
                                        if ($result) {
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $subject_name = $row['subject_name'];
                                                }
                                            }
                                        }

                                        ?>
                                        <!-- <a href="/upload_files?subject_name=<?php echo $subject_name; ?>"><button class="btn btn-primary mt-4 mb-4" type="button">Add files</button></a> -->
                                    </div>
                                    <div class="row pt-4 pb-4">
                                        <?php

                                        $result = $controllers->view_files();

                                        




                                        
                                    //    echo '
                                    //    <div class="col-12">
                                    //    '. $result .'
                                    //    </div>
                                       
                                    //    '




                                        ?>
                                        <!-- <div class="col-4">file1</div>
                                        <div class="col-4">file2</div>
                                        <div class="col-4">file3</div> -->



                                        <!-- <form action="" method="get">
                                            <input type="text" name="inp">
                                            <input type="text" name="inptt">
                                            <button type="submit" class="btn btn-primary">submit</button>
                                        </form> -->



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