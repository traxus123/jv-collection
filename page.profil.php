<?php

require('./model/user.php');

if (isset($_GET['operation'])) {
	switch ($_GET['operation']) {
		case 'updatepassword' :
			if ($_POST['newpassword1'] != $_POST['newpassword2']) {
				break;
			}

			$pwhash = JVUser::select_hash($user->id);

			if (strtolower($pwhash) != strtolower(hash('sha256', $_POST['oldpassword']))) {
				break;
			}

			$return = JVUser::update_hash($id, strtolower(hash('sha256', $_POST['newpassword1'])));
			break;

		case 'updateprofile' :
			if (!JVUser::check_email($user->id, $_POST['email'])) {
				break;
			}

			$return = JVUser::update_profil($user->id, $_POST['email'], $_POST['pseudo'], $_POST['description'], $_POST['private']);

			break;
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
<!-- miss one ? find her a <name>.html
______________________________________________▐█▄▄
__________________________________▄____________█▓▓█▄
________________________________▄█_____________█▓▓▓▓█▄
______________________________▄▓▓█_____________█▓▓▓▓▓▓█▄
____________________________█▓▓▓▓█____________█▓▓▓▓▓▓▓▓█▄
__________________________▄█▓▓▓▓▓█▄_________▄█▓▓▓▓▓▓▓▓▓▓█▄
________________________▄█▓▓▓▓▓▓▓▓██▄▄▄▄██▓▓▓▓▓▓▓▓▓▓▓▓▓█
______________________▄█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓░░░░░░░░░▓▓▓▓▓▓▓█
_____________________█▓▓▓▓▓▓▓▓▓▓▓▓░░░░______________░░░░▓▓█
___________________▄█▓▓▓▓▓▓▓▓▓▓░░__________________________░█
__________________█▓▓▓▓▓▓▓▓▓▓░░_____░░░░░░░░_______________░░░
_______________▄█▓▓▓▓▓▓▓▓▓▓░░░░░░_____________░░░░_____░░░___░░░
__________▄▄████▓▓▓▓▓▓▓▓░░_________________________░░_______░░░░
_______▄█▓▓▓▓█▓▓▓▓▓▓▓▓░__░░░░░░░░░░░░░░__________░░_______░
_____▄█▓▓▓▓██▓▓▓▓▓▓▓░░░░___________________░░░_______░░_______░
____█▓▓▓▓▓█▓▓▓▓▓▓▓▓░___________________________░░________░_______░____________░░░
___█▓▓▓▓▓█▓▓▓▓▓▓▓▓░______________________________░░_______░░_______░░░░░░░░__░
__█▓▓▓▓▓▓▓▓▓▓▓▓▓▓░______________________░__________░░░______░░_______________░░
_█▓▓▓▓▓▓▒▒▒▒▒▒▓▓▓░______░░░░░__________░____________░░░______░░░__________░
█▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▓▓░░░▒▒▒▒▒▒░░░░░____░░░__░░________░░________░░░░░░░
█▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒░░░_░▒░░_░░░░______░░░_________░░
█▓▓▓▓▓█▓▒▒▒▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒░░▒▒▒░░░▒░░░░░░░░░░░░░░░░
█▓▓▓▓▓█▓▓▒▒▒▓▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▄▄▅▅▅▅▅▄▄▒▒▒▒▒▒▒▒▒▒▒▒█__░░░▓
_█▓▓▓▓█▓▓▓▒▒▒▓▓▒▒▒▒▒▒▒▒▒█▒▒█▀__▓▓▓▄███▄▒▒▒▒▒▒▒▒▒▒▌_▐███▓
__█▓▓▓█▓▓▓▓▒▒▒▒▓▓▒▒▒▒▒▄▒▒▀█____▓▓____██████▒▒▒▒▒▒▒▐▓█████▓
___█▓▓█▓▓▓▓▓▒▒▒▒▒▓▓▓▒▒▒▀▄▄█_____▓_____▐██████▒▒▒▒▒▒▐▓█▄███▓
____███▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▄▒▒█_____▓_____███████▓▌▒▒▒▒▒▐▓▓███▓
______▀█▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▀▀▀_______▓___█▌_█████▓▌▒▒▒▒▒▒▌_▓▓▓▓
_______█▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒_______▓▓▓▓██████▓█▒▒▒▒▒▒▒▌___▓
_______█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒_______▓▓▓▓▓███▓▓▐▒▒▒▒▒▒▒▒▓▓▓▓▓▓
________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒_________▓▓▓▓▓▓___▒▒▒▒▒▒▒▒▒▒▒▒▒▒▓
________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒_▒▒▒▒▒________________▒▒▒▒▒▒▓▒▒▒▓▓▒▒▒▓
_________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒_▒__▒▒▒▒▒▒____________▒▒▒▒▒▒▒▓▓▒▒▒▒▒▒▓
__________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒_____▒▒▒▒▒▒▒▒▒▓█▓▓▓▓▓▓▓
___________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▓▒██__░
____________█▓▓▓▓▓▓▓▓▓▓▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▓▒█_░░
_____________██▓▓▓▓▓▓▓▓▓█▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▓▓▌░░
_______________██▓▓▓▓▓▓██__▓▒▒▒▒▒▒▒▒▓▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒▓▓▓▓__░
_________________██▓▓▓▓█____▓▒▒▒▒▒▒▒▒▒▒▒▓▓▓▓▓▓▓▓▓▓▓▓▓____░__░
___________________████______▓▒▒▒▒▒▒▒▒▒▒▒▒▒▒░_______________░___░
_____________________▀________▓▒▒▒▒▒▒▒▒▒▒▒▒▒░________________░____░
_______________________________▓▒▒▒▒▒▒▒▒▒▒▒▒░________________░_____░
________________________________▓▒▒▒▒▒▒▒▒▒▒▒▒░_____________░░______░
________________________________▓▒▒▒▒▒░░░░░░░░░__________░________░_░
________________________________▓▒▒░░░___________░░░▓▓▓░░________░__░
_________________________________▓░░__________________░░▓▓░░░░░░░___░
_________________________________░░_░░__________________░_____________░
_________________________________░░░░____________________░░░_______░
_________________________________░__░____________________░░__░░░░░
____________________________________░__________░________░░
_____________________________________░____░____░░░░░░░_░__░░░
______________________________________░___░░___░░_______░░░░
________________________________________░_░_░____░░░_____░░
__________________________________________░___░░░░░░░░░░
-->
<section>
	<header>
		<h1><?php echo $user->pseudo; ?></h1>
	</header>

	<form action="./changer-profil.html" method="post">
		<article>
			<header>
				<h2>Modification du profil</h2>
			</header>

			<table>
				<tbody>
					<tr>
						<td>Email :</td>
						<td>
							<?php
								if (isset($_POST['email'])) {
									echo '<input name="email" type="text" value="' . $_POST['email'] . '" />';
								} else {
									echo '<input name="email" type="text" value="' . $user->email . '" />';
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Pseudo :</td>
						<td>
							<?php
								if (isset($_POST['pseudo'])) {
									echo '<input name="pseudo" type="text" value="' . $_POST['pseudo'] . '" />';
								} else {
									echo '<input name="pseudo" type="text" value="' . $user->pseudo . '" />';
								}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Description :</td>
						<td>
							<?php
								if (isset($_POST['description'])) {
									echo '<textarea name="description" style="height:100px; width:400px;">' . $_POST['description'] . '</textarea>';
								} else {
									echo '<textarea name="description" style="height:100px; width:400px;">' . $user->description . '</textarea>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Acces par d'autres persones a ma collection :</td>
						
						<td>
							<?php
							if ($user->private == 1) {
								echo '<select name="private">';
								echo '<option value="1" selected="selected"> Vrais </option>';
								echo '<option value="0"> Faux </option>';
								echo '</select>';
							} else {
								echo '<select name="private">';
								echo '<option value="1"> Vrais </option>';
								echo '<option value="0" selected="selected"> Faux </option>';
								echo '</select>';
							}
						?>
						</td>
					</tr>
				</tbody>
			</table>

			<footer>
				<input type="submit" value="Envoyer" />
			</footer>
		</article>
	</form>

	<form action="./changer-mot-de-passe.html" method="post">
		<article>
			<header>
				<h2>Modification du mot de passe</h2>
			</header>

			<table>
				<tbody>
					<tr>
						<td>Ancien mot de passe :</td>
						<td><input id="oldpassword" name="oldpassword" type="password" /></td>
					</tr>
					<tr>
						<td>Nouveau mot de passe :</td>
						<td><input id="newpassword1" name="newpassword1" type="password" /></td>
					</tr>
					<tr>
						<td>Retapez le nouveau mot de passe :</td>
						<td><input id="newpassword2" name="newpassword2" type="password" /></td>
					</tr>
				</tbody>
			</table>

			<footer>
				<input type="submit" value="Envoyer" />
			</footer>
		</article>
	</form>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
