<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Image</td>
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
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	foreach (Console::select_contains_orderbyname($_GET['filtre']) as $index => $row) {
		$console = new Console($row);

		echo '<tr>';
		if($console->image() != ''){
			echo '<td><img height="50px" src="' . $console->image() . '"></td>';
		}
		else {
			echo '<td></td>';
		}
		echo '<td>' . $console->nom() . '</td>';
		echo '<td>' . $console->model() . '</td>';
		echo '<td>' . $console->constructeur() . '</td>';
		echo '<td>' . $console->annee() . '</td>';
		echo '<td>' . $console->prix() . '€</td>';
		echo '<td>' . $console->description() . '</td>';
		echo '<td><a class="icon icon-edit" href="./modifier-console-' . $console->id() . '.html" title="Modifier la console."></a></td>';
		echo '<td><a class="icon icon-delete" href="./supprimer-console-' . $console->id() . '.html" title="Supprimer la console."></a></td>';
		echo '</tr>';
	}
?>

</tbody>
	</table>