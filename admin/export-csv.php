<?php
session_start();

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
    exit;
}

include_once '../util/config.php';
include_once '../util/functions.php';

$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);
$sql        = "SELECT * FROM billing ORDER BY no DESC";
$result     = mysqli_query($connection, $sql);

$filename = "청구_내역_목록-" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// 엑셀에서 한글이 깨지지 않도록 UTF-8 BOM(Byte Order Mark) 출력
echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

// 헤더 열 출력
fputcsv($output, array('#', '소속기관(구매자)명', '파쇄일자', '담당자', '연락처', '수거량(kg)', '파쇄비(원)', '결제여부'));

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $tel = $row['buyer_tel_1'] . "-" . $row['buyer_tel_2'] . "-" . $row['buyer_tel_3'];
        fputcsv($output, array(
            $row['no'],
            $row['company_name'],
            $row['sdate'],
            $row['buyer_name'],
            $tel,
            $row['weight'],
            $row['amount'],
            $row['paid']
        ));
    }
} else {
    fputcsv($output, array('데이터가 없습니다.'));
}

fclose($output);
exit;
