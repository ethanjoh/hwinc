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

        $sql   = "SELECT * FROM billing ORDER BY no DESC";
        $res   = mysqli_query($connect, $sql);
        $total = mysqli_num_rows($res);

        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-list-ol"></i> 청구 내역 - (<?php echo $total; ?>)건</h1>
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

                $sql    = "SELECT * FROM billing ORDER BY sdate DESC LIMIT $cline, $scale1";
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-list-ul"></i> 청구 내역 목록
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">소속기관(구매자)명</th>
                                    <th class="text-center">파쇄일자</th>
                                    <th class="text-center">담당자</th>
                                    <th class="text-center">연락처</th>
                                    <th class="text-center">수거량(kg)</th>
                                    <th class="text-center">파쇄비(원)</th>
                                    <th class="text-center">결제여부</th>
                                    <th class="text-center">영수증 인쇄</th>
                                    <th class="text-center">취소</th>
                                </tr>
                            </thead>
                            <tbody>
HEREDOC;

                if (mysqli_num_rows($result) > 0) {

                    for ($i = 0; $row = mysqli_fetch_array($result); $i++) {

                        //$sql1 = "SELECT * FROM billing";
                        //$res1 = mysqli_query($connect, $sql1);
                        //$ㅑrow1 = mysqli_fetch_array($res1);

                        $post_no      = $postNo - $i;
                        $company_name = $row['company_name'];
                        $buyer_tel    = $row['buyer_tel_1'] . "-" . $row['buyer_tel_2'] . "-" . $row['buyer_tel_3'];
                        $weight       = number_format($row['weight']);
                        $amount       = number_format($row['amount']);
                        $pg_tid       = $row['pg_tid'];

                        if ($row['paid'] == "Y") {
                            $url     = "'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" . $pg_tid . "&noMethod=1'";
                            $opt     = "'_blank', 'width=450, height=600'";
                            $receipt = '<a href="#" onclick="window.open(' . $url . ',' . $opt . ');"><i class="fas fa-print"></i></a>';
                        } else {
                            $receipt = '<i class="far fa-times-circle"></i>';
                        }

                        echo <<<HEREDOC

                                <tr>
                                    <td class="text-center">{$post_no}</td>
                                    <td class="text-center">{$company_name}</td>
                                    <td class="text-center">{$row['sdate']}</td>
                                    <td class="text-center">{$row['buyer_name']}</td>
                                    <td class="text-center">{$buyer_tel}</td>
                                    <td class="text-center">{$weight}</td>
                                    <td class="text-center">{$amount}</td>
                                    <td class="text-center">{$row['paid']}</td>
                                    <td class="text-center">{$receipt}</td>
                                    <td class="text-center"><a href="del-pay.php?no={$row['no']}"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
HEREDOC;
                    }
                } else {
                    echo <<<HEREDOC
                                <tr>
                                    <td colspan="10" class="text-center">결제 내역이 없습니다.</td>
                                </tr>
HEREDOC;
                }

                echo <<<HEREDOC
                            </tbody>
                                </table>
                            </div>
                        </div>
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
                    <a href="export-csv.php" class="btn btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i> CSV로 저장</a>
                </div>

                <?php
                // 연도별 데이터 추출
                $chart_sql = "SELECT LEFT(sdate, 4) AS year, SUM(amount) AS total_amount, COUNT(*) AS total_count FROM billing GROUP BY LEFT(sdate, 4) ORDER BY year ASC";
                $chart_res = mysqli_query($connect, $chart_sql);
                
                $chart_years = [];
                $chart_amounts = [];
                $chart_counts = [];
                
                if ($chart_res && mysqli_num_rows($chart_res) > 0) {
                    while ($chart_row = mysqli_fetch_array($chart_res)) {
                        $year = $chart_row['year'];
                        if (empty($year)) continue; // 빈 데이터 건너뛰기
                        $chart_years[] = $year . "년";
                        $chart_amounts[] = $chart_row['total_amount'];
                        $chart_counts[] = $chart_row['total_count'];
                    }
                }
                ?>

                <div class="col-lg-12 margin_top_30" style="margin-bottom: 50px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-chart-bar"></i> 연도별 청구 내역 및 결제 건수
                        </div>
                        <div class="panel-body">
                            <canvas id="yearlyChart" style="width: 100%; height: 400px;"></canvas>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var ctx = document.getElementById('yearlyChart').getContext('2d');
                        var years = <?php echo json_encode($chart_years); ?>;
                        var amounts = <?php echo json_encode($chart_amounts); ?>;
                        var counts = <?php echo json_encode($chart_counts); ?>;

                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: years,
                                datasets: [{
                                    label: '총 청구 금액(원)',
                                    data: amounts,
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1,
                                    yAxisID: 'y'
                                }, {
                                    label: '결제 건수(건)',
                                    data: counts,
                                    type: 'line',
                                    fill: false,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 1)',
                                    tension: 0.1,
                                    yAxisID: 'y1'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                scales: {
                                    y: {
                                        type: 'linear',
                                        display: true,
                                        position: 'left',
                                        title: {
                                            display: true,
                                            text: '청구 금액(원)'
                                        },
                                        ticks: {
                                            callback: function(value) {
                                                return value.toLocaleString();
                                            }
                                        }
                                    },
                                    y1: {
                                        type: 'linear',
                                        display: true,
                                        position: 'right',
                                        title: {
                                            display: true,
                                            text: '결제 건수(건)'
                                        },
                                        grid: {
                                            drawOnChartArea: false,
                                        },
                                        ticks: {
                                            stepSize: 1
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.dataset.label || '';
                                                if (label) {
                                                    label += ': ';
                                                }
                                                if (context.datasetIndex === 0) { // 금액
                                                    label += Number(context.raw).toLocaleString() + ' 원';
                                                } else { // 건수
                                                    label += context.raw + ' 건';
                                                }
                                                return label;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>

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