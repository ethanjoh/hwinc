<?php

include_once '../util/config.php';
include_once '../util/functions.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

//$s_id           = $_SESSION['s_id'];
// $_POST 데이터가 없을 경우를 대비하여 Null 병합 연산자(??) 사용 및 공백 제거
$sdate        = trim($_POST['sdate'] ?? '');
$company_name = trim($_POST['company_name'] ?? '');
$buyer_name   = trim($_POST['buyer_name'] ?? '');
$buyer_tel_1  = trim($_POST['buyer_tel_1'] ?? '');
$buyer_tel_2  = trim($_POST['buyer_tel_2'] ?? '');
$buyer_tel_3  = trim($_POST['buyer_tel_3'] ?? '');
$weight       = trim($_POST['weight'] ?? '');
$amount       = trim($_POST['amount'] ?? '');
$paid         = 'N';

// SQL 인젝션 및 작은따옴표(') 입력 시 발생하는 쿼리 오류를 방지하기 위해 이스케이프 처리
$sdate_esc        = mysqli_real_escape_string($connect, $sdate);
$company_name_esc = mysqli_real_escape_string($connect, $company_name);
$buyer_name_esc   = mysqli_real_escape_string($connect, $buyer_name);
$buyer_tel_1_esc  = mysqli_real_escape_string($connect, $buyer_tel_1);
$buyer_tel_2_esc  = mysqli_real_escape_string($connect, $buyer_tel_2);
$buyer_tel_3_esc  = mysqli_real_escape_string($connect, $buyer_tel_3);
$weight_esc       = mysqli_real_escape_string($connect, $weight);
$amount_esc       = mysqli_real_escape_string($connect, $amount);

$qry = "INSERT INTO billing (company_name, sdate, buyer_name, buyer_tel_1, buyer_tel_2, buyer_tel_3, weight, amount, paid)
                VALUES ('$company_name_esc', '$sdate_esc', '$buyer_name_esc', '$buyer_tel_1_esc', '$buyer_tel_2_esc', '$buyer_tel_3_esc', '$weight_esc', '$amount_esc', '$paid') ";
$res = mysqli_query($connect, $qry);

if ($res) {
    // echo "정보를 변경했습니다.";
    echo <<<HEREDOC

        <script>
            $.bootstrapGrowl("비용을 청구했습니다.",
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
            $.bootstrapGrowl("비용을 청구하는데 실패했습니다.",
            {
                type: "warning",
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

mysqli_close($connect); // Closing Connection
