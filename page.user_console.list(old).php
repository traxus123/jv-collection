<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/user_Console.php');
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
			<h1>Mes Consoles</h1>
		</header>
		<article>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-user_console.html" title="Ajouter une nouvelle console."></a>';
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
				<td>etat</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (Console::u_select_orderbyname($user->id) as $index => $row) {
					echo '<tr>';
					echo '<td>' . $row['nom'] . '</td>';
					echo '<td>' . $row['model'] . '</td>';
					echo '<td>' . $row['constructeur'] . '</td>';
					echo '<td>' . $row['annee'] . '</td>';
					echo '<td>' . $row['prix'] . '</td>';
					echo '<td>' . $row['description'] . '</td>';
					echo '<td>' . $row['etat'] . '</td>';
					echo '<td><a class="icon icon-edit" href="./modifier-user_console-' . $row['uid'] . '.html" title="Modifier la console."></a></td>';
					echo '<td><a class="icon icon-delete" href="./supprimer-user_console-' . $row['uid'] . '.html" title="Supprimer la console."></a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
		</article>
	</section>
	</body>
</html>
