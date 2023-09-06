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

    public function login()
    {

        if (isset($_POST['login'])) {

            $username = $this->pure_data($_POST['username']);
            $user_email = $this->pure_data($_POST['user_email']);
            $password = $this->pure_data($_POST['password']);

            $result = $this->get_data("users");

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $get_pass = $row['password'];

                        $check_pass = password_verify($password, $get_pass);

                        if ($check_pass) {
                            echo $this->alert("success", "Loggedin Successfully");

                            // sent_mail($user_email, $username, "For login in personal management website", "Your otp is 545482125 . Use this for your login..", $username, $user_email, "Your otp is 454512412. use this for login..");

                              // this means the login otp check is on that means 1
                              $_SESSION['login_check_otp'] = 1;

                              header("location: /login_check_otp");
  

                        }
                    }
                }
            }
        }
    }



    public function signup()
    {

        if (isset($_POST['signup'])) {
            $username = $this->pure_data($_POST['username']);
            $user_email = $this->pure_data($_POST['user_email']);
            $password =$this->pure_data( $_POST['password']);
            $cpassword = $this->pure_data($_POST['cpassword']);

            if ($password == $cpassword) {

                if ($password !== '' && $cpassword !== '' && $username !== '' && $user_email !== '') {

                    $result_check_user = $this->get_data_where("users", "`username` = '$username'");
                    $result_check_user_email = $this->get_data_where("users", "`user_email` = '$user_email'");

                    if ($result_check_user || $result_check_user_email || $result_check_user && $result_check_user_email) {
                        if ($result_check_user->num_rows > 0) {
                            echo $this->alert("danger", "User already exists !!");
                        }

                        elseif($result_check_user_email->num_rows > 0){
                            echo $this->alert("danger", "User already exists with this email !!");
                        }
                        
                        else{
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
