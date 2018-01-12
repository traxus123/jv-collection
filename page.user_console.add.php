<?php
	require('./model/pdo.php');
	require('./model/console.php');
	require('./model/user_console.php');
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

			$return = User_Console::insert($user->id, $_POST['Console'], $_POST['Etat']);
			header('Location: ./list-console-utilisateur.html');
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
		<h1>Ajouter une console a ma collection</h1>
	</header>

	<form action="./ajouter-user_console.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Console :</td>
					<td>
						<?php
							$row2 = Console::select_orderbyname ();
							echo '<select name="Console">';
							foreach ($row2 as $key => $value) {	
								echo '<option value="' . $value['id'] . '">' . $value['nom'] . ' ' . $value['model'] . '</option>';
							}
							echo '</select>'
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Nom']) == '')) {
								echo '<span class="error">* la console doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>etat de la console:</td>
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
