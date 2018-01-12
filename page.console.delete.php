<?php
	require('./model/pdo.php');
	require('./model/console.php');
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
			$return = Console::delete($id);
		}
		else {
			//$error = new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de la suppression du jeu', '<p>Argument ID non numérique.</p>');
			//$error->redirect();

			exit();
		}

		header('Location: ./list-console.html');
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
		$row = Console::select($id);

		echo '<form action="./supprimer-console-' . $id . '.html" method="post">';
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
