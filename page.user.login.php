<?php

require('./model/user.php');

if (count($_POST) > 0) {
	$status = $user->load($_POST['email'], $_POST['password']);
	header('location: ./accueil.html');
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
<style>
.w-100{
	width: 100%;
}
</style>
<section>
	<header>
		<h1>Identification</h1>
		<h2>Connection</h2>
	</header>

	<form action="./login.html" method="post">
		<table class="column-2-right" style="width: 100%;">
			<tbody>
				<tr>
					<td style="width: 20%;">Email :</td>
					<td style="width: 200px;">
						<?php
							if (isset($_POST['email'])) {
								echo '<input name="email" style="width: 100%;" type="email" placeholder="Entrez votre email." value="' . $_POST['email'] . '" />';
							} else {
								echo '<input name="email" style="width: 100%;" type="email" placeholder="Entrez votre email." />';
							}
						?>
					</td>
					<td>
						<?php
							/*if ($status == User::ERROR_USERUNKNOWN) {
								echo '<span class="error">* Utilisateur inconnu.</span>';
							}*/
						?>
					</td>
				</tr>
				<tr>
					<td>Mot de passe :</td>
					<td><input name="password" style="width: 100%;" type="password" placeholder="Entrez votre mot de passe." /></td>
					<td>
						<?php
							/*if ($status == User::ERROR_INCORRECTPASSWORD) {
								echo '<span class="error">* Mot de passe incorrect.</span>';
							}*/	
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<footer>
			<input type="submit" value="Envoyer" />
		</footer>
	</form>

	<article>
		<header>
			<h2>Inscription</h2>
		</header>
		<form action="./script.suscribe.php" method="post">
			<table class="column-2-right" class="w-100"style="width: 100%;">
				<tbody>
					<tr>
						<td>Pseudo :</td>
						<td>
							<?php
								if (isset($_POST['pseudo'])) {
									echo '<input name="pseudo" style="width: 100%;" type="text" placeholder="Entrez votre pseudo." value="' . $_POST['pseudo'] . '" />';
								} else {
									echo '<input name="pseudo" style="width: 100%;" type="text" placeholder="Entrez votre pseudo." />';
								}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td style="width: 20%;">Email :</td>
						<td style="width: 200px;">
							<?php
								if (isset($_POST['email'])) {
									echo '<input name="email" style="width: 100%;" type="email" placeholder="Entrez votre email." value="' . $_POST['email'] . '" />';
								} else {
									echo '<input name="email" style="width: 100%;" type="email" placeholder="Entrez votre email." />';
								}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Mot de passe :</td>
						<td>
							<?php
								if (isset($_POST['mypwd1'])) {
									echo '<input name="mypwd1" style="width: 100%;" type="password" placeholder="Entrez un mot de passe." value="' . $_POST['mypwd1'] . '" />';
								} else {
									echo '<input name="mypwd1" style="width: 100%;" type="password" placeholder="Entrez un mot de passe." />';
								}
							?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Retapez le Mot de passe :</td>
						<td>
							<?php
								if (isset($_POST['mypwd2'])) {
									echo '<input name="mypwd2" style="width: 100%;" type="password" placeholder="Retapez le Mot de passe." value="' . $_POST['mypwd2'] . '" />';
								} else {
									echo '<input name="mypwd2" style="width: 100%;" type="password" placeholder="Retapez le Mot de passe." />';
								}
							?>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<footer>
				<input type="submit" value="Envoyer" />
			</footer>
		</form>
	</article>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
