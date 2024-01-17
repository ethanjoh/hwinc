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
                    <h1 class="page-header">팝업공지 관리</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row popup_editor">

      <!-- POPUP -->
<?php

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);
$qry2    = "SELECT * FROM popup LIMIT 1";
$result2 = mysqli_query($connect, $qry2);
$row2    = mysqli_fetch_array($result2);

?>

                <!-- JS -->
                <script src="/bbs/ckeditor/ckeditor.js" charset="utf-8"></script>
                <form name="form1" method="post" enctype="multipart/form-data" action="">
                  <div class="row" style="margin-top:20px;">
                    <div class="col-lg-12">
                      <textarea name="contents" class="form-control" id="contents"><?php echo stripslashes($row2['contents']); ?></textarea>
                      <script type="text/javascript">
                          CKEDITOR.replace( 'contents', {
                              disallowedContent: 'img{width,height};'
                          });

                          // Show upload tab first
                          CKEDITOR.on('dialogDefinition', function(ev) {
                            // Take the dialog window name and its definition from the event data.
                            var dialogName = ev.data.name;
                            var dialogDefinition = ev.data.definition;

                            if (dialogName == 'image') {
                              dialogDefinition.onShow = function () {
                                // This code will open the Advanced tab.
                                this.selectPage('Upload');
                              };
                            }
                          });
                      </script>
                    </div>
                  </div>

                  <div class="text-center" style="margin: 20px 0;">
                    <input type="checkbox" name="chk" id="chk" value="<?php echo $row2['chk'] == 'Y' ? "Y" : "N"; ?>" <?php echo $row2['chk'] == 'Y' ? "checked" : ""; ?>  />메인에 팝업창 띄우기
                    <button class="btn btn-success" type="button" name="save-popup-btn" id="save-popup-btn">저장</button>
                  </div>
              </form>
              <div class="result_msg"></div>

			      <!-- </div> -->
            <!-- /.row popup_editor -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include_once 'include/footer.php';
?>

</body>

</html>
