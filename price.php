<?php include "include/header.php";?>

			<div role="main" class="main">
				<section class="page-header page-header-classic page-header-sm">
					<div class="container">
						<div class="row">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 data-title-border>(입고) 파쇄비용 안내</h1>
							</div>
							<div class="col-md-4 order-1 order-md-2 align-self-center">
								<ul class="breadcrumb d-block text-md-right">
									<li><a href="index.php">Home</a></li>
									<li class="active">파쇄비용</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container">


					<section class="call-to-action featured featured-secondary mb-5">
						<div class="col-sm-9 col-lg-9">
							<div class="call-to-action-content">
								<h4>수거 및 파쇄가 끝나셨나요? 우측 결제하기로 이동해 주세요</h4>
								<p class="mb-0">간편하고 편리하게 온라인 카드결제를 하실 수 있습니다.</p>
								<p class="mb-0"><i class="fas fa-info-circle"></i> 수거 전에 카드단말기 사전 요청하시면 수거 시 오프라인 결제가 가능합니다.</p>
							</div>
						</div>
						<div class="col-sm-3 col-lg-3">
							<div class="call-to-action-btn">
								<a href="enter-payment.php" class="btn btn-modern text-2 btn-primary">파쇄비용 결제하기</a>
							</div>
						</div>
					</section>


					<!-- <div class="row mb-2"> -->
					<div class="row mb-4">
						<div class="col">
							<!-- <hr class="solid my-5"> -->
								<div class="col mb-5">
									<h2 class="font-weight-normal text-7 mb-2">소량(3톤 이하) <strong class="font-weight-extra-bold"> 문서파쇄 비용</strong> 산정</h2>
									<blockquote class="with-borders">
										<p class="lead">총비용 = 기본파쇄비용 + (중량별) 파쇄비용</p>
										<footer>
											<i class="fas fa-info-circle"></i> 현장파쇄가 아닌 입고파쇄비용입니다.<br>
											<i class="fas fa-info-circle"></i> 500kg 초과 시 기본 파쇄비용 외 중량별 파쇄비용을 합산하여 청구하게 됩니다.<br>
											<i class="fas fa-info-circle"></i> 대량 또는 정기적으로 파쇄하시는 경우에는 별도 문의바랍니다.
										</footer>
									</blockquote>
								</div>
						</div>
					</div>



					<!-- 그 외 지역 -->
					<div class="row mb-4">
						<div class="col">
							<h3 class="text-tertiary"><strong>(중량별) 파쇄비용</strong></h3>
						</div>

						<table class="table table-bordered">
							<thead>
								<tr>
									<th>기본 (500kg 이하)</th>
									<th colspan="3">501 ~ 3,000kg</th>
									<th colspan="3">3톤 초과</th>
								</tr>
							</thead>
							<tbody>
								<tr>
							  	<td class="text-center" >180,000원</td>
									<td class="text-center" colspan="3">18만원 + 120원/kg<br>예) 1톤일 경우 18만원 + (추가 500kg) 50,000원 = 23만원</td>
									<td class="text-center" colspan="3">별도 협의</td>
								</tr>
								<tr>
									<td colspan="5">
										<i class="fas fa-check-circle"></i> 부가세 별도금액입니다.<br>
										<i class="fas fa-check-circle"></i> A4 박스 기준 12.5kg 입니다.<br>
										<i class="fas fa-check-circle"></i> 가장 큰 우체국 박스 6호(52x48x40cm)의 경우 약 25kg 정도입니다.<br>
										<i class="fas fa-check-circle"></i> (소)마대(34x60cm)의 경우 약 15~18kg 정도입니다.<br>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="row mb-4">
						<div class="col">
							<hr class="solid my-5">
							<h3 class="text-carrot"><strong>공통사항(주의사항)</strong></h3>
							<p>
								<i class="fas fa-check-circle"></i> 재활용 가능한 종이(A4용지 등) 기준이며, 색지, 플라스틱 바인더, 스프링철, 비닐 등 폐기물은 분리 후 별도폐기하셔야 합니다.<br>
								<i class="fas fa-check-circle"></i> 사무실용 세절기(파쇄기)로 파쇄한 폐지는 종량제봉투로 버리시면 됩니다. (재활용안됨) <br>
								<i class="fas fa-check-circle"></i> 기사 1명, 사원 2명 기준입니다. <br>
							  <i class="fas fa-check-circle"></i> 2층 이상인 경우 엘리베이터 사용 가능해야 하며, 사다리차 이용 시 실비청구.<br>
							  <i class="fas fa-check-circle"></i> 탑차가 들어갈 수 없는 지하층일 경우 추가 비용발생.<br>
							  <i class="fas fa-check-circle"></i> 작업동선이 길거나 열악한 경우 인원 추가에 따른 비용 증가할 수 있습니다.<br>
							  <i class="fas fa-check-circle"></i> 수거가 용이하도록 박스나 마대 등에 담아두셔야 합니다.<br>
						  </p>
						</div>
					</div>

					</div>

				</div> <!-- // container -->



			</div>

<?php include "include/footer.php";?>
		</div>

<?php include "include/script.php";?>

	</body>

</html>
