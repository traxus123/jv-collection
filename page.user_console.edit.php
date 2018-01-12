<?php
	require('./model/pdo.php');
	require('./model/console.php');
	require('./model/user_console.php');
	require('./model/user.php');

	$post_check = true;
	if (count($_POST) > 0) {
		/*
		if ((!isset($_POST['NumBadge'])) || ($_POST['NumBadge'] == '')) {
			//	S'il manque le titre on n'insère pas.
			$post_check = false;
		}
		*/
		if ($post_check) {
			$return = User_Console::update($_GET['id'], $user->id, $_POST['Etat']);

			/* Mise à jour correctement effectuée, on redirige vers la page de l'article. */
			header('Location: ./list-console-utilisateur.html');
			exit();
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
		<h1>Modification d'une console de ma collection</h1>
	</header>

	<?php
		echo '<form action="./modifier-user_console-' . $_GET['id'] . '.html" method="post">';
		$console = new User_Console(User_Console::select($_GET['id']));
	?>
		<table class="table-form">
			<tbody>
				<tr>
					<td>Etat :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Etat" placeholder="Entrez un Etat." style="width: 100%;" type="text" value="' . $_POST['Etat'] . '" />';
							} else {
								echo '<input name="Etat" placeholder="Entrez un Etat." style="width: 100%;" type="text" value="' . $console->etat() . '" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Etat']) == '')) {
								echo '<span class="error">* L\'Etat doit être renseigné.</span>';
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
