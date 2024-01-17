<?php

// include '../util/config.php';
// include '../util/functions.php';

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['id']) || empty($_POST['pwd'])) {
        $error = "아이디나 비밀번호를 입력하세요.";
    } else {

        // Define $id and $pwd
        $id  = $_POST['id'];
        $pwd = $_POST['pwd'];

        // To protect MySQL injection for Security purpose
        $id  = stripslashes($id);
        $pwd = stripslashes($pwd);
        $id  = mysqli_real_escape_string($connect, $id);
        $pwd = mysqli_real_escape_string($connect, $pwd);

        // SQL query to fetch information of registerd users and finds user match.
        $query  = "SELECT * FROM member WHERE id='$id'";
        $result = mysqli_query($connect, $query);
        $rows   = mysqli_fetch_array($result);

        if (password_verify($pwd, $rows['pwd'])) {

            $_SESSION["s_id"]      = $id;
            $_SESSION["s_company"] = $rows['company'];

            // header("location: https://" . $_SERVER['SERVER_NAME'] . ":" . $sslport . "/admin/main.php"); // Redirecting To Other Page
            header("location: https://" . $_SERVER['SERVER_NAME'] . "/admin/main.php"); // Redirecting To Other Page
        } else {
            $error = "아이디나 비밀번호를 다시한번 확인해 주세요.";
        }
        mysqli_close($connect); // Closing Connection
    }
}
