<?php
	require('./model/pdo.php');
	require('./model/user.php');
	include('./model/jeu.php');
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

			$xml = simplexml_load_string(file_get_contents("http://thegamesdb.net/api/GetGame.php?name=".$_POST['Nom']), "SimpleXMLElement", LIBXML_NOCDATA);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			print_r($array['Game'][0]['Images']['boxart'][1]);
			$return = Jeu::insert($_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], 'http://thegamesdb.net/banners/'.$array['Game'][0]['Images']['boxart'][1]);

			header('Location: ./list-jeu.html');
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
		<h1>Ajouter un jeu</h1>
	</header>

	<form action="./ajouter-jeu.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom du jeu :</td>
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
					<td>Console du jeu:</td>
					<td>
						<?php
							include('./model/console.php');
							$row2 = Console::select_d_orderbyname ();
							echo '<select name="Console">';
							foreach ($row2 as $key => $value) {	
								echo '<option value="' . $value['id'] . '">' . $value['nom'] . '</option>';
							}
							echo '</select>'
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
					<td>Genre du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Genre" placeholder="Entrez un Genre." style="width: 100%;" type="text" value="' . $_POST['Genre'] . '" />';
							} else {
								echo '<input name="Genre" placeholder="Entrez un Genre." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Genre']) == '')) {
								echo '<span class="error">* Le Genre doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Developpeur du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Developpeur" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" value="' . $_POST['Developpeur'] . '" />';
							} else {
								echo '<input name="Developpeur" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Developpeur']) == '')) {
								echo '<span class="error">* Le Developpeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Editeur du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Editeur" placeholder="Entrez un Editeur." style="width: 100%;" type="text" value="' . $_POST['Editeur'] . '" />';
							} else {
								echo '<input name="Editeur" placeholder="Entrez un Editeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Editeur']) == '')) {
								echo '<span class="error">* Le Editeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Annee du jeu :</td>
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
					<td>Prix du jeu :</td>
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
					<td>Description du jeu :</td>
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
