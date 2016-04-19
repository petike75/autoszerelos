<?php

	class Javitas {

		public $id;
		public $autos_nev;
		public $rendszam;
		public $tipusnev;
		public $telefon;
		public $szerelo_nev;
		public $kezdo_datum;
		public $vegzo_datum;
		public $iranyar;

		public function __construct($id, $row){

			$this->id = $id;
			$this->autos_nev = $row['autos_nev'];
			$this->rendszam = $row['rendszam'];
			$this->tipusnev = $row['tipusnev'];
			$this->telefon = $row['telefon'];
			$this->szerelo_nev = $row['szerelo_nev'];
			$this->kezdo_datum = $row['kezdo_datum'];
			$this->vegzo_datum = $row['vegzo_datum'];
			$this->iranyar = number_format($row['iranyar'], 0, '.', ',');;

		}

	}

?>