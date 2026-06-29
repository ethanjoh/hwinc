<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
}

include_once 'include/header.php';

?>
<style>
    .drop-zone {
        max-width: 600px;
        height: 220px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        border: 2px dashed #4e73df;
        border-radius: 12px;
        background-color: #f8f9fc;
        cursor: pointer;
        transition: background-color 0.2s ease, border-color 0.2s ease;
        position: relative;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .drop-zone:hover, .drop-zone.drag-over {
        background-color: #eaecf4;
        border-color: #2e59d9;
    }
    .drop-zone-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    .drop-zone-text {
        font-size: 16px;
        color: #4e73df;
        font-weight: bold;
        margin-top: 15px;
    }
    .drop-zone-subtext {
        font-size: 13px;
        color: #858796;
        margin-top: 5px;
    }
    .sample-download-area {
        margin-top: 25px;
    }
</style>

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
                    
                    <form enctype="multipart/form-data" action="draw-map.php" method="post" id="upload-form">
                        <div id="drop-zone" class="drop-zone">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                            <div class="drop-zone-text">CSV 파일을 이곳에 드래그하거나 클릭하여 선택하세요</div>
                            <div class="drop-zone-subtext">지명, 주소 순으로 정리된 CSV 형식만 지원합니다.</div>
                            <input type="file" name="myfile" id="myfile" class="drop-zone-input" accept=".csv" required>
                        </div>
                    </form>

                    <div class="sample-download-area">
                        <a href="sample-seoul.csv" class="btn btn-info" download><i class="fas fa-download"></i> 서울 유명 지역 10곳 예제 CSV 다운로드</a>
                    </div>
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

<script>
    $(document).ready(function() {
        var dropZone = $('#drop-zone');
        var fileInput = $('#myfile');

        dropZone.on('dragover dragenter', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.addClass('drag-over');
        });

        dropZone.on('dragleave drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.removeClass('drag-over');
        });

        dropZone.on('drop', function(e) {
            var files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                var file = files[0];
                var ext = file.name.split('.').pop().toLowerCase();
                if (ext !== 'csv') {
                    alert('CSV 파일만 업로드할 수 있습니다.');
                    return;
                }
                fileInput[0].files = files;
                $('.drop-zone-text').text(file.name + ' 파일을 업로드하는 중입니다...');
                $('#upload-form').submit();
            }
        });

        fileInput.on('change', function() {
            if (this.files.length > 0) {
                var file = this.files[0];
                $('.drop-zone-text').text(file.name + ' 파일을 업로드하는 중입니다...');
                $('#upload-form').submit();
            }
        });
    });
</script>

</body>
</html>
