<?php
	require('./model/pdo.php');

	$check_input = true;
	$is_post = false;

	if (count($_POST) > 0) {
		$is_post = true;

		if (($check_input) && ((!isset($_POST['email'])) || ($_POST['email'] == ''))) {
			/* S'il manque l'email on n'insère pas. */
			$check_input = false;
		}

		if (($check_input) && ((!isset($_POST['pseudo'])) || ($_POST['pseudo'] == ''))) {
			$check_input = false;
		}

		if (($check_input) && (($_POST['mypwd1'] == '') || ($_POST['mypwd2'] == ''))) {
			/* Un mot de passe est vide, on n'insère pas. */
			$check_input = false;
		}

		if (($check_input) && ($_POST['mypwd1'] != $_POST['mypwd2'])) {
			/* Les deux mots de passe ne sont pas identiques, on n'insère pas. */
			$check_input = false;
		}

		if ($check_input) {
			$redirect = false; // Pour ne rediriger que si on a réussi l'opération.

			$stmt = $pdo->prepare('insert into utilisateur (pseudo, mdp, email, droit, description) values (?, ?, ?, ?, ?);');

			$stmt->bindValue(1, $_POST['pseudo'], PDO::PARAM_STR);
			$stmt->bindValue(2, strtolower(hash('sha256', $_POST['mypwd1'])), PDO::PARAM_STR);
			$stmt->bindValue(3, $_POST['email'], PDO::PARAM_STR);
			$stmt->bindValue(4, 1, PDO::PARAM_STR);
			$stmt->bindValue(5, ' ', PDO::PARAM_STR);


			try {
				$stmt->execute();
				$stmt->closeCursor();
				$redirect = true;
			} catch (PDOException $exception) {
				echo "<!-- Erreur lors de l\'insertion.\n" . $exception->getMessage() . "\n -->";
			}

			$stmt = null;

			if ($redirect) {
				/* Insertion correctement effectuée, on redirige vers la page du nouvel utilisateur. */
				header('Location: ./accueil.html');
				exit();
			}
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
		<h1>Création d'un nouvel utilisateur</h1>
	</header>

	<form action="./ajouter-utilisateur.html" method="post">
		<table style="width:100%;">
			<tbody>
				<?php
					function input_text ($key, $label, $empty_message, $type = 'text') {
						global $check_input, $is_post, $_POST;
						echo '<tr><td style="width:300px;">' . $label . ' : </td>';
						if ($is_post) {
							echo '<td><input name="' . $key . '" type="' . $type . '" style="width:300px;" value="' . $_POST[$key] . '" /></td>';
							if ((!$check_input) && ($_POST[$key] == '')) {
								echo '<td><span class="error">* ' . $empty_message . '</span></td>';
							}
						} else {
							echo '<td><input name="' . $key . '" style="width:300px;" type="' . $type . '" /></td><td></td>';
						}
						echo '</tr>';
					}
					/*
					input_text('email', 'Email', 'L\'email doit être renseigné.');
					input_text('lastname', 'Nom de famille', 'Le nom de famille doit être renseigné.');
					input_text('firstname', 'Prénom', 'Le prénom doit être renseigné.');
					input_text('mypwd1', 'Mot de passe', 'Le mot de passe doit être renseigné.', 'password');
					input_text('mypwd2', 'Retappez le mot de passe', 'Le mot de passe doit être renseigné.', 'password');
					*/
				?>
			</tbody>
		</table>

		<?php
			if (($is_post) && ($_POST['mypwd1'] != $_POST['mypwd2'])) {
				echo '<p class="error">* Les mots de passe doivent être identiques.</p>';
			}
		?>

		<center>
			<input type="submit" value="Envoyer" />
		</center>
	</form>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
