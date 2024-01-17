<?php

session_start(); // Starting Session

include "include/header.php";

$no = set_var($_GET['no']);
?>

<body>

  <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                  <form class="form-group">
                    <table>
                      <tr>
                        <td>
                          <label>파쇄일자</label>
                          <input class="form-control" type="text" name="weight" value="">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label>수거량(kg)</label>
                          <input class="form-control text-right" type="text" name="weight" value="">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label>파쇄비용</label>
                          <input class="form-control text-right" type="text" name="price" value="">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label>저장</label>
                          <a href="save-pay.php?no=<?php echo $no; ?>"><i class="far fa-save"></i></a>
                        </td>
                      </tr>
                    </table>
                  </form>

                </div>
              </div>
            </div>

  </div>

</body>

</html>
