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

$sql   = "SELECT * FROM map ORDER BY no DESC";
$res   = mysqli_query($connect, $sql);
$total = mysqli_num_rows($res);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-upload"></i> 지도 데이터 업로드</h1>
                    <p>엑셀파일에 지명, 주소 순으로 데이터를 입력하고 CSV파일로 변환하여 업로드하세요</p>
                    <form enctype="multipart/form-data" action="draw-map.php" method="post">
                        <div class="form-group row">
                            <div class="col-lg-4"><input type="file" name="myfile"></div>
                            <div class="col-lg-4"><button>업로드하기</button></div>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include_once 'include/footer.php';
?>

</body>
</html>
