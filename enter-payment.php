<?php include "include/verify-payment.php";?>

<?php include "include/header.php";?>

			<div role="main" class="main">
				<section class="page-header page-header-classic page-header-sm">
					<div class="container">
						<div class="row">
							<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
								<h1 data-title-border>파쇄비용 결제</h1>
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

					<div class="row col-lg-12 mb-4 text-center">
						<div class="col-md-8 mx-md-auto">
						<!-- card payment -->
						<div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
							<div class="card border-0 bg-color-grey">
								<div class="card-body">
									<i class="far fa-credit-card fa-2x text-carrot"></i> <span style="font-size:x-large;">ONLIE PAYMENT</span>
									<p><i class="fas fa-arrow-circle-right"></i> 사전에 알려드린 성함과 연락처를 입력 후 결제확인 버튼을 눌러주세요</br>
									<i class="fas fa-arrow-circle-right"></i> 법인카드 결제 시 법인공인인증서가 필요할 수 있습니다</p>
									<p><i class="fas fa-arrow-circle-right"></i> 오프라인 결제는 수거 전에 미리 요청하셔야 카드단말기로 결제가 가능합니다.</p>
									<form action="" name="frm" method="post">
										<div class="form-group row">
											<label class="font-weight-bold text-dark text-2">성&nbsp;&nbsp;&nbsp;&nbsp;함</label>
											<div class="col-lg-3"><input type="text" class="form-control" name="buyer_name" data-name="담당자명" value=""></div>
										</div>
										<div class="form-group row">
											<label class="font-weight-bold text-dark text-2">연락처</label>
											<div class="col-lg-3"><input type="text" class="form-control" name="buyer_tel_1" data-name="전화번호" value=""></div>
											<div class="col-lg-3"><input type="text" class="form-control" name="buyer_tel_2" data-name="전화번호" value=""></div>
											<div class="col-lg-3"><input type="text" class="form-control" name="buyer_tel_3" data-name="전화번호" value=""></div>
										</div>
										<div class="text-center">
											<input type="submit" id="submit" class="btn btn-primary btn-modern mt-2" name="submit" value="결제확인">
											<p><br><i class="fas fa-user-lock"></i> 결제는 이니시스를 통해 안전하게 이루어집니다.</p>
											<p><img src='https://image.inicis.com/mkt/certmark/inipay/inipay_74x74_color.png' border='0' alt='클릭하시면 이니시스 결제시스템의 유효성을 확인하실 수 있습니다.' style='cursor:hand' Onclick=javascript:window.open('https://mark.inicis.com/mark/popup_v3.php?mid=MOI2756496','mark','scrollbars=no,resizable=no,width=565,height=683');></p>
										</div>

										<div class="mt-2 text-center text-carrot">
												<?php echo $error; ?>
										</div>

									</form>
								</div>
							</div>
						</div><!-- // card payment -->
					</div>

					</div>

<!-- 					<div class="row mt-5 mb-4">
						<div class="col-lg-12">
							<h5>환불 안내</h5>
								<p><i class="far fa-check-square" style="user-select: auto;"></i> 안내받은 금액과 결제 금액이 다른 경우<br>
									 <i class="far fa-check-square" style="user-select: auto;"></i> 여러 개의 결제내역 중 다른 파쇄날짜의 결제내역으로 결제한 경우<br>
								</p>
						</div>
					</div> -->


				</div><!-- // container -->

			</div><!-- // main -->



			</div>

<?php include "include/footer.php";?>
		</div>

<?php include "include/script.php";?>



	</body>

</html>

