<?php

include_once '../util/config.php';
include_once '../util/functions.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

//$s_id           = $_SESSION['s_id'];
$t_company_name = $_POST['company_name'];
$sdate          = $_POST['sdate'];
$t_buyer_name   = $_POST['buyer_name'];
$t_buyer_tel_1  = $_POST['buyer_tel_1'];
$t_buyer_tel_2  = $_POST['buyer_tel_2'];
$t_buyer_tel_3  = $_POST['buyer_tel_3'];
$t_weight       = $_POST['weight'];
$t_amount       = $_POST['amount'];

$company_name = trim($t_company_name);
$buyer_name   = trim($t_buyer_name);
$buyer_tel_1  = trim($t_buyer_tel_1);
$buyer_tel_2  = trim($t_buyer_tel_2);
$buyer_tel_3  = trim($t_buyer_tel_3);
$weight       = trim($t_weight);
$amount       = trim($t_amount);
$paid         = 'N';

$qry = "INSERT INTO billing (company_name, sdate, buyer_name, buyer_tel_1, buyer_tel_2, buyer_tel_3, weight, amount, paid)
                VALUES ('$company_name', '$sdate', '$buyer_name', '$buyer_tel_1', '$buyer_tel_2', '$buyer_tel_3', '$weight', '$amount', '$paid') ";
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
