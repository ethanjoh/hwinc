<?php

// HTTPS 체크 및 URL 리턴
if (!isset($_SERVER["HTTPS"])) {
    header('Location: https://www.hwinc.co.kr/admin');
}

if (isset($_SESSION['s_id'])) {
    header("location: main.php");
}

include_once "include/header.php";

include "login.php"; // Includes Login Script

?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">관리자 로그인하세요</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="아이디" name="id" type="id" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="패스워드" name="pwd" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="text-center">
                                    <input class="btn btn-success" name="submit" type="submit" value="로그인">
                                </div>
                                <div class="inverse_text_red margin_top_30">
                                    <span class="color_white" id="login_err"><?php echo $error; ?></span>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include_once 'include/footer.php';
?>

</body>

</html>
