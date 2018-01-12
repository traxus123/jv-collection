<?php
	require('./model/pdo.php');
	require('./model/console.php');
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
			$return = Console::update($_GET['id'], $_POST['Nom'], $_POST['Model'], $_POST['Constructeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description']);

			/* Mise à jour correctement effectuée, on redirige vers la page de l'article. */
			header('Location: ./list-console.html');
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
		<h1>Modification d'une console</h1>
	</header>

	<?php
		echo '<form action="./modifier-console-' . $_GET['id'] . '.html" method="post">';
		$console = new Console(Console::select($_GET['id']));
	?>
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $_POST['Nom'] . '" />';
							} else {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $console->nom() . '"/>';
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
					<td>Model d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Model" placeholder="Entrez un Model." style="width: 100%;" type="text" value="' . $_POST['Model'] . '" />';
							} else {
								echo '<input name="Model" placeholder="Entrez un Model." style="width: 100%;" type="text" value="' . $console->model() . '" />';
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
					<td>Constructeur d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Constructeur" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" value="' . $_POST['Constructeur'] . '" />';
							} else {
								echo '<input name="Constructeur" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" value="' . $console->constructeur() . '" />';
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
					<td>Année de sortie d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Annee" placeholder="Entrez une Annee." style="width: 100%;" type="text" value="' . $_POST['Annee'] . '" />';
							} else {
								echo '<input name="Annee" placeholder="Entrez une Annee." style="width: 100%;" type="text" value="' . $console->annee() . '" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Annee']) == '')) {
								echo '<span class="error">* La Annee doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Prix d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" value="' . $_POST['Prix'] . '" />';
							} else {
								echo '<input name="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" value="' . $console->prix() . '" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Prix']) == '')) {
								echo '<span class="error">* La Prix doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Description d'une console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Description" placeholder="Entrez une Description." style="width: 100%;" type="text" value="' . $_POST['Description'] . '" />';
							} else {
								echo '<input name="Description" placeholder="Entrez une Description." style="width: 100%;" type="text" value="' . $console->description() . '" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Description']) == '')) {
								echo '<span class="error">* La Description doit être renseigné.</span>';
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
