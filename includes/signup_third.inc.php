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
        $keys = "518c59d460786114b3243f3df3007e2766fe4fc8bc28be0cce5ef26ecb6cb23f";
        $key = hash('sha256', $keys, true);
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $iv_base64 = base64_encode($iv);

        $encryptedFirst_name = openssl_encrypt($first_name, 'aes-256-cbc', $key, 0, $iv);
        $encryptedLast_name = openssl_encrypt($last_name, 'aes-256-cbc', $key, 0, $iv);

        $stmt = $conn->prepare("INSERT INTO `user` (`username`, `email`, `password`, `firstName`, `lastName`, `DOB`, `contactNo`, `gender`, `profilePicUrl`, `iv`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssisss", $username, $email, $password, $encryptedFirst_name, $encryptedLast_name, $birthdate, $phone, $gender, $profile_pic_url, $iv_base64);

        if ($stmt->execute()) {
            $id = $stmt->insert_id;
            $stmt->close();

            if (keyPairGenerator($conn, $id)) {
                $conn->commit();
                return true;
            } else {
                $conn->rollback();
                return false;
            }
        } else {
            $stmt->close();
            $conn->rollback();
            return false;
        }
    } catch (\Throwable $th) {
        $conn->rollback();
        return false;
    }
}


function hashedPwd($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function keyPairGenerator($conn, $userID)
{
    $config = [
        "config" => "C:/xampp/apache/conf/openssl.cnf", // or use escaped backslashes
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    ];

    $keyPair = openssl_pkey_new($config);

    if ($keyPair === false) {
        die('Failed to generate key pair: ' . openssl_error_string());
    }

    //Private Key
    openssl_pkey_export($keyPair, $privateKey, null, $config);

    //PublicKey
    $keyDetails = openssl_pkey_get_details($keyPair);
    $publicKey = $keyDetails['key'];

    $keyDir = dirname(__DIR__) . "/user_keys";

    if (!is_dir($keyDir)) {
        mkdir($keyDir, 0700, true);
    }

    $privatePath = "$keyDir/{$userID}_private.pem";
    $publicPath = "$keyDir/{$userID}_public.pem";

    if (file_put_contents($privatePath, $privateKey) === false || file_put_contents($publicPath, $publicKey) === false) {
        return false;
    }
    chmod($privatePath, 0600);
    chmod($publicPath, 0644);

    // Save public key to DB
    $stmt = $conn->prepare("UPDATE `user` SET `publicKey` = ? WHERE ID = ?");
    $stmt->bind_param("si", $publicKey, $userID);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        error_log("Failed to update user public key.");
        return false;
    }
}
