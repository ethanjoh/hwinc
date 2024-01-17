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
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">제품 목록</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row add_user">
<?php

$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);
$sql        = "SELECT * FROM product_list ORDER BY no DESC";
$res        = mysqli_query($connection, $sql);
$total      = mysqli_num_rows($res);

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

$sql    = "SELECT * FROM product_list ORDER BY no DESC LIMIT $cline,$scale1";
$result = mysqli_query($connection, $sql);

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
                                    <th class="text-center">S/N</th>
                                    <th class="text-center">모델명</th>
                                    <th class="text-center">제조년월일</th>
                                    <th class="text-center" width="50%">A/S</th>
                                    <th class="text-center" width="20%">비고</th>
                                    <th class="text-center">삭제</th>
                                </tr>
                            </thead>
                            <tbody>
HEREDOC;

if (mysqli_num_rows($result)) {
    for ($i = 0; $row = mysqli_fetch_array($result); $i++) {

        $post_no       = $postNo - $i;
        $after_service = stripslashes(nl2br($row['after_service']));
        $reference     = stripslashes(nl2br($row['reference']));

        echo <<<HEREDOC

                                <tr>
                                    <td>{$post_no}</td>
                                    <td class="text-center"><a href="product-control.php?mode=edit&no={$row['no']}">{$row['serial_no']}</a></td>
                                    <td class="text-center">{$row['model_no']}</td>
                                    <td class="text-center">{$row['install_date']}</td>
                                    <td>{$after_service}</td>
                                    <td>{$reference}</td>
                                    <td class="text-center"><button type="submit" id="del-{$row['no']}" class="btn btn-danger del-btn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                                </tr>
HEREDOC;
    }
} else {
    echo <<<HEREDOC
                                <tr>
                                    <td colspan="7" class="text-center">No Data</td>
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
