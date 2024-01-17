<?php

include_once '../util/config.php';
include_once '../util/functions.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$s_id         = $_SESSION['s_id'];
$company_name = $_POST['company_name'];
$pname        = $_POST['pname'];
$pwd          = $_POST['admin_pw1'];
// $pwd2         = $_POST['admin_pw2'];

$pwd = stripslashes($pwd);
// $pwd2 = stripslashes($pwd2);

// $pwd1 = mysqli_real_escape_string($connect, $pwd1);
// $pwd2 = mysqli_real_escape_string($connect, $pwd2);

$sql = "SELECT * FROM member WHERE id='$s_id'";
$res = mysqli_query($connect, $sql);
$row = mysqli_num_rows($res);

if ($row == 1) {
    // $rows = mysqli_fetch_array($connect, $res);

    $new_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $qry1    = "UPDATE member SET company='$company_name', pwd = '$new_pwd', pname = '$pname' WHERE id = '$s_id' ";
    $res1    = mysqli_query($connect, $qry1);

    if ($res1) {
        // echo "정보를 변경했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("정보를 변경했습니다.",
            {
                type: "success",
                ele: "body",
                offset: {
                from: "top",
                amount: 20
            },
            align: "center",
            width: 250,
            delay: 4000,
            allow_dismiss: true,
            stackup_spacing: 10
            });
        </script>

HEREDOC;
    } else {
        // echo "정보를 변경하는데 실패했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("정보를 변경하는데 실패했습니다.",
            {
                type: "success",
                ele: "body",
                offset: {
                from: "top",
                amount: 20
            },
            align: "center",
            width: 350,
            delay: 4000,
            allow_dismiss: true,
            stackup_spacing: 10
            });
        </script>

HEREDOC;
    }

}

mysqli_close($connect); // Closing Connection
