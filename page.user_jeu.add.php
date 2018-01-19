<?php
	require('./model/pdo.php');
	require('./model/console.php');
	require('./model/jeu.php');
	require('./model/user.php');
	if (count($_POST) > 0) {
		/* Vérification des données saisies. */
		$post_check = true;
		/*
		if (trim($_POST['Nom']) == '') {
			$post_check = false;
		}
		*/
		if ($post_check) {
			/* Insertion du jeu. */

			$return = Jeu::u_insert($user->id, $_POST['Jeu'], $_POST['Etat']);
			header('Location: ./list-jeu-utilisateur.html');
		}
	}
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
		<h1>Ajouter un jeu a ma collection</h1>
	</header>

	<form action="./ajouter-user_jeu.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Jeu :</td>
					<td>
						<?php
							$row2 = jeu::select_orderbyname ();
							echo '<select name="Jeu">';
							foreach ($row2 as $key => $value) {	
								echo '<option value="' . $value['id'] . '">' . $value['nom'] . ' ' . Console::select($row['id_console'])['nom'] . '</option>';
							}
							echo '</select>'
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Nom']) == '')) {
								echo '<span class="error">* le jeu doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>etat du jeu:</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Etat" placeholder="Entrez un Etat. (/10)" style="width: 100%;" type="text" value="' . $_POST['Etat'] . '" />';
							} else {
								echo '<input name="Etat" placeholder="Entrez un Etat. (/10)" style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Etat']) == '')) {
								echo '<span class="error">* Le Etat doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<center><input type="submit" value="Envoyer" /></center>
	</form>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
