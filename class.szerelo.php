<?php

	class Szerelo {

		public $szerelo_id;
		public $nev;
		public $cim;
		public $telefon;

		public function __construct($row){
			$this->szerelo_id = $row['szerelo_id'];
			$this->nev = $row['nev'];
			$this->cim = $row['cim'];
			$this->telefon = $row['telefon'];
		}

	}

?>