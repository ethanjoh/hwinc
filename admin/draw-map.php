<?php

session_start(); // Starting Session

if (!isset($_SESSION['s_id'])) {
    header("location: index.php");
}

include_once 'include/header.php';

// 설정
$uploads_dir = './map-data';
$allowed_ext = array('csv');

// 변수 정리
$error = $_FILES['myfile']['error'];
$name  = $_FILES['myfile']['name'];
$ext   = array_pop(explode('.', $name));

// 오류 확인
if ($error != UPLOAD_ERR_OK) {
    switch ($error) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "파일이 너무 큽니다. ($error)";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "파일이 첨부되지 않았습니다. ($error)";
            break;
        default:
            echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    exit;
}

// 확장자 확인
if (!in_array($ext, $allowed_ext)) {
    echo "허용되지 않는 확장자입니다.";
    exit;
}

// 파일 이동
move_uploaded_file($_FILES['myfile']['tmp_name'], "$uploads_dir/$name");

?>


<body>

    <div id="wrapper">

        <div id="map-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fas fa-map"></i> 지도 그리기</h1>
                    <p>
<?php

// 파일 정보 출력
echo "<h2>위치를 클릭하면 로드뷰를 볼 수 있습니다</h2>";
// 엑셀파일 읽기
$csvFilePath = "./map-data/" . $name;

// 테이블을 비우고 입력하고 싶을 때
// mysqli_query($connect, "TRUNCATE TABLE products");

$tempCSV = file_get_contents($csvFilePath);
// $tempCSV = mb_convert_encoding($tempCSV, 'UTF-8', 'EUC-KR');

$fp = tmpfile();
fwrite($fp, $tempCSV);
rewind($fp);
// setlocale(LC_ALL, 'ko_KR.UTF-8');

// mapData 배열에 저장
$no = 0;
while ($data = fgetcsv($fp)) {

    $num = count($data);

    $addr  = trim($data['1']); // 주소
    $title = trim($data['0']); // 타이틀

    $mapData[$no] = '["' . $addr . '", "' . $title . '"],';

    $no++;

}
fclose($fp);

?>
                    </p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div id="map"></div>
            <div id="roadview"></div>

            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=b2d3d5bba9dfb8777d3ac1fff27b7cc9&libraries=services"></script>

            <script>

                var listData = [
<?php

for ($i = 0; $i < count($mapData); $i++) {
    echo $mapData[$i];
}
;?>
                ];

                // 맵을 넣을 div
                var mapContainer = document.getElementById('map');
                var mapOption = {
                    center: new kakao.maps.LatLng(35.95, 128.25),
                    level: 8
                };

                // 맵 표시
                var map = new kakao.maps.Map(mapContainer, mapOption);

                // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
                var mapTypeControl = new kakao.maps.MapTypeControl();
                map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

                // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
                var zoomControl = new kakao.maps.ZoomControl();
                map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

                // 주소 -> 좌표 변환 라이브러리
                var geocoder = new kakao.maps.services.Geocoder();

                // foreach loop
                listData.forEach(function(addr, index) {
                    geocoder.addressSearch(addr[0], function(result, status) {
                        if (status === kakao.maps.services.Status.OK) {
                            var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                            var marker = new kakao.maps.Marker({
                                map: map,
                                position: coords
                            });

                            // 마커를 지도에 표시합니다.
                            marker.setMap(map);

                            // 인포윈도우를 생성합니다
                            var infowindow = new kakao.maps.InfoWindow({
                                content: '<div style="width:150px;text-align:center;padding:6px 0;">' + addr[1] + '</div>'
                            });

                            infowindow.open(map, marker);

                            // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                            map.setCenter(coords);


                // 마커에 클릭이벤트를 등록합니다
                kakao.maps.event.addListener(marker, 'click', function() {
                    var roadviewContainer = document.getElementById('roadview'); //로드뷰를 표시할 div
                    var roadview = new kakao.maps.Roadview(roadviewContainer); //로드뷰 객체
                    var roadviewClient = new kakao.maps.RoadviewClient(); //좌표로부터 로드뷰 파노ID를 가져올 로드뷰 helper객체

                    var position = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 특정 위치의 좌표와 가까운 로드뷰의 panoId를 추출하여 로드뷰를 띄운다.
                    roadviewClient.getNearestPanoId(position, 50, function(panoId) {
                        roadview.setPanoId(panoId, position); //panoId와 중심좌표를 통해 로드뷰 실행
                    });
                });
                        }
                    });
                });






            </script>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include_once 'include/footer.php';
?>

</body>
</html>
