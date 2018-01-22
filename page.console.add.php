<?php
	require('./model/pdo.php');
	require('./model/console.php');
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

			$return = Console::insert($_POST['Nom'], $_POST['Model'], $_POST['Constructeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], ' ');
			header('Location: ./list-console.html');
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
		<h1>Ajouter une console</h1>
	</header>

	<form action="./ajouter-console.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $_POST['Nom'] . '" />';
							} else {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Nom']) == '')) {
								echo '<span class="error">* Le Nom doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Model de la console:</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Model" placeholder="Entrez un Model." style="width: 100%;" type="text" value="' . $_POST['Model'] . '" />';
							} else {
								echo '<input name="Model" placeholder="Entrez un Model." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Model']) == '')) {
								echo '<span class="error">* Le Model doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Constructeur de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Constructeur" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" value="' . $_POST['Constructeur'] . '" />';
							} else {
								echo '<input name="Constructeur" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Constructeur']) == '')) {
								echo '<span class="error">* Le Constructeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Annee de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Annee" placeholder="Entrez un Annee." style="width: 100%;" type="text" value="' . $_POST['Annee'] . '" />';
							} else {
								echo '<input name="Annee" placeholder="Entrez un Annee." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Annee']) == '')) {
								echo '<span class="error">* L\'annee doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Prix de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" value="' . $_POST['Prix'] . '" />';
							} else {
								echo '<input name="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Prix']) == '')) {
								echo '<span class="error">* Le Prix doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Description de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Description" placeholder="Entrez un Description." style="width: 100%;" type="text" value="' . $_POST['Description'] . '" />';
							} else {
								echo '<input name="Description" placeholder="Entrez un Description." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Description']) == '')) {
								echo '<span class="error">* Le Description doit être renseigné.</span>';
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
