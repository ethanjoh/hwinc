<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
} else {
    $s_id = $_SESSION['s_id'];
}

include_once 'include/header.php';

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);
$sql     = "SELECT * FROM member WHERE id='$s_id'";
$res     = mysqli_query($connect, $sql);

if ($res) {
    $rows         = mysqli_fetch_array($res);
    $company_name = $rows['company'];
    $pname        = $rows['pname'];
}
?>

<body>

    <div id="wrapper">

<?php
include_once 'include/navigation.php';
?>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1 class="page-header">세팅</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row pw_form">
                <div class="col-lg-12 margin_top_30">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group form-inline">
                            <label for="company_name" class="col-sm-2 control-label">회사명</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="company_name" id="company_name" placeholder="관리자명" value="<?php echo $company_name; ?>">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="pname" class="col-sm-2 control-label">담당자명</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="pname" id="pname" placeholder="담당자명" value="<?php echo $pname; ?>">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="admin_pw1" class="col-sm-2 control-label">비밀번호 입력</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="admin_pw1" id="admin_pw1">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="admin_pw2" class="col-sm-2 control-label">비밀번호 재입력</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="admin_pw2" id="admin_pw2">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success" name="save-btn" id="save-btn" type="button">저장</button>
                        </div>
                    </form>
                    <div class="result_msg"></div>
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
