 $(function(){


 	// 로그인 에러 표시
 	$('.inverse_text_red').hide();

 	if($('#login_err').text() != ''){
 		$('.inverse_text_red').show();
 	}

	if($('.result_msg', '.add_msg')){
		$('.result_msg').hide();
		$('.add_msg').hide();
	}

    // 저장
    $('#save-btn').click(function(){
    	var company_value    = $.trim($('#company_name').val());
    	var pname_value   = $.trim($('#pname').val());
    	var pw1_value     = $.trim($('#admin_pw1').val());
    	var pw2_value     = $.trim($('#admin_pw2').val());

    	if( (!company_value || company_value == "회사명") || (!pname_value || pname_value == "담당자명") ) {
    		alert('회사명이나 담당자명을 입력해 주세요');
    		return false;
    	}else if(!pw1_value || !pw2_value){
    		alert('비밀번호를 입력해 주세요');
    		return false;
    	}else if(pw1_value != pw2_value){
    		alert('비밀번호가 다릅니다.');
    		return false;
    	}else{

			$.ajax({
				type : "POST",
				url  : "save-setting.php",
				data : {
					company_name   : $('#company_name').val(),
					pname  : $('#pname').val(),
					admin_pw1    : $('#admin_pw1').val(),
					admin_pw2    : $('#admin_pw2').val()
				},
				dataType: "text",
				cache: false,
				success: function(data){
					// console.log(data);
     			$('.result_msg').show();
					$('.result_msg').html(data);
          // $(".result_msg").attr("tabindex", -1).focus();
				}
			});
		}

    });


 	//제품 추가,수정
 	$('#submit-btn').click(function(){
 		// console.log($('#no').val());

		$.ajax({
			type : "POST",
			url  : "modify-product.php",
			data : {
				mode          : $('#mode').val(),
				no            : $('#no').val(),
				serial_prefix : $('#serial-prefix').val(),
		    serial_postfix: $('#serial-postfix').val(),
		    model_no      : $('#model-no').val(),
		    install_date  : $('.wc-input').val(),
		    as_content    : $('#as_content').val(),
		    ref_content   : $('#ref_content').val()
			},
			dataType: "text",
			cache: false,
			success: function(data){
   			$('.result_msg').show();
				$('.result_msg').html(data);
        // $(".result_msg").attr("tabindex", -1).focus();
			}
		});

 	});


 	//제품 삭제
 	$('.del-btn').click(function(){

 		if(confirm('정말 삭제하시겠습니까?')) {
 			var $this = $(this);
 			var str = $this.attr('id');
 			var no = str.split('-');

 			var id = $(this).parent().parent().attr('id'); //id's attribute of tr
 			// var data = 'no=' + id ;
            var parent = $(this).parent().parent();

 			// console.log(no[1]);

			$.ajax({
				type : "POST",
				url  : "del-product.php",
				data : {
					// no   : $('#user_no').text()
					no   : no[1]

				},
				// data: data,
				dataType: "text",
				cache: false,
				success: function(data){
    			$('.result_msg').show();
					$('.result_msg').html(data);
          parent.fadeOut('slow', function() {$(this).remove();});
				}
			});
		}else{
			return false;
		}

 	});

  // 팝업관리
 	$('#save-popup-btn').click(function(){
 		var $this   = $(this);
 		var ed_data = CKEDITOR.instances['contents'].getData();
 		// console.log(ed_data);

    if($('input:checkbox[id="chk"]').is(":checked") == true) {
      var chk = $('#chk').val();
    }


		$.ajax({
			type : "POST",
			url  : "save-popup.php",
			data : {
				chk      : chk,
				contents : ed_data
			},
			// data: data,
			dataType: "text",
			cache: false,
			success: function(data){
        $('.result_msg').show();
        $('.result_msg').html(data);
        // $(".result_msg").attr("tabindex", -1).focus();
			}
		});
 	});

});


    // 비용청구
    $('#billing-btn').click(function(){
    	var company_name    = $.trim($('#company_name').val());
    	var sdate           = $.trim($('#sdate').val());
    	var buyer_name      = $.trim($('#buyer_name').val());
    	var buyer_tel_1     = $.trim($('#buyer_tel_1').val());
    	var buyer_tel_2     = $.trim($('#buyer_tel_2').val());
    	var buyer_tel_3     = $.trim($('#buyer_tel_3').val());
    	var weight          = $.trim($('#weight').val());
    	var amount           = $.trim($('#amount').val());

    	if(!company_name) {
    		alert('기관명을 입력해주세요.');
    		return false;
			}else if(!sdate){
    		alert('파쇄일자를 입력해주세요.');
    		return false;
    	}else if(!buyer_name){
    		alert('담당자명을 입력해주세요.');
    		return false;
    	}else if(!buyer_tel_1 || !buyer_tel_2 || !buyer_tel_3){
    		alert('연락처를 입력해주세요.');
    		return false;
    	}else if(!weight){
    		alert('수거량을 입력해주세요.');
    		return false;
    	}else if(!amount){
    		alert('파쇄비를 입력해주세요.');
    		return false;
    	}else{

			$.ajax({
				type : "POST",
				url  : "save-billing.php",
				data : {
					company_name : $('#company_name').val(),
					sdate        : $('#sdate').val(),
					buyer_name   : $('#buyer_name').val(),
					buyer_tel_1  : $('#buyer_tel_1').val(),
					buyer_tel_2  : $('#buyer_tel_2').val(),
					buyer_tel_3  : $('#buyer_tel_3').val(),
					weight       : $('#weight').val(),
					amount       : $('#amount').val()
				},
				dataType: "text",
				cache: false,
				success: function(data){
					// console.log(data);
     			$('.result_msg').show();
					$('.result_msg').html(data);
          // $(".result_msg").attr("tabindex", -1).focus();
				}
			});
		}

    });

