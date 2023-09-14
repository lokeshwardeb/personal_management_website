<?php
require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../model/sql.modal.php';

require_once __DIR__ . '/../email_functionalities/sent-mail.php';

$model = new modal_sql;

class controllers extends modal_sql
{

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
                        }else{
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



    public function check_loggedin_status(){

        if(!isset($_SESSION['login_status'])){
            if(!$_SESSION['login_status']){
                header("location: ./");
            }
        }



    }

    public function add_subjects(){
        if(isset($_POST['submit'])){
            $subject_name = $this->pure_data($_POST['subject_name']);
            $subject_description = $this->pure_data($_POST['subject_description']);
            $subject_starting_semester = $this->pure_data($_POST['subject_starting_semester']);
            $subject_opinion = $this->pure_data($_POST['subject_opinion']);

            $result = $this->insert_data("subjects", "`subject_name`, `subject_description`, `subject_starting_semester`, `subject_opinion`", "'$subject_name', '$subject_description', '$subject_starting_semester', '$subject_opinion'");

            if($result){
                echo $this->alert("success", "The new subject has been added successfully !!");
            }else{
                echo $this->alert("danger", "The subject cannot added success. An error has been occured !!");
            }



        }
    }



    public function login()
    {

        if (isset($_POST['login'])) {

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

                            // sent_mail($user_email, $username, "For login in personal management website", "Your otp is 545482125 . Use this for your login..", $username, $user_email, "Your otp is 454512412. use this for login..");

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
