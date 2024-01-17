<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
}

include_once 'include/header.php';

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);

$sql      = "SELECT * FROM billing";
$res      = mysqli_query($connection, $sql);
$numOfPay = mysqli_num_rows($res);

if ($numOfPay > 0) {
    $num_pay = $numOfPay;
} else {
    $num_pay = 0;
}
; // $sql1        = "SELECT * FROM member";; // $res1        = mysqli_query($connect, $sql1);; // $numOfMember = mysqli_num_rows($res1);; // if ($numOfMember > 0) {; //     $num_member = $numOfMember - 1;; // } else {; //     $num_member = 0;; // }

?>

<body>

    <div id="wrapper">

<?php

include_once 'include/navigation.php';
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-tachometer-alt"></i> 대시보드</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-won-sign fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><i class="fab fa-cc-visa"></i></div>
                                    <div>비용 청구</div>
                                </div>
                            </div>
                        </div>
                        <a href="billing.php">
                            <div class="panel-footer">
                                <span class="pull-left">바로가기</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-list-ol fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $num_pay; ?></div>
                                    <div>청구 내역</div>
                                </div>
                            </div>
                        </div>
                        <a href="billing-list.php">
                            <div class="panel-footer">
                                <span class="pull-left">바로가기</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-map fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">MAP</div>
                                    <div>지도 그리기</div>
                                </div>
                            </div>
                        </div>
                        <a href="upload-map.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left">바로가기</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
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
