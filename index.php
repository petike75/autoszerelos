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

?>

<!DOCTYPE html>
<html>

	<head>
	
		<title></title>
		<meta charset="utf8" />
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="plugins/materialize/css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="style.css"  media="screen,projection"/>
		
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="plugins/materialize/js/materialize.min.js"></script>
		
	</head>

	<body>
		<?php include("navbar.php"); ?>
		<div class="container">
			<!-- <a href="keres.php">Keresés</a> -->
			<?php //echo var_dump($javitasok[($page - 1)]); ?>
			
			 <table>
				<thead><tr>
					<th data-field="id">#</th>
					<th data-field="name">Autós név</th>
					<th data-field="price">Rendszám</th>
					<th data-field="price">Tipusnév</th>
					<th data-field="price">Telefon</th>
					<th data-field="price">Szerelő név</th>
					<th data-field="price">Kezdés dátuma</th>
					<th data-field="price">Befejezés dátuma</th>
					<th data-field="price">Irányár</th>
				</tr></thead>

				<tbody><tr>
				<?php
					foreach($javitasok[($page - 1)] as $key => $value){
						echo "<td>$value</td>";
					}
				?>
				</tr></tbody>
				
			</table>
			
			<?php 
				/*
				if ($page > 1){
					echo '<a href="?page=' . ($page - 1) . '">Vissza</a>';
				}
				echo ' ';
				if ($page < count($javitasok)){
					echo '<a href="?page=' . ($page + 1) . '">Előre</a>';
				}
				*/
				echo ' ';
				echo '<a class="waves-effect waves-light btn blue lighten-1" href="mentes.php?page=' . ($page + 1) . '"><i class="material-icons left">save</i>Mentés</a>';
				//echo '<a href="mentes.php?page=' . ($page + 1) . '">Mentés</a>';
				echo ' ';
				//echo '<a class="waves-effect waves-light btn blue lighten-1" href="downloadall.php"><i class="material-icons left">save</i>Mind letöltése</a>';
				//echo '<a href="downloadall.php">Mind letöltése</a>';
			?>
			
			<ul class="pagination">
			<?php
				echo '<li class="'. (($page <= 1) ? 'disabled' : 'waves-effect') . '"><a href="?page=1"><i class="material-icons">chevron_left</i></a></li>';
				for($i=1; $i <= count($javitasok); $i++){
					echo '<li class="'.(($i == $page) ? 'active blue lighten-1' : 'waves-effect').'"><a href="?page='.$i.'">'.$i.'</a></li>';
				}
				echo '<li class="'. (($page >= count($javitasok)) ? 'disabled' : 'waves-effect') . '"><a href="?page='.count($javitasok).'"><i class="material-icons">chevron_right</i></a></li>';
			?>
			</ul>
		</div>
		
	</body>

</html>