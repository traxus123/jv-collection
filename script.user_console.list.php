<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
?>
	<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Nom</td>
				<td>Model</td>
				<td>Constructeur</td>
				<td>Date de sortie</td>
				<td>Prix</td>
				<td>Description</td>
				<td>etat</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (Console::u_select_contains_orderbyname($user->id, $_GET['filtre']) as $index => $row) {
					echo '<tr>';
					echo '<td>' . $row['nom'] . '</td>';
					echo '<td>' . $row['model'] . '</td>';
					echo '<td>' . $row['constructeur'] . '</td>';
					echo '<td>' . $row['annee'] . '</td>';
					echo '<td>' . $row['prix'] . '€</td>';
					echo '<td>' . $row['description'] . '</td>';
					echo '<td>' . $row['etat'] . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-user_console-' . $row['uid'] . '.html" title="Modifier la console."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-user_console-' . $row['uid'] . '.html" title="Supprimer la console."></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>