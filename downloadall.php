<?php

	// Header
	$ido = date("Y-m-d_H-i-s"); 
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;filename='javitasok_$ido.xls'");
	header("Cache-Control: max-age=0");

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

	$i=2;
	foreach ($javitasok as $javitas) {
		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $i, $javitas->autos_nev);
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $i, $javitas->rendszam);
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $i, $javitas->tipusnev);
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $i, $javitas->telefon);
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $i, $javitas->szerelo_nev);
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $i, $javitas->kezdo_datum);
		$objPHPExcel->getActiveSheet()->SetCellValue('G' . $i, $javitas->vegzo_datum);
		$objPHPExcel->getActiveSheet()->SetCellValue('H' . $i, $javitas->iranyar);
		$i++;
	}

	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle("Javitás");

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

?>