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

$sql   = "SELECT * FROM member ORDER BY company";
$res   = mysqli_query($connect, $sql);
$total = mysqli_num_rows($res);

?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-users"></i> 회원 관리 - (<?php echo $total; ?>)건</h1>
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

$sql    = "SELECT * FROM member ORDER BY company LIMIT $cline, $scale1";
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
                                    <th class="text-center">업체명</th>
                                    <th class="text-center">전화번호</th>
                                    <th class="text-center">담당자명</th>
                                    <th class="text-center">연락처</th>
                                    <th class="text-center">삭제</th>
                                </tr>
                            </thead>
                            <tbody>
HEREDOC;

if (mysqli_num_rows($result) > 0) {

    for ($i = 0; $row = mysqli_fetch_array($result); $i++) {

        $post_no = $postNo - $i;
        $ctel    = $row['ctel1'] . "-" . $row['ctel2'] . "-" . $row['ctel3'];
        $ptel    = $row['ptel1'] . "-" . $row['ptel2'] . "-" . $row['ptel3'];

        echo <<<HEREDOC

                                <tr>
                                    <td class="text-center">{$post_no}</td>
                                    <td class="text-center">{$row['company']}</td>
                                    <td class="text-center">{$ctel}</td>
                                    <td class="text-center">{$row['pname']}</td>
                                    <td class="text-center">{$ptel}</td>
                                    <td class="text-center"><a href="del-member.php?del-{$row['no']}"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
HEREDOC;
    }

} else {
    echo <<<HEREDOC
                                <tr>
                                    <td colspan="8" class="text-center">결제 내역이 없습니다.</td>
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
