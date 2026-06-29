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
$tmp_explode = explode('.', $name);
$ext   = array_pop($tmp_explode);

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
<style>
    /* 지도 3단 레이아웃 스타일 */
    .map-container-layout {
        display: flex;
        flex-direction: row;
        height: calc(100vh - 160px);
        min-height: 550px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 20px;
        border: 1px solid #e3e6f0;
    }
    .place-list-panel {
        width: 300px;
        height: 100%;
        background-color: #f8f9fc;
        border-right: 1px solid #e3e6f0;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    .place-list-header {
        padding: 15px;
        background-color: #4e73df;
        color: #fff;
        font-weight: bold;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .place-count-badge {
        background-color: rgba(255,255,255,0.25);
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 12px;
    }
    .place-list {
        list-style: none;
        padding: 0;
        margin: 0;
        overflow-y: auto;
        flex: 1;
    }
    .place-item {
        padding: 15px;
        border-bottom: 1px solid #eaecf4;
        cursor: pointer;
        transition: background-color 0.2s ease, border-left 0.1s ease;
    }
    .place-item:hover {
        background-color: #eaecf4;
    }
    .place-item.active {
        background-color: #e8ecf9;
        border-left: 5px solid #4e73df;
        font-weight: bold;
    }
    .place-title {
        font-size: 14px;
        color: #2e59d9;
        margin-bottom: 4px;
    }
    .place-addr {
        font-size: 12px;
        color: #858796;
        word-break: break-all;
    }
    .map-canvas-area {
        flex: 1.2;
        height: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    #map {
        width: 100% !important;
        height: 100% !important;
    }

    #roadview {
        width: 100% !important;
        height: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .panel-section-header {
        padding: 15px;
        background-color: #f8f9fc;
        color: #4e73df;
        font-weight: bold;
        font-size: 15px;
        border-bottom: 1px solid #e3e6f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .map-body-area {
        flex: 1;
        width: 100%;
        position: relative;
    }

    
    /* 로딩 스피너 */
    .map-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s ease;
    }
    .spinner-border {
        display: inline-block;
        width: 3rem;
        height: 3rem;
        vertical-align: text-bottom;
        border: .3em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        color: #4e73df;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    .loading-text {
        margin-top: 15px;
        font-weight: bold;
        color: #4e73df;
    }

    /* 다시 업로드하기 버튼 */
    .header-btn-area {
        float: right;
        margin-top: 10px;
    }

    /* 반응형 레이아웃 */
    @media (max-width: 991px) {
        .map-container-layout {
            flex-direction: column;
            height: auto;
        }
        .place-list-panel {
            width: 100%;
            height: 200px;
            border-right: none;
            border-bottom: 1px solid #e3e6f0;
        }
        .map-canvas-area {
            height: 500px;
        }
    }

    /* 프린트 전용 레이아웃 스타일 */
    @media print {
        #wrapper > nav,
        .header-btn-area,
        .place-list-panel,
        .panel-section-header,
        #roadviewModal {
            display: none !important;
        }
        #wrapper,
        #page-wrapper {
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            background-color: transparent !important;
            min-height: auto !important;
        }
        .map-container-layout {
            display: block !important;
            border: none !important;
            box-shadow: none !important;
            height: 600px !important;
            margin: 0 !important;
            width: 100% !important;
        }
        .map-canvas-area {
            width: 100% !important;
            height: 100% !important;
            display: block !important;
        }
        .map-body-area {
            height: 100% !important;
        }
        #map {
            width: 100% !important;
            height: 100% !important;
        }
        h1.page-header {
            margin-top: 0 !important;
            font-size: 24px !important;
            border-bottom: 2px solid #333 !important;
            padding-bottom: 10px !important;
        }
        @page {
            size: landscape;
            margin: 10mm;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        #map img {
            display: inline !important;
            visibility: visible !important;
            max-width: none !important;
            max-height: none !important;
        }
    }
</style>

<body>

    <div id="wrapper">
