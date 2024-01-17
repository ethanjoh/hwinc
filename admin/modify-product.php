<?php
session_start(); // Starting Session

if (!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

include_once '../main/include/config.php';
include_once '../main/include/functions.php';

$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);

$mode           = $_POST['mode'];
$no             = $_POST['no'];
$serial_prefix  = $_POST['serial_prefix'];
$serial_postfix = $_POST['serial_postfix'];
$model_no       = $_POST['model_no'];
$install_date   = $_POST['install_date'];
$as_content     = addslashes($_POST['as_content']);
$ref_content    = addslashes($_POST['ref_content']);

if ($mode == "edit") {
    $serial_no = $serial_prefix . "-" . $serial_postfix;
    $model_no  = "SHARK-" . $model_no;

    $sql = "UPDATE product_list SET
                serial_no     = '$serial_no',
                model_no      = '$model_no',
                install_date  = '$install_date',
                after_service = '$as_content',
                reference     = '$ref_content'
        WHERE no = '$no' ";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // echo "정보를 수정했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("정보를 수정했습니다.",
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
        // echo "오류가 발생했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("오류가 발생했습니다.",
            {
                type: "danger",
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

    }
} elseif ($mode == "new") {

    $serial_no = $serial_prefix . "-" . $serial_postfix;
    $model_no  = "SHARK-" . $model_no;

    $sql = "INSERT INTO product_list (serial_no, model_no, install_date, after_service, reference)
                   VALUES ('$serial_no', '$model_no', '$install_date', '$as_content', '$ref_content')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        // echo "제품을 추가했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("제품을 추가했습니다.",
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
        // echo "오류가 발생했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("오류가 발생했습니다.",
            {
                type: "danger",
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
    }
}
