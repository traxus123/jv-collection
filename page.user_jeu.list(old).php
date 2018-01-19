<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	require('./model/jeu.php');
?>
<html>
	<?php
		include('./inc.head.php');
	?>
	<body>

	<header>
		<?php
			include('./inc.nav.php');
		?>
	</header>

	<section>
		<header>
			<h1>Mes Jeux</h1>
		</header>
		<article>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-user_jeu.html" title="Ajouter un nouveau jeu."></a>';
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
				<td>Prix</td>
				<td>Description</td>
				<td>etat</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (Jeu::u_select_orderbyname($user->id) as $index => $row) {
					echo '<tr>';
					echo '<td>' . $row['nom'] . '</td>';
					echo '<td>' . Console::select($row['id_console'])['nom'] . '</td>';
					echo '<td>' . $row['genre'] . '</td>';
					echo '<td>' . $row['developpeur'] . '</td>';
					echo '<td>' . $row['editeur'] . '</td>';
					echo '<td>' . $row['prix'] . '</td>';
					echo '<td>' . $row['description'] . '</td>';
					echo '<td>' . $row['etat'] . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-user_jeu-' . $row['uid'] . '.html" title="Modifier le jeu."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-user_jeu-' . $row['uid'] . '.html" title="Supprimer le jeu."></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
		</article>
	</section>
	</body>
</html>
