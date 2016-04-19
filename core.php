<?php
	

	include("class.szerelo.php");
	include("class.javitas.php");

	/* PHP EXCEL */
	include("plugins/PHPExcel.php");
	include("plugins/PHPExcel/Writer/Excel2007.php");

	$MYSQL = new PDO('mysql:host=localhost;dbname=autojavitas;port=3307', 'root', '');
	$MYSQL->exec("SET names utf8");


?>