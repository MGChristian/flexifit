<?php
require_once "config.php";
require_once "send-sanitize.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['erros'] = $errors = [];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pickup_l = $_POST['pickup_l'];
    $pickup_s = $_POST['pickup_s'];
    $pickup_b = $_POST['pickup_b'];
    $pickup_c = $_POST['pickup_c'];
    $drop_l = $_POST['drop_address'];
    $postal = $_POST['Postal'];
    $notes = $_POST['notes'];
    $price = $_SESSION['price'];
    $booking_date_start = $_SESSION['time-start'];
    $booking_date_end = $_SESSION['time-end'];

    $bookingID = date("s") . bin2hex(random_bytes(8 / 2));
    $userID = date("s") . bin2hex(random_bytes(8 / 2));
    $serviceID = date("s") . bin2hex(random_bytes(8 / 2));

    $checker = new sanitizeSend();

    $errors = [];

    // if ($checker->is_input_empty($name, $email, $number, $pickup_l, $pickup_s, $pickup_b, $pickup_c, $drop_l, $drop_s, $drop_b, $drop_c, $postal)) {
    //     $errors[] = "Please input all required field";
    // }

    if ($checker->emailInvalid($email)) {
        $errors[] = "Please input a valid email";
    }

    if ($checker->invalidNumberChecker($number)) {
        $errors[] = "Please input a valid phone number";
    }


    echo $booking_date_start;

    if ($errors) {
        $_SESSION['errors'] = $errors;
        header("location: ../user/book_services.php");
    } else {
        $stmt = $conn->prepare("INSERT INTO `booking`(`ID`, `user_ID`, `service_ID`, `pickup_lot`, `pickup_street`, `pickup_brgy`, `pickup_city`, `drop_address`, `add_notes`, `price`, `booking_date_start`, `booking_date_end`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssss", $bookingID, $userID, $serviceID, $pickup_l, $pickup_s, $pickup_b, $pickup_c, $drop_l, $notes, $price, $booking_date_start, $booking_date_end);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO `user` (`ID`, `full_name`, `phone_number`, `email`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $userID, $name, $number, $email);
        $stmt->execute();
        header("location: ../user/book_services.php");
    }
} else {
    header("location: ../user/book_services.php");
}
