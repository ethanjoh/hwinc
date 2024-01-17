<?php

include "util/config.php";
include "util/functions.php";

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$error = ""; // Variable To Store Error Message

if (isset($_POST['submit'])) {

    // Define $id and $pwd
    $t_buyer_name  = $_POST['buyer_name'];
    $t_buyer_tel_1 = $_POST['buyer_tel_1'];
    $t_buyer_tel_2 = $_POST['buyer_tel_2'];
    $t_buyer_tel_3 = $_POST['buyer_tel_3'];

    // To protect MySQL injection for Security purpose
    $buyer_name  = stripslashes($t_buyer_name);
    $buyer_tel_1 = stripslashes($t_buyer_tel_1);
    $buyer_tel_2 = stripslashes($t_buyer_tel_2);
    $buyer_tel_3 = stripslashes($t_buyer_tel_3);
    $buyer_name  = mysqli_real_escape_string($connect, $buyer_name);
    $buyer_tel_1 = mysqli_real_escape_string($connect, $buyer_tel_1);
    $buyer_tel_2 = mysqli_real_escape_string($connect, $buyer_tel_2);
    $buyer_tel_3 = mysqli_real_escape_string($connect, $buyer_tel_3);

    // SQL query to fetch information of registerd users and finds user match.
    $query  = "SELECT * FROM billing WHERE buyer_name='$buyer_name' AND buyer_tel_2='$buyer_tel_2' AND buyer_tel_3='$buyer_tel_3' ";
    $result = mysqli_query($connect, $query);
    //$rows   = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION['s_buyer_name']  = $buyer_name;
        $_SESSION['s_buyer_tel_1'] = $buyer_tel_1;
        $_SESSION['s_buyer_tel_2'] = $buyer_tel_2;
        $_SESSION['s_buyer_tel_3'] = $buyer_tel_3;

        header("location: https://" . $_SERVER['SERVER_NAME'] . "/payment.php"); // Redirecting To Other Page
    } else {
        $error = "성함이나 연락처를 다시한번 확인해 주세요.";
        session_unset();
    }
    mysqli_close($connect); // Closing Connection
}
