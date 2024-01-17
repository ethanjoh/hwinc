<?php

include_once '../main/include/config.php';
include_once '../main/include/functions.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$chk      = set_var($_POST['chk']);
$contents = set_var($_POST['contents']);

if ($chk) {
    $flag = 'Y';
} else {
    $flag = 'N';
}

$query  = "SELECT * FROM popup ";
$result = mysqli_query($connect, $query);
// $row    = mysqli_fetch_array($result);

if ($result) {
    //update
    $dbinsert1 = "UPDATE popup SET contents='$contents', chk='$flag' LIMIT 1 ";
    $result1   = mysqli_query($connect, $dbinsert1);

    if ($result1) {
        // echo "팝업 공지를 수정했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("팝업 공지를 수정했습니다.",
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
        // echo "팝업 공지 수정 중 DB오류가 발생했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("팝업 공지 수정 중 DB오류가 발생했습니다.",
            {
                type: "danger",
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
} else {
    $dbinsert1 = "INSERT INTO popup(contents, chk) VALUES('$contents', '$flag')";
    $result1   = mysqli_query($connect, $dbinsert1);

    if ($result1) {
        // echo "팝업 공지를 등록했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("팝업 공지를 등록했습니다.",
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
        // echo "팝업 공지 등록 중 DB오류가 발생했습니다.";
        echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("팝업 공지 등록 중 DB오류가 발생했습니다.",
            {
                type: "danger",
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
