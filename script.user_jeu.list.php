<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	require('./model/jeu.php');
?>
	<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Image</td>
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
				foreach (Jeu::u_select_contains_orderbyname($user->id, $_GET['filtre']) as $index => $row) {
					echo '<tr>';
					echo '<td><img height="50px" src="' . $row['image'] . '"></td>';
					echo '<td>' . $row['nom'] . '</td>';
					echo '<td>' . Console::select($row['id_console'])['nom'] . '</td>';
					echo '<td>' . $row['genre'] . '</td>';
					echo '<td>' . $row['developpeur'] . '</td>';
					echo '<td>' . $row['editeur'] . '</td>';
					echo '<td>' . $row['prix'] . '€</td>';
					echo '<td>' . $row['description'] . '</td>';
					echo '<td>' . $row['etat'] . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-user_jeu-' . $row['uid'] . '.html" title="Modifier le jeu."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-user_jeu-' . $row['uid'] . '.html" title="Supprimer le jeu."></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>