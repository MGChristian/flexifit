<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    $otp_1 = $_POST['otp1'];
    $otp_2 = $_POST['otp2'];
    $otp_3 = $_POST['otp3'];
    $otp_4 = $_POST['otp4'];

    try {
        // Error handlers
        $errors = [];

        $first_name = $_SESSION['firstName'];
        $last_name = $_SESSION['lastName'];
        $birthdate = $_SESSION['birthdate'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $gender = $_SESSION['gender'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $emergency_name = $_SESSION['emergencyname'];
        $emergency_contact = $_SESSION['emergencycontact'];
        $prev_otp = $_SESSION['OTP'];


        if (check_sessions($first_name, $last_name, $birthdate, $email, $phone, $gender, $username, $password, $emergency_name, $emergency_contact, $prev_otp)) {
            $errors["empty_input"] = "Please fill in all the fields!";
            $_SESSION['error_signup'] = $errors;
            header("Location: ../signup-page-first.php");
            exit();
        }

        if (is_input_empty($otp_1, $otp_2, $otp_3, $otp_4)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        } else {
            $otp = $otp_1 . $otp_2 . $otp_3 . $otp_4;
        }

        if (is_otp_not_matching($otp, $prev_otp)) {
            $errors["otp_mismatch"] = "The OTP is not matching!";
        }

        if ($errors) {
            $_SESSION['error_signup'] = $errors;
            header("Location: ../signup-page-third.php");
            exit();
        } else {
            $profile_pic_url = "default.jpg";
            $password = hashedPwd($password);
            if (create_user($conn, $username, $email, $password, $first_name, $last_name, $birthdate, $phone, $gender, $profile_pic_url)) {
                session_unset();
                session_destroy();

                require_once "config-session.inc.php";
                $_SESSION['success'] = true;

                header("Location: ../login-page.php");
                exit();
            }
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../signup-page-third.php");
    exit();
}

function check_sessions($first_name, $last_name, $birthdate, $email, $phone, $gender, $username, $password, $emergency_name, $emergency_contact, $prev_otp)
{
    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($birthdate) ||
        empty($email) ||
        empty($phone) ||
        empty($gender) ||
        empty($username) ||
        empty($password) ||
        empty($emergency_name) ||
        empty($emergency_contact) ||
        empty($prev_otp)
    ) {
        return true;
    } else {
        return false;
    }
}


//Validate and check inputs
function is_input_empty($otp_1, $otp_2, $otp_3, $otp_4)
{
    if (
        empty($otp_1) ||
        empty($otp_2) ||
        empty($otp_3) ||
        empty($otp_4)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_otp_not_matching($otp, $prev_otp)
{
    if ($otp !== $prev_otp) {
        return true;
    } else {
        return false;
    }
}

function create_user($conn, $username, $email, $password, $first_name, $last_name, $birthdate, $phone, $gender, $profile_pic_url)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `user` (`username`, `email`, `password`, `firstName`, `lastName`, `DOB`, `contactNo`, `gender`, `profilePicUrl`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $username, $email, $password, $first_name, $last_name, $birthdate, $phone, $gender, $profile_pic_url);
        if ($stmt->execute()) {
            $conn->commit();
            return true;
        } else {
            $conn->rollback();
            return false;
        }
        $stmt->close();
    } catch (\Throwable $th) {
        $conn->rollback();
        return false;
    }
}


function hashedPwd($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}
