<?php

class sanitizeSend
{
    private $name;
    private $email;
    private $phone;
    private $company;
    private $p_lot;
    private $p_street;
    private $p_brgy;
    private $p_city;
    private $d_lot;
    private $d_street;
    private $d_brgy;
    private $d_city;
    private $postal;
    private $additional;

    function is_input_empty($name, $email, $phone, $p_lot, $p_street, $p_brgy, $p_city, $d_lot, $d_street, $d_brgy, $d_city, $postal)
    {
        if (empty($name) || empty($email) || empty($phone) || empty($p_lot) || empty($p_street) || empty($p_brgy) || empty($p_city) || empty($d_lot) || empty($d_street) || empty($d_brgy) || empty($d_city) || empty($postal)) {
            return true;
        } else {
            return false;
        }
    }

    function emailInvalid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function invalidNumberChecker($number)
    {
        if (!preg_match("/^[0-9]{11}$/", $number)) {
            return true;
        } else {
            return false;
        }
    }
}
