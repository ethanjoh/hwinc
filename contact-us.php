<?php include "include/header.php";?>

			<div role="main" class="main">

				<section class="page-header page-header-classic page-header-sm">

					<div class="container">
						<div class="row">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 data-title-border>찾아오시는 길</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb d-block text-md-right">
									<li><a href="index.php">Home</a></li>
									<li class="active">찾아오시는 길</li>
								</ul>
							</div>
						</div>
					</div>

				</section>

				<!-- 다음지도 -->
				<div class="container">
					<div class="row py-4">
						<div class="col">
							<div id="map" class="google-map mt-0" style="height: 500px;"></div>
						</div>
					</div>
				</div>

				<div class="container">

					<div class="row py-4">
						<div class="col-lg-6">

							<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="100">
								<h4 class="mt-2 mb-1">본사 및 파쇄공장</h4>
								<ul class="list list-icons list-icons-style-2 mt-2">
									<li><i class="fas fa-map-marker-alt top-6"></i> <strong class="text-dark">주소:</strong> (18527) 경기도 화성시 팔탄면 시청로 1060 (구장리 74-24)</li>
									<li><i class="fas fa-phone top-6"></i> <strong class="text-dark">문의전화:</strong> (031) 8059-3974</li>
									<li><i class="fas fa-fax top-6"></i> <strong class="text-dark">팩스:</strong> (031) 8059-5973</li>
									<li><i class="fas fa-envelope top-6"></i> <strong class="text-dark">Email:</strong> <a href="mailto:sales@hwinc.co.kr">sales@hwinc.co.kr</a></li>
								</ul>
							</div>

						</div>
						<div class="col-lg-6">

							<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="150">
								<h4 class="mt-2 mb-1">근무 시간</h4>
								<ul class="list list-icons list-dark mt-2">
									<li><i class="far fa-clock top-6"></i> 월 - 금 : 8am ~ </li>
									<li><i class="far fa-clock top-6"></i> 주말 : 휴무</li>
								</ul>
							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- 전환페이지 설정 -->
			<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
			<script type="text/javascript">
			var _nasa={};
			if(window.wcs) _nasa["cnv"] = wcs.cnv("5","10");
			</script>


<?php include "include/footer.php";?>
		</div>

<?php include "include/script.php";?>

		<!-- 다음지도 사용 -->
		<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=df5b9316780eedc5a86310a19dd6840b&libraries=services"></script>
		<script>
		var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
		var options = { //지도를 생성할 때 필요한 기본 옵션
			center: new kakao.maps.LatLng(37.172120, 126.903323), //지도의 중심좌표.
			level: 3 //지도의 레벨(확대, 축소 정도)
		};

		var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

		// 마커가 표시될 위치입니다
		var markerPosition  = new kakao.maps.LatLng(37.172120, 126.903323);

		// 마커를 생성합니다
		var marker = new kakao.maps.Marker({
		    position: markerPosition
		});

		// 마커가 지도 위에 표시되도록 설정합니다
		marker.setMap(map);

		var iwContent = '<div style="padding:5px;">향우실업(주) <br><a href="https://map.kakao.com/link/map/향우실업(주),37.172120, 126.903323" style="color:blue" target="_blank">큰지도보기</a> <a href="https://map.kakao.com/link/to/향우실업(주),37.172120, 126.903323" style="color:blue" target="_blank">길찾기</a></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
        iwPosition = new kakao.maps.LatLng(37.172120, 126.903323); //인포윈도우 표시 위치입니다

		// 인포윈도우를 생성합니다
		var infowindow = new kakao.maps.InfoWindow({
		    position : iwPosition,
		    content : iwContent
		});

		// 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
		infowindow.open(map, marker);

		// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
		var mapTypeControl = new kakao.maps.MapTypeControl();

		// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
		// kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
		map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

		// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
		var zoomControl = new kakao.maps.ZoomControl();
		map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);
		</script>
	</body>
</html>
