<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/jeu.php');
	require('./model/console.php');
?>
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
			</tr>
		</thead>
		<tbody>
			<?php

				foreach (Jeu::select_filters_orderbyname($_GET['Nom'],  $_GET['Console'], $_GET['Genre'], $_GET['Developpeur'], $_GET['Editeur'], $_GET['Annee']) as $index => $row) {
					$jeu = new Jeu($row);
					$console = Console::select($jeu->id_console());

					echo '<tr id="click_on_'.$jeu->id().'" ondblclick="LoadList(event)">';
					echo '<td id="s_nom_'.$jeu->id().'">' . $jeu->nom() . '</td>';
					echo '<td id="s_console_'.$jeu->id().'" class="'.$jeu->id_console().'">' . $console['nom'] . '</td>';
					echo '<td id="s_genre_'.$jeu->id().'">' . $jeu->genre() . '</td>';
					echo '<td id="s_developpeur_'.$jeu->id().'">' . $jeu->developpeur() . '</td>';
					echo '<td id="s_editeur_'.$jeu->id().'">' . $jeu->editeur() . '</td>';
					echo '<td id="s_annee_'.$jeu->id().'">' . $jeu->annee() . '</td>';
					echo '<td id="s_prix_'.$jeu->id().'">' . $jeu->prix() . '€</td>';
					echo '<td id="s_description_'.$jeu->id().'">' . $jeu->description() . '</td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>