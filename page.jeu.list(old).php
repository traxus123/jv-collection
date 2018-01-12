<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/jeu.php');
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
			Liste des jeux
		</h1>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-jeu.html" title="Ajouter une nouveau jeu."></a>';
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
				<td>Console</td>
				<td>Genre</td>
				<td>Developpeur</td>
				<td>Editeur</td>
				<td>Annee</td>
				<td>Prix</td>
				<td>Description</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php

				foreach (Jeu::select_orderbyname() as $index => $row) {
					$jeu = new Jeu($row);
					$console = Console::select($jeu->id_console());

					echo '<tr>';
					echo '<td>' . $jeu->nom() . '</td>';
					echo '<td>' . $console['nom'] . '</td>';
					echo '<td>' . $jeu->genre() . '</td>';
					echo '<td>' . $jeu->developpeur() . '</td>';
					echo '<td>' . $jeu->editeur() . '</td>';
					echo '<td>' . $jeu->annee() . '</td>';
					echo '<td>' . $jeu->prix() . '</td>';
					echo '<td>' . $jeu->description() . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-jeu-' . $jeu->id() . '.html" title="Modifier la console."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-jeu-' . $jeu->id() . '.html" title="Supprimer la console."></a></td>';
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
