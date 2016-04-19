<?php

	include("core.php");

	$javitasok = array();

	$query = $MYSQL->prepare("CALL javitasok();");

	$query->execute();
	$rows = $query->fetchAll();
	$query->closeCursor();


	// Javítások tömbe mentése
	$i = 1;
	foreach ($rows as $javitas) {
		array_push($javitasok, new Javitas($i, $javitas));
		$i++;
	}

	//echo var_dump($rows);
	$page = 1;
	if (isset($_GET['page'])){
		if ($_GET['page'] < 1){
			$page = 1;
		} else if ($_GET['page'] > count($javitasok)) {
			$page = count($javitasok);
		} else {
			$page = $_GET['page'];
		}
	}

	$javitas = $javitasok[$page - 1];

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set properties
	$objPHPExcel->getProperties()->setCreator("Czibula Peter");
	$objPHPExcel->getProperties()->setLastModifiedBy("Czibula Peter");
	$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setDescription("Javitas informaciok");

	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Autós név');
	$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Rendszám');
	$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Tipúsnév');
	$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Telefon');
	$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Szerelő név');
	$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kezdés dátuma');
	$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Befejezés dátuma');
	$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Irányár');

	$objPHPExcel->getActiveSheet()->SetCellValue('A2', $javitas->autos_nev);
	$objPHPExcel->getActiveSheet()->SetCellValue('B2', $javitas->rendszam);
	$objPHPExcel->getActiveSheet()->SetCellValue('C2', $javitas->tipusnev);
	$objPHPExcel->getActiveSheet()->SetCellValue('D2', $javitas->telefon);
	$objPHPExcel->getActiveSheet()->SetCellValue('E2', $javitas->szerelo_nev);
	$objPHPExcel->getActiveSheet()->SetCellValue('F2', $javitas->kezdo_datum);
	$objPHPExcel->getActiveSheet()->SetCellValue('G2', $javitas->vegzo_datum);
	$objPHPExcel->getActiveSheet()->SetCellValue('H2', $javitas->iranyar);


	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle("Javitás");

	// Header
	$ido = date("Y-m-d_H-i-s"); 
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;filename='javitasok_".$ido."_".$page.".xls'");
	header("Cache-Control: max-age=0");

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

?>