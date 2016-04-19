<?php

	include("core.php");

	$szerelok = array();

	$query = $MYSQL->prepare("SELECT * FROM `szerelok`");
	$query->execute();
	$rows = $query->fetchAll();
	$query->closeCursor();

	foreach ($rows as $szerelo) {
		array_push($szerelok, new Szerelo($szerelo));
	}


	// Ha van szerelő kiválasztva
	if (isset($_GET['szerelo_id'])){

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
	</head>

	<body>
		
		<form>
			<div class="input-field col s12">
				<select name="szerelo_id">
					<option value="" disabled selected>Válasz szerelőt</option>
					<?php
						foreach ($szerelok as $szerelo) {
							echo '<option value="' . $szerelo->szerelo_id . '">' . $szerelo->nev . '</option>';
						}
					?>
				</select>
				
			</div>
		</form>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="plugins/materialize/js/materialize.min.js"></script>
		
		<script>
			$(document).ready(function() {
				$('select').material_select();
			});
		</script>
		
	</body>
</html>