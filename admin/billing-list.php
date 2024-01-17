<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
}

include_once 'include/header.php';
?>

<body>

    <div id="wrapper">

<?php

include_once 'include/navigation.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

$sql   = "SELECT * FROM billing ORDER BY no DESC";
$res   = mysqli_query($connect, $sql);
$total = mysqli_num_rows($res);

?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-list-ol"></i> 청구 내역 - (<?php echo $total; ?>)건</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row add_user">
<?php

$scale = 10;
$page  = set_var($_GET['page']);

if ($page == '') {
    $page = 1;
}

$cpage     = intval($page);
$totalpage = intval($total / $scale);

if ($totalpage * $scale != $total) {
    $totalpage = $totalpage + 1;
}

if ($cpage == 1) {
    $cline = 0;
} else {
    $cline = ($cpage * $scale) - $scale;
}

$limit = $cline + $scale;

if ($limit >= $total) {
    $limit = $total;
}

$scale1 = $limit - $cline;

$sql    = "SELECT * FROM billing ORDER BY sdate DESC LIMIT $cline, $scale1";
$result = mysqli_query($connect, $sql);

//게시판 글번호를 실제 DB 저장번호와 관계없이 역순으로 표시
if ($page > 1 && $page < $totalpage) {
    $postNo = $total - $scale;
} elseif ($page == $totalpage) {
    $postNo = $total - $scale * ($page - 1);
} else {
    $postNo = $total;
}

echo <<<HEREDOC
                <div class="col-lg-12 margin_top_30">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">소속기관(구매자)명</th>
                                    <th class="text-center">파쇄일자</th>
                                    <th class="text-center">담당자</th>
                                    <th class="text-center">연락처</th>
                                    <th class="text-center">수거량(kg)</th>
                                    <th class="text-center">파쇄비(원)</th>
                                    <th class="text-center">결제여부</th>
                                    <th class="text-center">영수증 인쇄</th>
                                    <th class="text-center">취소</th>
                                </tr>
                            </thead>
                            <tbody>
HEREDOC;

if (mysqli_num_rows($result) > 0) {

    for ($i = 0; $row = mysqli_fetch_array($result); $i++) {

        //$sql1 = "SELECT * FROM billing";
        //$res1 = mysqli_query($connect, $sql1);
        //$ㅑrow1 = mysqli_fetch_array($res1);

        $post_no      = $postNo - $i;
        $company_name = $row['company_name'];
        $buyer_tel    = $row['buyer_tel_1'] . "-" . $row['buyer_tel_2'] . "-" . $row['buyer_tel_3'];
        $weight       = number_format($row['weight']);
        $amount       = number_format($row['amount']);
        $pg_tid       = $row['pg_tid'];

        if ($row['paid'] == "Y") {
            $url     = "'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" . $pg_tid . "&noMethod=1'";
            $opt     = "'_blank', 'width=450, height=600'";
            $receipt = '<a href="#" onclick="window.open(' . $url . ',' . $opt . ');"><i class="fas fa-print"></i></a>';
        } else {
            $receipt = '<i class="far fa-times-circle"></i>';
        }

        echo <<<HEREDOC

                                <tr>
                                    <td class="text-center">{$post_no}</td>
                                    <td class="text-center">{$company_name}</td>
                                    <td class="text-center">{$row['sdate']}</td>
                                    <td class="text-center">{$row['buyer_name']}</td>
                                    <td class="text-center">{$buyer_tel}</td>
                                    <td class="text-center">{$weight}</td>
                                    <td class="text-center">{$amount}</td>
                                    <td class="text-center">{$row['paid']}</td>
                                    <td class="text-center">{$receipt}</td>
                                    <td class="text-center"><a href="del-pay.php?no={$row['no']}"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
HEREDOC;
    }

} else {
    echo <<<HEREDOC
                                <tr>
                                    <td colspan="10" class="text-center">결제 내역이 없습니다.</td>
                                </tr>
HEREDOC;
}

echo <<<HEREDOC
                            </tbody>
                        </table>
                    </div>
                </div>
HEREDOC;
?>
                <div class="result_msg"></div>

                <div class="more-page-button">
                    <ul class="pagination">
<?php

//쪽 수를 표시
$url = $_SERVER['SCRIPT_NAME'] . "?";
page_mobile($totalpage, $cpage, $url);

?>

                    </ul>
                </div>
                <div class="more-page-button">
                    <!-- <button type="submit" class="btn btn-info export-btn"><i class="fa fa-file-excel-o" aria-hidden="true"></i> 엑셀로 저장</button> -->
                    <a href="export-excel.php" class="btn btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i> 엑셀로 저장</a>
                </div>

			</div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include_once 'include/footer.php';
?>

</body>

</html>
