<?php
	require('./model/pdo.php');
	require('./model/user.php');
?>
	<table class="listing column-1-center column-2-center column-4-center">
		<thead>
			<tr>
				<td>Pseudo</td>
				<td>Collection de jeux</td>
				<td>Collection de consoles</td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach (JVUser::select_contains_orderbyname($_GET['filtre']) as $index => $row) {
					if($row['private'] == 1){
						echo '<tr>';
						echo '<td>' . $row['pseudo'] . '</td>';
						echo '<td><a href="list-jeu-utilisateur-'.$row['id'].'.html">Collection de jeux</a></td>';
						echo '<td><a href="list-console-utilisateur-'.$row['id'].'.html">Collection de consoles</a></td>';
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>