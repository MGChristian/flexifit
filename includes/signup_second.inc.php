<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $emergency_name = $_POST['emergencyname'];
    $emergency_contact = $_POST['emergencycontact'];

    try {
        require_once "config.php";
        require_once "config_session.inc.php";

        // Error handlers
        $errors = [];

        $first_name = $_SESSION['firstName'];
        $last_name = $_SESSION['lastName'];
        $birthdate = $_SESSION['birthdate'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $gender = $_SESSION['gender'];

        if (check_sessions($first_name, $last_name, $birthdate, $email, $phone, $gender)) {
            $errors["empty_input"] = "Please fill in all the fields!";
            $_SESSION['error_signup'] = $errors;
            header("Location: ../signup-page-info.php");
            exit();
        }

        if (is_input_empty($username, $password, $confirm, $emergency_name, $emergency_contact)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (is_username_taken($conn, $username)) {
            $errors["taken_username"] = "The username is already taken!";
        }
        if (is_password_not_matching($password, $confirm)) {
            $errors["password_not_matching"] = "The password is not matching!";
        }

        if ($errors) {
            $_SESSION['error_signup'] = $errors;
            header("Location: ../signup-page-account.php");
            exit();
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['confirm'] = $confirm;
            $_SESSION['emergencyname'] = $emergency_name;
            $_SESSION['emergencycontact'] = $emergency_contact;

            require_once "sendmail.php";
            $OTP_CODE = generateOTP();
            if (send_otp_mail($email, $first_name, $OTP_CODE)) {
                $_SESSION['OTP'] = $OTP_CODE;
                header("Location: ../signup-page-otp.php");
                exit();
            } else {
                $errors = array(
                    "OTP failed" => "OTP NOT SENT PROPERLY"
                );
                $_SESSION['error_signup'] = $errors;
                header("Location: ../signup-page-account.php");
                exit();
            }
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../signup-page-info.php");
    exit();
}

function check_sessions($first_name, $last_name,  $birthdate, $email, $phone, $gender)
{
    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($birthdate) ||
        empty($email) ||
        empty($phone) ||
        empty($gender)
    ) {
        return true;
    } else {
        return false;
    }
}


//Validate and check inputs
function is_input_empty($username, $password, $confirm, $emergency_name, $emergency_contact)
{
    if (
        empty($username) ||
        empty($password) ||
        empty($confirm) ||
        empty($emergency_name) ||
        empty($emergency_contact)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken($conn, $username)
{
    $stmt = $conn->prepare("SELECT `username` FROM `user` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function is_password_not_matching($password, $confirm)
{
    if ($password !== $confirm) {
        return true;
    } else {
        return false;
    }
}

function generateOTP()
{
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 4);
}

function send_email($email, $first_name) {}


// function create_user()
// {
//     $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
// }
