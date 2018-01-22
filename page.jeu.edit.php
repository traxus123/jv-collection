<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/jeu.php');
	require('./model/console.php');

	$post_check = true;
	if (count($_POST) > 0) {
		/*
		if ((!isset($_POST['NumBadge'])) || ($_POST['NumBadge'] == '')) {
			//	S'il manque le titre on n'insère pas.
			$post_check = false;
		}
		*/
		if ($post_check) {
			$return = Jeu::update($_GET['id'], $_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], $_POST['Image']);

			/* Mise à jour correctement effectuée, on redirige vers la page de l'article. */
			header('Location: ./list-jeu.html');
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
		<h1>Modification d'un jeu'</h1>
	</header>

	<?php
		echo '<form action="./modifier-jeu-' . $_GET['id'] . '.html" method="post">';
		$jeu = new Jeu(Jeu::select($_GET['id']));
	?>
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $_POST['Nom'] . '" />';
							} else {
								echo '<input name="Nom" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $jeu->nom() . '"/>';
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
					<td>Console d'un jeu :</td>
					<td>
						<?php
							$row2 = Console::select_orderbyname ();
							echo '<select name="Console">';
							foreach ($row2 as $key => $value) {	
								if($value['id'] == $jeu->id_console()){
									echo '<option value="' . $value['id'] . '" selected="selected">' . $value['Nom'] . '</option>';
								}
								else{
									echo '<option value="' . $value['id'] . '">' . $value['Nom'] . '</option>';
								}
							}
							echo '</select>'
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Console']) == '')) {
								echo '<span class="error">* La Console doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Genre d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Genre" placeholder="Entrez un Genre." style="width: 100%;" type="text" value="' . $_POST['Genre'] . '" />';
							} else {
								echo '<input name="Genre" placeholder="Entrez un Genre." style="width: 100%;" type="text" value="' . $jeu->genre() . '" />';
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
					<td>Developpeur d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Developpeur" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" value="' . $_POST['Developpeur'] . '" />';
							} else {
								echo '<input name="Developpeur" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" value="' . $jeu->developpeur() . '"/>';
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
					<td>Editeur d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Editeur" placeholder="Entrez un Editeur." style="width: 100%;" type="text" value="' . $_POST['Editeur'] . '" />';
							} else {
								echo '<input name="Editeur" placeholder="Entrez un Editeur." style="width: 100%;" type="text" value="' . $jeu->editeur() . '"/>';
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
					<td>Année de sortie d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Annee" placeholder="Entrez une Annee." style="width: 100%;" type="text" value="' . $_POST['Annee'] . '" />';
							} else {
								echo '<input name="Annee" placeholder="Entrez une Annee." style="width: 100%;" type="text" value="' . $jeu->annee() . '" />';
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
					<td>Prix d'un jeu :</td>
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
					<td>Description d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Description" placeholder="Entrez une Description." style="width: 100%;" type="text" value="' . $_POST['Description'] . '" />';
							} else {
								echo '<input name="Description" placeholder="Entrez une Description." style="width: 100%;" type="text" value="' . $jeu->description() . '" />';
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
				<tr>
					<td>Image d'un jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Image" placeholder="Entrez une Image." style="width: 100%;" type="text" value="' . $_POST['Image'] . '" />';
							} else {
								echo '<input name="Image" placeholder="Entrez une Image." style="width: 100%;" type="text" value="' . $jeu->image() . '" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Image']) == '')) {
								echo '<span class="error">* L\'Image doit être renseigné.</span>';
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
