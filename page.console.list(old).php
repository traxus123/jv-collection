<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
?>

<html>

<?php
	include('./inc.head.php');
?>

<body>

<header>
	<?php
		include('./inc.banner.php');
		include('./inc.nav.php');
	?>
</header>

<section>
	<header>
		<h1>
			Liste des consoles
		</h1>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-console.html" title="Ajouter une nouvelle console."></a>';
		?>
		<div class="float-right">
			Filtre :
			<input type="text" id="txt-filter" />
		</div>
	</header>

	<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Nom</td>
				<td>Model</td>
				<td>Constructeur</td>
				<td>Date de sortie</td>
				<td>Prix</td>
				<td>Description</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (Console::select_orderbyname() as $index => $row) {
					$console = new Console($row);

					echo '<tr>';
					echo '<td>' . $console->nom() . '</td>';
					echo '<td>' . $console->model() . '</td>';
					echo '<td>' . $console->constructeur() . '</td>';
					echo '<td>' . $console->annee() . '</td>';
					echo '<td>' . $console->prix() . '</td>';
					echo '<td>' . $console->description() . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-console-' . $console->id() . '.html" title="Modifier la console."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-console-' . $console->id() . '.html" title="Supprimer la console."></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
