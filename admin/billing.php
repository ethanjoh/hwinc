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
                    <h1 class="page-header"><i class="fas fa-won-sign"></i> 비용 청구</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2" style="margin-top: 30px;">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 30px;">
                            <form name="frm">
                                <div class="form-group row">
                                    <div class="col-lg-12"><input class="form-control" type="text" id="company_name" name="company_name" value="" placeholder="기관명"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12"><input class="form-control" type="date" id="sdate" name="sdate" value=""></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12"><input class="form-control" type="text" id="buyer_name" name="buyer_name" value="" placeholder="담당자명"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 form-inline text-center">
                                        <input class="form-control" type="text" id="buyer_tel_1" name="buyer_tel_1" value="" placeholder="010" style="width: 30%; text-align: center;"> -
                                        <input class="form-control" type="text" id="buyer_tel_2" name="buyer_tel_2" value="" placeholder="0000" style="width: 30%; text-align: center;"> -
                                        <input class="form-control" type="text" id="buyer_tel_3" name="buyer_tel_3" value="" placeholder="0000" style="width: 30%; text-align: center;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 form-inline">
                                        <input class="form-control text-right" type="text" id="weight" name="weight" value="" placeholder="수거량" style="width: 80%;"> kg
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 form-inline">
                                        <input class="form-control text-right" type="text" id="amount" name="amount" value="" placeholder="파쇄비" style="width: 70%;"> (부가세 포함)
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 30px;">
                                    <div class="col-lg-12 text-center">
                                        <input class="btn btn-success btn-lg" type="button" id="billing-btn" name="billing-btn" value="청구하기" style="width: 100%;">
                                    </div>
                                </div>
                            </form>
                            <div class="result_msg"></div>
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
