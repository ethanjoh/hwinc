<?php

include_once '../main/include/config.php';
include_once '../main/include/functions.php';
include_once 'Classes/PHPExcel.php';

$connection = mysqli_connect($host, $dbid, $dbpass, $dbname);
$sql        = "SELECT * FROM product_list ORDER BY no ASC";
$result     = mysqli_query($connection, $sql);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("(주)기드온소닉")
    ->setLastModifiedBy("(주)기드온소닉")
    ->setTitle("초음파세척기 제품목록")
    ->setSubject("초음파세척기 제품목록")
    ->setDescription("(주)기드온소닉 초음파세척기 제품목록")
    ->setKeywords("제품목록")
    ->setCategory("제품");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A1", "#")
    ->setCellValue("B1", "S/N")
    ->setCellValue("C1", "모델명")
    ->setCellValue("D1", "제조년월일")
    ->setCellValue("E1", "A/S")
    ->setCellValue("F1", "비고");

//  Set width
$objPHPExcel->getActiveSheet()->getColumnDimension('C')
    ->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')
    ->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')
    ->setWidth(70);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')
    ->setWidth(50);

if (mysqli_num_rows($result)) {

    for ($i = 2; $row = mysqli_fetch_array($result); $i++) {
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A" . $i, "$row[no]")
            ->setCellValue("B" . $i, "$row[serial_no]")
            ->setCellValue("C" . $i, "$row[model_no]")
            ->setCellValue("D" . $i, "$row[install_date]")
            ->setCellValue("E" . $i, "$row[after_service]")
            ->setCellValue("F" . $i, "$row[reference]");

        $objPHPExcel->getActiveSheet()->getStyle("E" . $i)
            ->getAlignment()
            ->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle("F" . $i)
            ->getAlignment()
            ->setWrapText(true);
    }

} else {

    $objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
    $objPHPExcel->getActiveSheet()
        ->getCell('A2')
        ->setValue('No data');
    $objPHPExcel->getActiveSheet()
        ->getStyle('A2')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle("초음파세척기 제품목록");

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
$filename = iconv("UTF-8", "EUC-KR", "초음파세척기 제품목록") . "-" . date("Y-m-d");

// Redirect output to a client’s web browser (Excel2007)
// header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
