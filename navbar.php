 <div class="navbar-fixed">
	 <nav class="blue lighten-1">
		<div class="nav-wrapper container">
			<a href="#" data-activates="mobile-demo" class="button-collapse">
				<i class="material-icons">menu</i>
			</a>
			<!-- Sima -->
			<ul class="left hide-on-med-and-down">
				<li><a href="index.php"><i class="material-icons">&#xE88A;</i></a></li>
				<li><a href="index.php">Egyesével</a></li>
				<li><a href="keres.php">Keresés</a></li>
				<li><a href="downloadall.php">Mind letöltése</a></li>
			</ul>
			<!-- Mobilos -->
			<ul class="side-nav" id="mobile-demo">
				<li><a href="index.php">Egyesével</a></li>
				<li><a href="keres.php">Keresés</a></li>
				<li><a href="downloadall.php">Mind letöltése</a></li>
			</ul>
		</div>
	</nav>
</div>
<script>
	$(document).ready(function() {
		$(".button-collapse").sideNav();
	});
</script>