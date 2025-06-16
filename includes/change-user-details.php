<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    $id = $_SESSION['id'];

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contactNumber = trim($_POST['contactNumber'] ?? '');
    $birthdate = trim($_POST['birthdate'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $username = trim($_POST['username'] ?? '');

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Please enter a valid email address.";
        }

        if (is_username_taken($conn, $id, $username)) {
            $errors["username_taken"] = "Username is already in use.";
        }

        if ($errors) {
            $_SESSION['error_user_update'] = $errors;
            header("Location: ../profile-user.php");
            exit();
        }

        if (update_user_details($conn, $id, $firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
            unset($_SESSION['error_user_update']);
            header("Location: ../profile-user.php?status=user_updated");
            exit();
        } else {
            $errors["update_failed"] = "Failed to update profile details.";
            $_SESSION['error_user_update'] = $errors;
            header("Location: ../profile-user.php");
            exit();
        }
    } catch (\Throwable $th) {
        error_log("User detail update error: " . $th->getMessage());
        $errors["system_error"] = "A system error occurred. Please try again.";
        $_SESSION['error_user_update'] = $errors;
        header("Location: ../profile-user.php");
        exit();
    }
} else {
    header("Location: ../");
    exit();
}

// Helper functions

function is_input_empty(...$fields)
{
    foreach ($fields as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function is_username_taken($conn, $currentId, $username)
{
    $stmt = $conn->prepare("SELECT ID FROM user WHERE username = ? AND ID != ?");
    $stmt->bind_param("si", $username, $currentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $taken = $result->num_rows > 0;
    $stmt->close();

    return $taken;
}

function update_user_details($conn, $id, $firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)
{
    try {
        $keys = "518c59d460786114b3243f3df3007e2766fe4fc8bc28be0cce5ef26ecb6cb23f"; // 256-bit key
        $key = hash('sha256', $keys, true);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedFirstname = openssl_encrypt($firstName, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $encryptedLastname = openssl_encrypt($lastName, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        

        // Encode to base64 for safe DB storage
        $encryptedBase64Firstname = base64_encode($encryptedFirstname);
        $encryptedBase64Lastname = base64_encode($encryptedLastname);
        $iv_base64 = base64_encode($iv);
        $stmt = $conn->prepare("
            UPDATE user 
            SET firstName = ?, lastName = ?, email = ?, contactNo = ?, DOB = ?, gender = ?, username = ? , iv = ?
            WHERE ID = ?
        ");
        $stmt->bind_param("ssssssssi", $encryptedBase64Firstname, $encryptedBase64Lastname, $email, $contactNumber, $birthdate, $gender, $username,$iv_base64, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (\Throwable $th) {
        error_log("Update user details failed: " . $th->getMessage());
        return false;
    }
}







// <?php

// if ($_SERVER['REQUEST_METHOD'] === "POST") {
//     require_once "./auth.php";

//     $id = $_SESSION['id'];
//     $keys = "518c59d460786114b3243f3df3007e2766fe4fc8bc28be0cce5ef26ecb6cb23f"; // 256-bit key
//     $key = hash('sha256', $keys, true);
//     echo $firstName = trim($_POST['firstName'] ?? '');
//     $lastName = trim($_POST['lastName'] ?? '');
//     $email = trim($_POST['email'] ?? '');
//     $contactNumber = trim($_POST['contactNumber'] ?? '');
//     $birthdate = trim($_POST['birthdate'] ?? '');
//     $gender = trim($_POST['gender'] ?? '');
//     $username = trim($_POST['username'] ?? '');
//     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
//     $fName = openssl_encrypt($firstName, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
//     echo $encrypted_base64_fname = base64_encode($fName);



//     try {
//         // Error handlers
//         $errors = [];

//         if (is_input_empty($firstName, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
//             $errors["empty_input"] = "Please fill in all the fields!";
//         }

//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $errors["invalid_email"] = "Please enter a valid email address.";
//         }

//         if (is_username_taken($conn, $id, $username)) {
//             $errors["username_taken"] = "Username is already in use.";
//         }

//         if ($errors) {
//             $_SESSION['error_user_update'] = $errors;
//             header("Location: ../profile-user.php");
//             exit();
//         }

//         if (update_user_details($conn, $id, $encrypted_base64_fname, $lastName, $email, $contactNumber, $birthdate, $gender, $username)) {
//             unset($_SESSION['error_user_update']);
//             header("Location: ../profile-user.php?status=user_updated");
//             exit();
//         } else {
//             $errors["update_failed"] = "Failed to update profile details.";
//             $_SESSION['error_user_update'] = $errors;
//             header("Location: ../profile-user.php");
//             exit();
//         }
//     } catch (\Throwable $th) {
//         // error_log("User detail update error: " . $th->getMessage());
//         // $errors["system_error"] = "A system error occurred. Please try again.";
//         // $_SESSION['error_user_update'] = $errors;
//         // header("Location: ../profile-user.php");
//         // exit();
//     }
// } else {
//     header("Location: ../");
//     exit();
// }

// // Helper functions

// function is_input_empty(...$fields)
// {
//     foreach ($fields as $field) {
//         if (empty($field)) {
//             return true;
//         }
//     }
//     return false;
// }

// function is_username_taken($conn, $currentId, $username)
// {
//     $stmt = $conn->prepare("SELECT ID FROM user WHERE username = ? AND ID != ?");
//     $stmt->bind_param("si", $username, $currentId);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $taken = $result->num_rows > 0;
//     $stmt->close();

//     return $taken;
// }

// function update_user_details($conn, $id, $encrypted_base64_fname, $lastName, $email, $contactNumber, $birthdate, $gender, $username)
// {
//     try {
//         $stmt = $conn->prepare("
//             UPDATE user 
//             SET firstName = ?, lastName = ?, email = ?, contactNo = ?, DOB = ?, gender = ?, username = ?
//             WHERE ID = ?
//         ");
//         $stmt->bind_param("sssssssi", $encrypted_base64_fname, $lastName, $email, $contactNumber, $birthdate, $gender, $username, $id);
//         $success = $stmt->execute();
//         $stmt->close();
//         return $success;
//     } catch (\Throwable $th) {
//         error_log("Update user details failed: " . $th->getMessage());
//         return false;
//     }
// }
