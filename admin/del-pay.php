<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
}

include_once '../util/config.php';
include_once '../util/functions.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$no = stripslashes($_GET['no']);

$sql    = "DELETE FROM billing WHERE no='$no'";
$result = mysqli_query($connect, $sql);

if ($result) {
    echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("청구내역을 삭제했습니다.",
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
