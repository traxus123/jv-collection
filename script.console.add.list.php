<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Nom</td>
				<td>Model</td>
				<td>Constructeur</td>
				<td>Date de sortie</td>
				<td>Prix</td>
				<td>Description</td>
			</tr>
		</thead>
		<tbody>
<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	foreach (Console::select_filters_orderbyname($_GET['Nom'], $_GET['Model'], $_GET['Constructeur'], $_GET['Annee']) as $index => $row) {
		$console = new Console($row);

		echo '<tr id="click_on_'.$console->id().'" ondblclick="LoadList(event)">';
		echo '<td id="s_nom_'.$console->id().'">' . $console->nom() . '</td>';
		echo '<td id="s_model_'.$console->id().'">' . $console->model() . '</td>';
		echo '<td id="s_constructeur_'.$console->id().'">' . $console->constructeur() . '</td>';
		echo '<td id="s_annee_'.$console->id().'">' . $console->annee() . '</td>';
		echo '<td id="s_prix_'.$console->id().'">' . $console->prix() . '€</td>';
		echo '<td id="s_description_'.$console->id().'">' . $console->description() . '</td>';
		echo '</tr>';
	}
?>

</tbody>
	</table>