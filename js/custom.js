function Checkform() {
  if( frm.buyer_name.value == "" ) {
    frm.buyer_name.focus();
    alert("성함을 입력하세요.");
    return false;
  }

  if( frm.buyer_tel_1.value == "" ) {
    frm.buyer_tel_1.focus();
    alert("전화번호를 입력하세요.");
    return false;
  }

  if( frm.buyer_tel_2.value == "" ) {
    frm.buyer_tel_2.focus();
    alert("전화번호를 입력하세요.");
    return false;
  }

  if( frm.buyer_tel_3.value == "" ) {
    frm.buyer_tel_3.focus();
    alert("전화번호를 입력하세요.");
    return false;
  }
}


