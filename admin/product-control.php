<?php
session_start(); // Starting Session

if (!isset($_SESSION['login_user'])) {
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
                    <h1 class="page-header">제품 추가/수정</h1>
                    <p class="help-block">시리얼번호는 자동생성됩니다.</p>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<?php

$mode = set_var($_GET['mode']);

if ($mode == "edit") {
    $no   = $_GET['no'];
    $mode = $_GET['mode'];

    $connection = mysqli_connect($host, $dbid, $dbpass, $dbname);
    $sql        = "SELECT * FROM product_list WHERE no='$no'";
    $res        = mysqli_query($connection, $sql);
    $row        = mysqli_fetch_array($res);

// if ($mode == "edit") {

    $serial_no = explode('-', $row['serial_no']);
    $model_no  = explode('-', $row['model_no']);

    ?>
            <div class="row add_product">
                <div class="col-lg-12 margin_top_30">
				 <form class="form-horizontal" action="" method="post">
                 <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
                 <input type="hidden" name="no" id="no" value="<?php echo $no; ?>">
                    <div class="form-group form-inline">
                        <label for="serial-prefix" class="col-sm-2 control-label">시리얼번호</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="serial-prefix" id="serial-prefix" required>
                                <option>--</option>
                                <option value="A"<?php if ($serial_no[0] == 'A') {
        echo ' selected="selected"';
    }
    ?>>A</option>
                                <option value="B"<?php if ($serial_no[0] == 'B') {
        echo ' selected="selected"';
    }
    ?>>B</option>
                                <option value="C"<?php if ($serial_no[0] == 'C') {
        echo ' selected="selected"';
    }
    ?>>C</option>
                                <option value="D"<?php if ($serial_no[0] == 'D') {
        echo ' selected="selected"';
    }
    ?>>D</option>
                                <option value="E"<?php if ($serial_no[0] == 'E') {
        echo ' selected="selected"';
    }
    ?>>E</option>
                                <option value="F"<?php if ($serial_no[0] == 'F') {
        echo ' selected="selected"';
    }
    ?>>F</option>
                                <option value="G"<?php if ($serial_no[0] == 'G') {
        echo ' selected="selected"';
    }
    ?>>G</option>
                                <option value="H"<?php if ($serial_no[0] == 'H') {
        echo ' selected="selected"';
    }
    ?>>H</option>
                                <option value="I"<?php if ($serial_no[0] == 'I') {
        echo ' selected="selected"';
    }
    ?>>I</option>
                                <option value="J"<?php if ($serial_no[0] == 'J') {
        echo ' selected="selected"';
    }
    ?>>J</option>
                            </select> - <input type="text" class="form-control" name="serial-postfix" id="serial-postfix" value="<?php echo $serial_no[1]; ?>" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="user-phone" class="col-sm-2 control-label">모델</label>
                        <div class="col-sm-10">
                            SHARK - <input type="text" class="form-control" value="<?php echo $model_no[1]; ?>" name="model-no" id="model-no" required>
                        </div>
                    </div>
				 	<div class="form-group">
				 		<label for="user-id" class="col-sm-2 control-label">제조년월일</label>
                        <div class="col-sm-10" id="cuppaDatePickerContainer">
                        </div>
				 	</div>
					<div class="form-group">
						<label for="user-pw" class="col-sm-2 control-label">A/S 내역</label>
                        <div class="col-sm-10">
                            <textarea name="as_content" class="form-control" id="as_content" rows="10"><?php echo stripslashes($row['after_service']); ?></textarea>
                        </div>
				 	</div>
                    <div class="form-group">
                        <label for="user-pw" class="col-sm-2 control-label">비고</label>
                        <div class="col-sm-10">
                            <textarea name="ref_content" class="form-control" id="ref_content" rows="5"><?php echo stripslashes($row['reference']); ?></textarea>
                        </div>
                    </div>
                    <div class="text-center">
				 	  <button type="button" class="btn btn-success" name="submit-btn" id="submit-btn"><i class="fa fa-check-square-o"></i> 수정</button>
                      <button type="button" class="btn btn-default" name="list-btn" id="list-btn">제품 목록</button>
                    </div>
				 </form>
                 <div class="result_msg"></div>
                 </div>
			</div>

<?php

} else {
    ; // 신규추가
    ?>

            <div class="row add_product">
                <div class="col-lg-12 margin_top_30">
                 <form class="form-horizontal" action="" method="post">
                 <input type="hidden" name="mode" id="mode" value="new">
                 <input type="hidden" name="no" id="no" value="">
                    <div class="form-group form-inline">
                        <label for="serial-prefix" class="col-sm-2 control-label">시리얼번호</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="serial-prefix" id="serial-prefix">
                                <option>--</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>F</option>
                                <option>G</option>
                                <option>H</option>
                                <option>I</option>
                                <option>J</option>
                            </select> - <input type="text" class="form-control" name="serial-postfix" id="serial-postfix" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="user-phone" class="col-sm-2 control-label">모델</label>
                        <div class="col-sm-10">
                            SHARK - <input type="text" class="form-control" name="model-no" id="model-no" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-id" class="col-sm-2 control-label">제조년월일</label>
                        <div class="col-sm-10" id="cuppaDatePickerContainer">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-pw" class="col-sm-2 control-label">A/S 내역</label>
                        <div class="col-sm-10">
                            <textarea name="as_content" class="form-control" id="as_content" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-pw" class="col-sm-2 control-label">비고</label>
                        <div class="col-sm-10">
                            <textarea name="ref_content" class="form-control" id="ref_content" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                      <button type="button" class="btn btn-success" name="submit-btn" id="submit-btn"><i class="fa fa-check-square-o"></i> 추가</button>
                      <button type="button" class="btn btn-default" name="list-btn" id="list-btn">제품 목록</button>
                    </div>
                 </form>
                 <div class="result_msg"></div>
                 </div>
            </div>


<?php

}
?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include_once 'include/footer.php';
?>

    <script type="text/javascript">
        var cal  = new WinkelCalendar({
            container: 'cuppaDatePickerContainer',
            defaultDate : new Date(),
            bigBanner: true,
            format : "YYYY-MM-DD",
            onSelect : null
        });

<?php

if ($mode == "edit") {
    ?>

            cal.setDate('<?php echo $row['install_date']; ?>');
        <?php
}
?>

        $('#serial-prefix').change(function(){
                var text = "";
                var possible = "012345";

                for( var i=0; i < 5; i++ ) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }

          $("#serial-postfix").val(text);
        });

        $('#list-btn').click(function(){
                window.location.href="product-list.php";
        });
    </script>

</body>

</html>
