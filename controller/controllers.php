<?php
require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../model/sql.modal.php';

require_once __DIR__ . '/../email_functionalities/sent-mail.php';

$model = new modal_sql;

class controllers extends modal_sql
{

    public function website_address(){
        return $website_address = "http://localhost:8000/dashboard";
    }


    public function alert($alert_type, $alert_msg)
    {

        if ($alert_type == 'success') {
            return '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> ' . $alert_msg . ' .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        if ($alert_type == 'danger') {
            return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> ' . $alert_msg . ' .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }


    public function login_otp_verify()
    {
        $_SESSION['login_status'] = false;
        if (isset($_POST['submit_otp_btn'])) {

            $submit_otp = $this->pure_data($_POST['submit_otp']);
            $username = $this->pure_data($_GET['login_username']);

            $result = $this->get_data_where("users", "`username` = '$username'");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $get_otp = $row['otp'];

                    if ($get_otp !== '') {

                        if ($submit_otp == $get_otp) {

                            $_SESSION['login_status'] = true;

                            header("location: ./dashboard");

                            // making the otp blank after verification

                            $otp_update_result = $this->update_data("users", "`otp` = ''", "`username` = '$username'");

                            if ($otp_update_result) {
                                echo $this->alert("success", "The otp has been restored successfully");
                            } else {
                                echo $this->alert("danger", "The otp cannot restore successfully !!");
                                exit;
                            }
                        } else {
                            echo $this->alert("danger", "Your submitted otp is not valid. Please submit the correct otp code");
                        }
                    } else {
                        echo $this->alert("danger", "The otp code is blank !!");
                    }
                }
            } else {
                echo $this->alert("danger", "The num not runs");
            }
        }
    }



    public function check_loggedin_status()
    {

        if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] == '') {
            if (!$_SESSION['login_status']) {
                header("location: ./");
            }
        }
    }

    public function add_subjects()
    {
        if (isset($_POST['submit'])) {
            $subject_name = $this->pure_data($_POST['subject_name']);
            $subject_description = $this->pure_data($_POST['subject_description']);
            $subject_starting_semester = $this->pure_data($_POST['subject_starting_semester']);
            $subject_opinion = $this->pure_data($_POST['subject_opinion']);

            $result = $this->insert_data("subjects", "`subject_name`, `subject_description`, `subject_starting_semester`, `subject_opinion`", "'$subject_name', '$subject_description', '$subject_starting_semester', '$subject_opinion'");

            if ($result) {
                echo $this->alert("success", "The new subject has been added successfully !!");
            } else {
                echo $this->alert("danger", "The subject cannot added success. An error has been occured !!");
            }
        }
    }

    public function subject_info()
    {
        if (isset($_GET['subject_name'])) {
            $subject_name = $this->pure_data($_GET['subject_name']);
            $result = $this->get_data_where("subjects", "`subject_name` = '$subject_name'");
            return $result;
        }
    }

    public function check_subject_info_status()
    {
        if (!isset($_GET['subject_name'])) {
            echo "Subject not selected";
            header("location: ./subjects");
        }
    }

    public function upload_files()
    {

        if (isset($_POST['submit'])) {
            $file_name = $this->pure_data($_POST['file_name']);
            $file_subject_name = $this->pure_data($_POST['file_subject_name']);
            $upload_file = $_FILES['img']['name'];
            $upload_file_tmp = $_FILES['img']['tmp_name'];

            echo $file_name;


            $file_extension =  pathinfo($upload_file, PATHINFO_EXTENSION);



            //  // insert data on db
            //  $result = $this->insert_data("media", "`media_name`, `media_type`, `media_subject_name`", "'$file_name', '$file_extension', '$file_subject_name'");



            if ($file_extension == 'jpg' || $file_extension == 'png' || $file_extension == 'gif') {
                // echo $this->alert("success", "The image file has been uploaded successfully");
                $upload_dir = './assets/uploads/img/' . $file_name . '.' . $file_extension;



                if (!file_exists($upload_dir)) {

                    // insert data on db

                    $result = $this->insert_data("media", "`media_name`, `media_type`, `media_subject_name`", "'$file_name', '$file_extension', '$file_subject_name'");


                    if (move_uploaded_file($upload_file_tmp, $upload_dir)) {
                        // echo $this->alert("success", "The file has beendd uploaded successfully !!");
                    } else {
                        echo $this->alert("danger", "The file has not been uploaded successfully !!");
                    }
                } else {
                    echo $this->alert("danger", "The file already exist on the system !!");
                    
                }
            } elseif ($file_extension == 'mp3' || $file_extension == 'mp4') {
                echo $this->alert("success", "The video file has been uploaded successfully");
                $upload_dir = './assets/uploads/videos/' . $file_name . '.' . $file_extension;




                if (!file_exists($upload_dir)) {

                    // insert data on db
                    $result = $this->insert_data("media", "`media_name`, `media_type`, `media_subject_name`", "'$file_name', '$file_extension', '$file_subject_name'");

                    if (move_uploaded_file($upload_file_tmp, $upload_dir)) {
                        echo $this->alert("success", "The file has been uploaded successfully !!");
                    } else {
                        echo $this->alert("danger", "The file has not been uploaded successfully !!");
                    }
                } else {
                    echo $this->alert("danger", "The file already exist on the system !!");
                }
            } else {
                // echo $this->alert("success", "The document file has been uploaded successfully");
                $upload_dir = './assets/uploads/docs/' . $file_name . '.' . $file_extension;



                if (!file_exists($upload_dir)) {


                    // insert data on db
                    $result = $this->insert_data("media", "`media_name`, `media_type`, `media_subject_name`", "'$file_name', '$file_extension', '$file_subject_name'");

                    if (move_uploaded_file($upload_file_tmp, $upload_dir)) {
                        echo $this->alert("success", "The file has been uploaded successfully !!");
                    } else {
                        echo $this->alert("danger", "The file has not been uploaded successfully !!");
                    }
                } else {
                    echo $this->alert("danger", "The file already exist on the system !!");
                }
            }

            echo '<pre>';
            print_r($upload_file);
            echo '</pre>';
        }
    }


    public function show_files()
    {

        $subject_name = $this->pure_data($_GET['subject_name']);

        $result = $this->get_data_where("media", "`media_subject_name` = '$subject_name'");

        return $result;
    }

    public function view_files()
    {

        $subject_name = $this->pure_data($_GET['subject_name']);
        $subject_file_name = $this->pure_data($_GET['subject_file_name']);

        // $sub_result = $this->get_data_where("media", "``");


        // checking if the file name exists of the database

        $result = $this->get_data_where("media", "`media_subject_name` = '$subject_name' AND `media_name` = '$subject_file_name'");

        if ($result) {
            // echo $this->alert("success", "the result runs");

            // echo 'the result runs';
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                       $get_subject_name = $row['media_subject_name'];
                       $get_subject_file_name = $row['media_name'];
                    $get_file_type = $row['media_type'];
                    //  echo "the file type is ".  $get_file_type;




                    if ($get_file_type == 'png' || $get_file_type == 'jpg' || $get_file_type == 'jpeg') {
                        $dir_name =  './assets/uploads/img/';
                        // /assets/uploads/img/d.jpg

                       $file_main_name = $dir_name . $subject_file_name . '.' . $get_file_type;

                        if (file_exists($file_main_name)) {
                            // we are using the img tag because the file is an image
                            echo '
                                
                                <img src="' . $file_main_name . '" class="img-fluid" style="">

                                ';
                        } else {

                            // this means the file is not exist on our system

                            echo $this->alert("danger", "The file is not exist on our system !! Please check if you have uploaded the file perfectly !! File exist error !!");
                        }
                    } elseif ($get_file_type == 'mp3' || $get_file_type == 'mp4') {

                        $dir_name =  './assets/uploads/img/';


                        echo 'the file main name is : ' . $file_main_name = $dir_name . $subject_file_name . '.' . $get_file_type;

                        if (file_exists($file_main_name)) {
                            // we are using the video tag because the file is an video
                            echo '
                                
                                <video src="' . $file_main_name . '" class="img-fluid" style=""></video>

                                ';
                        } else {

                            // this means the file is not exist on our system

                            echo $this->alert("danger", "The file is not exist on our system !! Please check if you have uploaded the file perfectly !! File exist error !!");
                        }
                    }elseif($get_file_type == 'docx' || $get_file_type == 'doc' || $get_file_type == 'xlsx' || $get_file_type == 'accdb'){
                        // this means the file is an document

                        $dir_name =  './assets/uploads/docs/';


                         $file_main_name = $dir_name . $subject_file_name . '.' . $get_file_type;

                        if (file_exists($file_main_name)) {
                            // we are using the video tag because the file is an video
                            echo '
                                
                               <iframe src = "https://view.officeapps.live.com/op/embed.aspx?src='.$file_main_name.'" width="100%" height="477px"></iframe>

                                ';
                            // echo '
                                
                            // <embed src="'. $file_main_name .'" type="application/'. $get_file_type .'" class="img-fluid" style="height: 100vh;">
                            //     ';
                        } else {

                            // this means the file is not exist on our system

                            echo $this->alert("danger", "The file is not exist on our system !! Please check if you have uploaded the file perfectly !! File exist error !!");
                        }

                        
                    }else{
                        
                        // this means the file is an document which is not mensured on the elseif conditions

                        $dir_name =  './assets/uploads/docs/';


                        $file_main_name = $dir_name . $subject_file_name . '.' . $get_file_type;

                        if(file_exists($file_main_name)){
 
                        echo '
                        
                        <embed src="'. $file_main_name .'" type="application/'. $get_file_type .'" class="img-fluid" style="height: 100vh;">
                        
                        ';

                        }else{
                            echo $this->alert("danger", "The file is not exist on our system !! Please check if you have uploaded the file perfectly !! File exist error !!");
                        }


                    }
                }
            } else {
                echo $this->alert("danger", "The file not exist on our system !!");
            }
        } else {
            echo $this->alert("danger", "the result not runs");
        }
    }


    public function delete_subject(){

    }

    public function delete_file(){

        if(isset($_POST['delete_file'])){

            $get_subject_name = $this->pure_data($_GET['subject_name']);
            $get_subject_file_name = $this->pure_data($_GET['subject_file_name']);
            // $get_subject_file_id = $this->pure_data($_GET['subject_file_id']);

            $result = $this->get_data_where("media", "`media_name` = '$get_subject_file_name' AND `media_subject_name` = '$get_subject_name'");

            if($result){
                if($result->num_rows > 0){
                    $result_delete = $this->delete_data_where("media", "`media_name` = '$get_subject_file_name'");

                    if($result_delete){

                        while($row = $result->fetch_assoc()){
                            $file_type = $row['media_type'];

                        }

                        if($file_type == 'jpg' || $file_type == 'jpeg' || $file_type == 'png'){
                        $dir_name =  './assets/uploads/img/';

                        }elseif($file_type == 'mp3' || $file_type == 'mp4'){
                        $dir_name =  './assets/uploads/videos/';

                        }elseif($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xlsx' || $file_type == 'accdb'){
                        $dir_name =  './assets/uploads/docs/';

                        }else{
                        $dir_name =  './assets/uploads/docs/';

                        }
                        // $dir_name =  './assets/uploads/docs/';


                        $file_main_name = $dir_name . $get_subject_file_name . '.' . $file_type;

                        if(file_exists($file_main_name)){
                            if(unlink($file_main_name)){

                                echo $this->alert("success", "The file has been deleted successfully");
                            }else{
                            echo $this->alert("danger", "The file cannot deleted successfully !!");
    
                            }
    
                            echo $this->alert("success", "The file has been removed from the system successfully");
                        }else{
                            echo $this->alert("success", "The file cannot removed from the system successfully, because the file does not exist on our system. There is an error and the file does'not exist on our system. All the other files releted to this is removing from our system . Don't worry the file will be completely remove from our system !!");

                            // this means that the file does not exist on our system but exist on our database. So we are removing it from our database successfully

                    $result_delete_er_new = $this->delete_data_where("media", "`media_name` = '$get_subject_file_name'");

                    if($result_delete_er_new){
                        echo $this->alert("success", "The file has been removed from the system successfully");

                    }else{
                        echo $this->alert("danger", "The file cannot deleted successfully !!");

                    }




                        }

                        
                        


                    }else{
                        echo $this->alert("danger", "The file cannot removed from the system successfully !!");
                    }                    

                }
            }








        }


    }



    public function rename_subject(){
        if(isset($_POST['rename_subject'])){

            // $get_subject_name = $this->pure_data($_GET['subject_name']);
            $get_subject_id = $this->pure_data($_GET['subject_id']);



            // if(isset($get_subject_name)){


            $subject_name = $this->pure_data($_POST['subject_name']);
            $subject_description = $this->pure_data($_POST['subject_description']);
            $subject_starting_semester = $this->pure_data($_POST['subject_starting_semester']);
            $subject_opinion = $this->pure_data($_POST['subject_opinion']);


           $result_main_check = $this->get_data_where("subjects", "`subject_name` = '$subject_name'"); 

           if($result_main_check){
            // this means there is already a subject exists on our system
            echo $this->alert("danger", "There is already a subject exist on our system with the same name. Please use another name to update the current subject !!");


           }else{
            // this will run when there is no subject exists on the same name
            $result = $this->update_data("subjects", "`subject_name`='$subject_name',`subject_description`='$subject_description',`subject_starting_semester`='$subject_starting_semester',`subject_opinion`='$subject_opinion'", "`subject_id` = '$get_subject_id'");

            if($result){
                echo $this->alert("success", "The subject name has been renamed and updated successfully !! ");
            }else{
                echo $this->alert("danger", "The subject cannot renamed and updated successfully !! ");
                
            }

           }




            // $result = $this->update_data("subjects", "`subject_name`='$subject_name',`subject_description`='$subject_description',`subject_starting_semester`='$subject_starting_semester',`subject_opinion`='$subject_opinion'", "`subject_id` = '$get_subject_id'");

            // if($result){
            //     echo $this->alert("success", "The subject name has been renamed and updated successfully !! ");
            // }else{
            //     echo $this->alert("danger", "The subject cannot renamed and updated successfully !! ");
                
            // }





            // }else{
            //     // header("location: /subjects");
            // }

            



        }
    }


    public function login()
    {

        if (isset($_POST['login'])) {
            $_SESSION['login_check_otp'] = 0;

            $username = $this->pure_data($_POST['username']);
            $user_email = $this->pure_data($_POST['user_email']);
            $password = $this->pure_data($_POST['password']);

            // $result = $this->get_data("users");

            $result = $this->get_data_where("users", "`username` = '$username'");

            // the otp for checking the processs
            $otp = rand(1111, 9999);


            if ($result) {
                // if there is only one user . Using the one user logic for avoiding the loop error massege showing.
                if ($result->num_rows == 1) {
                    $otp_result = $this->update_data("users", "`otp` = '$otp'", "`username` = '$username'");

                    if ($otp_result) {
                        echo $this->alert("success", "Otp inserted");
                    } else {
                        echo $this->alert("danger", "Otp not inserted !!");
                        exit;
                    }


                    while ($row = $result->fetch_assoc()) {

                        $get_pass = $row['password'];
                        //$get_username = $row['username'];
                        // $get_otp = $row['otp'];

                        $check_pass = password_verify($password, $get_pass);

                        if ($check_pass) {
                            echo $this->alert("success", "Loggedin Successfully");

                            sent_mail($user_email, $username, "For login in personal management website", "Your otp is $otp . Use this for your login..", $username, $user_email, "Your otp is $otp. use this for login..");

                            // this means the login otp check is on that means 1
                            $_SESSION['login_check_otp'] = 1;







                            header("location: /login_check_otp?login_username=$username");
                        } else {
                            echo $this->alert("danger", "Password doesnot match !!");
                        }
                    }
                } else {
                    echo $this->alert("danger", "User doesnot exist !!");
                }
            }
        }
    }



    public function signup()
    {

        if (isset($_POST['signup'])) {
            $username = $this->pure_data($_POST['username']);
            $user_email = $this->pure_data($_POST['user_email']);
            $password = $this->pure_data($_POST['password']);
            $cpassword = $this->pure_data($_POST['cpassword']);

            if ($password == $cpassword) {

                if ($password !== '' && $cpassword !== '' && $username !== '' && $user_email !== '') {

                    $result_check_user = $this->get_data_where("users", "`username` = '$username'");
                    $result_check_user_email = $this->get_data_where("users", "`user_email` = '$user_email'");

                    if ($result_check_user || $result_check_user_email || $result_check_user && $result_check_user_email) {
                        if ($result_check_user->num_rows > 0) {
                            echo $this->alert("danger", "User already exists !!");
                        } elseif ($result_check_user_email->num_rows > 0) {
                            echo $this->alert("danger", "User already exists with this email !!");
                        } else {
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            $result =  $this->insert_data("users", "`username`, `user_email`, `password`", "'$username', '$user_email', '$hash'");

                            if ($result) {
                                echo $this->alert("success", "User has been added successfully !!");
                                sent_mail($user_email, $username, "For signup in personal management website", "Your otp is 545482125 . Use this for your signup..", $username, $user_email, "Your otp is 454512412. use this for login..");

                                // this means the login otp check is on that means 1
                                $_SESSION['login_otp_check'] = 1;

                                header("location: /login_otp_check");
                            }
                        }
                    } else {

                        echo $this->alert("danger", "There is an error while checking the user");
                    }
                } else {
                    echo $this->alert("danger", "You cannot submit blank !! ");;
                }
            } else {
                echo 'password not matched';
            }
        }
    }
}