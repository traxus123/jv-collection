<?php
	require('./model/pdo.php');
	require('./model/user_console.php');
	require('./model/user.php');

	if (!isset($_GET['id'])) {
		//$error = new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de la suppression du jeu', '<p>Identifiant du jeu absent.</p>');
		//$error->redirect();
		echo "<p>error 1<p>";
		exit();
	}

	$id = $_GET['id'];

	if (isset($_POST['delete'])) {
		if (is_numeric($id)) {
			$return = User_Console::delete($id);
		}
		else {
			//$error = new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de la suppression du jeu', '<p>Argument ID non numérique.</p>');
			//$error->redirect();

			exit();
		}

		header('Location: ./list-console-utilisateur.html');
		exit();
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
		<h1>Suppression d'une console</h1>
	</header>

	<?php
		$row = User_Console::select_c($id);

		echo '<form action="./supprimer-user_console-' . $id . '.html" method="post">';
		echo '<input name="delete" type="hidden" value="true" />';
		echo '<p>Vous allez supprimer la console "' . $row['nom'] . '". Êtes vous sur ?</p>';
		echo '<center><input title="Supprimer cet console." type="submit" value="Supprimer" /></center>';
		echo '</form>';
	?>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