<?php
include_once 'include/navigation.php';
?>

        <div id="page-wrapper" style="padding-bottom: 20px; min-height: calc(100vh - 50px); background-color: #f8f9fc;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-btn-area" style="display: flex; gap: 8px;">
                        <button onclick="printMap();" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">지도 인쇄하기</span>
                        </button>
                        <a href="upload-map.php" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">다시 업로드하기</span>
                        </a>
                    </div>
                    <h1 class="page-header"><i class="fas fa-map-marked-alt text-primary"></i> 지도 데이터 시각화</h1>
                </div>
            </div>

            <!-- 지도/로드뷰/리스트 3단 그리드 -->
            <div class="map-container-layout">
                <!-- 1단: 장소 목록 패널 -->
                <div class="place-list-panel">
                    <div class="place-list-header">
                        장소 목록 <span class="place-count-badge" id="place-count">0건</span>
                    </div>
                    <ul class="place-list" id="place-list-container">
                        <!-- 동적으로 주소 목록이 렌더링됩니다 -->
                    </ul>
                </div>
                
                <!-- 2단: 지도 영역 -->
                <div class="map-canvas-area">
                    <div class="panel-section-header">
                        <i class="fas fa-map text-primary"></i> 위치 지도
                    </div>
                    <div class="map-body-area">
                        <div id="map"></div>
                        <!-- 로딩 스피너 -->
                        <div id="loading-overlay" class="map-loading-overlay">
                            <div class="spinner-border"></div>
                            <div class="loading-text">주소 좌표를 조회하고 지도를 생성 중입니다...</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 로드뷰 모달 팝업 -->
            <div class="modal fade" id="roadviewModal" tabindex="-1" role="dialog" aria-labelledby="roadviewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: none;">
                        <div class="modal-header" style="background-color: #4e73df; color: #fff; border-bottom: none; padding: 15px 20px;">
                            <h5 class="modal-title" id="roadviewModalLabel" style="font-weight: bold; font-size: 16px;">
                                <i class="fas fa-street-view"></i> <span id="roadview-title">로드뷰</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.8; text-shadow: none;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 0; height: 500px; position: relative; background-color: #f8f9fc;">
                            <div id="roadview" style="width: 100%; height: 100%;"></div>
                            <!-- 로드뷰 미지원 안내 오버레이 -->
                            <div id="roadview-error-overlay" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255,255,255,0.95); z-index: 10; align-items: center; justify-content: center; flex-direction: column;">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning" style="margin-bottom: 15px;"></i>
                                <div style="font-weight: bold; color: #5a5c69; font-size: 16px;">이 위치 주변에는 로드뷰가 지원되지 않습니다.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
            // CSV 파일 읽기
            $csvFilePath = "./map-data/" . $name;
            $tempCSV = file_get_contents($csvFilePath);
            $tempCSV = mb_convert_encoding($tempCSV, 'UTF-8', 'EUC-KR,UTF-8,CP949');

            $fp = tmpfile();
            fwrite($fp, $tempCSV);
            rewind($fp);
            setlocale(LC_ALL, 'ko_KR.UTF-8');

            $no = 0;
            $mapData = array();
            while ($data = fgetcsv($fp)) {
                $addr  = trim($data['1']); // 주소
                $title = trim($data['0']); // 타이틀
                if ($addr && $title) {
                    $mapData[$no] = '["' . addslashes($addr) . '", "' . addslashes($title) . '"],';
                    $no++;
                }
            }
            fclose($fp);
            ?>

            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=b2d3d5bba9dfb8777d3ac1fff27b7cc9&libraries=services"></script>

            <script>
                var listData = [
                    <?php
                    for ($i = 0; $i < count($mapData); $i++) {
                        echo $mapData[$i];
                    }
                    ?>
                ];

                // 지도 생성
                var mapContainer = document.getElementById('map');
                var mapOption = {
                    center: new kakao.maps.LatLng(37.566826, 126.9786567), // 서울시청 기준
                    level: 8
                };
                var map = new kakao.maps.Map(mapContainer, mapOption);

                // 컨트롤 추가
                var mapTypeControl = new kakao.maps.MapTypeControl();
                map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
                var zoomControl = new kakao.maps.ZoomControl();
                map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

                // Geocoder 생성
                var geocoder = new kakao.maps.services.Geocoder();
                
                // 로드뷰 인프라
                var roadviewContainer = document.getElementById('roadview');
                var roadview = new kakao.maps.Roadview(roadviewContainer);
                var roadviewClient = new kakao.maps.RoadviewClient();

                // 로드뷰 모달 오픈 함수
                function openRoadviewModal(title, coords) {
                    $('#roadview-title').text(title + ' - 로드뷰');
                    $('#roadview-error-overlay').hide();
                    $('#roadviewModal').modal('show');
                    
                    // 모달이 완전히 노출된 후 로드뷰 레이아웃 재조정 및 파노ID 설정
                    $('#roadviewModal').one('shown.bs.modal', function () {
                        roadview.relayout();
                        roadviewClient.getNearestPanoId(coords, 50, function(panoId) {
                            if (panoId) {
                                $('#roadview-error-overlay').hide();
                                roadview.setPanoId(panoId, coords);
                            } else {
                                $('#roadview-error-overlay').css('display', 'flex');
                            }
                        });
                    });
                }

                // 마커, 인포윈도우, 데이터 관리 맵 객체
                var markersMap = {};
                var infoWindowsMap = {};
                var coordsMap = {};
                var processedCount = 0;
                var validLocations = [];

                // 특정 장소를 포커싱하는 공통 함수
                function focusLocation(id, addr, title, coords) {
                    // 리스트 하이라이트 전환
                    $('.place-item').removeClass('active');
                    $('#place-item-' + id).addClass('active');

                    // 리스트 엘리먼트 스크롤 포커싱
                    var $container = $('.place-list');
                    var $elem = $('#place-item-' + id);
                    if($elem.length) {
                        $container.animate({
                            scrollTop: $elem.offset().top - $container.offset().top + $container.scrollTop() - 10
                        }, 300);
                    }

                    // 지도 이동
                    map.panTo(coords);

                    // 인포윈도우 활성화 (기존 인포윈도우를 닫지 않고 모두 표시되도록 유지)
                    infoWindowsMap[id].open(map, markersMap[id]);
                }

                // 전체 데이터 바인딩용 bounds 객체
                var bounds = new kakao.maps.LatLngBounds();

                if (listData.length === 0) {
                    $('#loading-overlay').hide();
                    $('#place-list-container').append('<li class="place-item text-center text-muted">등록된 장소가 없습니다.</li>');
                }

                listData.forEach(function(item, index) {
                    var address = item[0];
                    var title = item[1];

                    geocoder.addressSearch(address, function(result, status) {
                        processedCount++;

                        if (status === kakao.maps.services.Status.OK) {
                            var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
                            
                            // 마커 인스턴스 생성
                            var marker = new kakao.maps.Marker({
                                map: map,
                                position: coords
                            });

                            // 인포윈도우 정의
                            var infowindow = new kakao.maps.InfoWindow({
                                content: '<div style="width:180px;text-align:center;padding:8px 0;font-size:13px;font-weight:bold;color:#2e59d9;">' + title + '</div>'
                            });

                            // 데이터 매핑
                            markersMap[index] = marker;
                            infoWindowsMap[index] = infowindow;
                            coordsMap[index] = coords;

                            // 로딩 시점에 인포윈도우 표시
                            infowindow.open(map, marker);

                             // 마커 클릭 이벤트 연동
                             kakao.maps.event.addListener(marker, 'click', function() {
                                 focusLocation(index, address, title, coords);
                                 openRoadviewModal(title, coords);
                             });

                            bounds.extend(coords);
                            validLocations.push({ id: index, addr: address, title: title, coords: coords });

                            // 좌측 사이드바 장소 목록 패널에 동적 추가
                            var html = '<li class="place-item" id="place-item-' + index + '">' +
                                       '  <div class="place-title"><i class="fas fa-map-marker-alt"></i> ' + title + '</div>' +
                                       '  <div class="place-addr">' + address + '</div>' +
                                       '</li>';
                            $('#place-list-container').append(html);

                            // 리스트 아이템 클릭 이벤트 연동
                            $('#place-item-' + index).on('click', function() {
                                focusLocation(index, address, title, coords);
                            });
                        }

                        // 비동기 루프 종료 시점 판별
                        if (processedCount === listData.length) {
                            $('#loading-overlay').fadeOut();
                            $('#place-count').text(validLocations.length + '건');

                            if (validLocations.length > 0) {
                                // 모든 장소가 한 화면에 가득 차도록 축척 및 경계 맞춤
                                map.setBounds(bounds);
                                
                                // 기본적으로 첫 번째 장소를 포커싱
                                setTimeout(function() {
                                    var first = validLocations[0];
                                    focusLocation(first.id, first.addr, first.title, first.coords);
                                }, 500);
                            } else {
                                $('#place-list-container').append('<li class="place-item text-center text-muted">좌표를 검색할 수 있는 주소가 없습니다.</li>');
                            }
                        }
                    });
                });

                // 프린트 실행 함수
                function printMap() {
                    window.print();
                }

                // 브라우저 인쇄 이벤트 리스너 연동 (Ctrl+P 및 메뉴 인쇄 대응)
                window.addEventListener('beforeprint', function() {
                    // 지도 레이아웃 재계산 및 bounds 조정
                    map.relayout();
                    if (validLocations.length > 0) {
                        map.setBounds(bounds);
                    }
                });

                window.addEventListener('afterprint', function() {
                    // 화면 복구 후 지도 레이아웃 재계산
                    map.relayout();
                    
                    // 원래 활성화되어 있던 장소로 지도의 중심 복원
                    var activeItem = $('.place-item.active');
                    if (activeItem.length) {
                        var activeId = activeItem.attr('id').replace('place-item-', '');
                        if (coordsMap[activeId]) {
                            map.setCenter(coordsMap[activeId]);
                        }
                    } else if (validLocations.length > 0) {
                        map.setBounds(bounds);
                    }
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
