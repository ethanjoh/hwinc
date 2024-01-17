<?php

include_once '../main/include/config.php';
include_once '../main/include/functions.php';
include_once 'Classes/PHPExcel.php';

$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);
$sql = "SELECT * FROM test_apply ORDER BY main_no ASC";
$result = mysqli_query($connection, $sql);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("(주)기드온소닉")
	->setLastModifiedBy("(주)기드온소닉")
	->setTitle("무료체험 신청자 목록")
	->setSubject("무료체험 신청자 목록")
	->setDescription("(주)기드온소닉 무료체험 신청자 목록")
	->setKeywords("무료체험")
	->setCategory("제품");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue("A1", "#")
	->setCellValue("B1", "고객명")
	->setCellValue("C1", "연락처")
	->setCellValue("D1", "시/도")
	->setCellValue("E1", "구/군")
	->setCellValue("F1", "요청사항")
	->setCellValue("G1", "신청일");

//  Set width
$objPHPExcel->getActiveSheet()->getColumnDimension('B')
	->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')
	->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')
	->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')
	->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')
	->setWidth(100);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')
	->setWidth(30);

if (mysqli_num_rows($result)) {

	for ($i = 2; $row = mysqli_fetch_array($result); $i++) {
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A" . $i, "$row[main_no]")
			->setCellValue("B" . $i, "$row[name]")
			->setCellValue("C" . $i, "$row[phone]")
			->setCellValue("D" . $i, "$row[city]")
			->setCellValue("E" . $i, "$row[district]")
			->setCellValue("F" . $i, "$row[message]")
			->setCellValue("G" . $i, "$row[apply_date]");

		$objPHPExcel->getActiveSheet()->getStyle("F" . $i)
			->getAlignment()
			->setWrapText(true);
	}

} else {

	$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
	$objPHPExcel->getActiveSheet()
		->getCell('A2')
		->setValue('No data');
	$objPHPExcel->getActiveSheet()
		->getStyle('A2')
		->getAlignment()
		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle("무료체험 신청자 목록");

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "무료체험 신청자 목록") . "-" . date("Y-m-d");

// Redirect output to a client’s web browser (Excel2007)
// header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
