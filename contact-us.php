<?php include "include/header.php"; ?>

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
						<li><i class="far fa-clock top-6"></i> 월 - 금 : 8am ~ 5pm</li>
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
	var _nasa = {};
	if (window.wcs) _nasa["cnv"] = wcs.cnv("5", "10");
</script>


<?php include "include/footer.php"; ?>
</div>

<?php include "include/script.php"; ?>

<!-- 다음지도 사용 -->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=b2d3d5bba9dfb8777d3ac1fff27b7cc9&libraries=services"></script>
<script>
	var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
	var options = { //지도를 생성할 때 필요한 기본 옵션
		center: new kakao.maps.LatLng(37.172120, 126.903323), //지도의 중심좌표.
		level: 3 //지도의 레벨(확대, 축소 정도)
	};

	var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

	// 마커가 표시될 위치입니다
	var markerPosition = new kakao.maps.LatLng(37.172120, 126.903323);

	// 마커를 생성합니다
	var marker = new kakao.maps.Marker({
		position: markerPosition
	});

	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);

	var iwContent = '<div style="position:relative; padding:18px 20px; border-radius:18px; background:rgba(255,255,255,0.98); color:#222; box-shadow:0 20px 42px rgba(0,0,0,0.08); border:none; font-family:-apple-system, BlinkMacSystemFont, \"Segoe UI\", sans-serif; font-size:14px; line-height:1.65; min-width:260px;">' +
		'<div style="font-size:15px; font-weight:700; margin-bottom:8px; color:#111; letter-spacing:-0.02em;">향우실업(주)</div>' +
		'<div style="font-size:13px; color:#555; line-height:1.6; margin-bottom:14px;">경기도 화성시 팔탄면 시청로 1060</div>' +
		'<div style="display:flex; gap:10px; flex-wrap:wrap;">' +
		'<a href="https://map.kakao.com/link/map/향우실업(주),37.172120,126.903323" style="display:inline-flex; align-items:center; justify-content:center; padding:9px 12px; border-radius:999px; background:#0056d6; color:#fff; text-decoration:none; font-size:13px; font-weight:600;" target="_blank">큰지도 보기</a>' +
		'<a href="https://map.kakao.com/link/to/향우실업(주),37.172120,126.903323" style="display:inline-flex; align-items:center; justify-content:center; padding:9px 12px; border-radius:999px; background:#f1f5f9; color:#1f2937; text-decoration:none; font-size:13px; font-weight:600;" target="_blank">길찾기</a>' +
		'</div>' +
		'<div style="position:absolute; left:50%; bottom:-9px; transform:translateX(-50%); width:0; height:0; border-left:9px solid transparent; border-right:9px solid transparent; border-top:9px solid rgba(255,255,255,0.98);"></div>' +
		'</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
		iwPosition = new kakao.maps.LatLng(37.172750, 126.903323); //인포윈도우 표시 위치입니다

	// 커스텀 오버레이를 생성합니다
	var customOverlay = new kakao.maps.CustomOverlay({
		position: iwPosition,
		content: iwContent,
		yAnchor: 1
	});

	// 커스텀 오버레이를 표시합니다
	customOverlay.setMap(map);

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