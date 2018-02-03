<?php

require('./model/user.php');
//require('./lib/recaptchalib.php');

if (count($_POST) > 0) {
	/*
	 * On vérifie les renseignements du formulaire.
	 */
	$check = true;

	if (($check) && (trim($_POST['emailfrom']) == '')) {
		$check = false;
	}

	if (($check) && (trim($_POST['subject']) == '')) {
		$check = false;
	}
/*
	if ($check) {
		$reCaptcha = new ReCaptcha('6LeIYzEUAAAAAHxb6faw0UUA1JD0ZiCUyRj5edfr');

		if (isset($_POST["g-recaptcha-response"])) {
			$resp = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]);

			if (($resp == null) || (!$resp->success)) {
				$check = false;
			}
		} else {
			$check = false;
		}
	}
*/
	if ($check) {
		/*
		 * Envoyer l'email.
		 */

		$emailto = 'thomas.f.rebouillat@gmail.com';

		$emailfrom = $_POST['emailfrom'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$headers = 'From: ' . $emailfrom . "\r\n"
			.'Reply-To: ' . $emailfrom . "\r\n"
			.'MIME-Version: 1.0' . "\r\n"
			.'Content-Type: text/html; charset="utf-8"' . "\r\n"
			.'X-Mailer: PHP/' . phpversion();

		if (mail($emailto, $subject, $message, $headers)) {
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

<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->

<body>

<header>
	<?php
		include('./inc.banner.php');
		include('./inc.nav.php');
	?>
</header>

<section>
	<header>
		<h1>Contacter L'administrataur</h1>
	</header>

	<form action="./contact.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Votre email</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="emailfrom" style="width: 100%;" type="email" value="' . $_POST['emailfrom'] . '" placeholder="Entrez votre email." />';
							} else if ($user->isLogged()) {
								echo '<input name="emailfrom" style="width: 100%;" type="email" value="' . $user->email . '" placeholder="Entrez votre email." />';
							} else {
								echo '<input name="emailfrom" style="width: 100%;" type="email" placeholder="Entrez votre email." />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['emailfrom']) == '')) {
								echo '<span class="error">Vous devez saisir un email.</span>';
							}
							/* TODO : regex pour vérifier le format de l'email. */
						?>
					</td>
				</tr>
				<tr>
					<td>Sujet de l'email</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="subject" style="width: 100%;" type="text" value="' . $_POST['subject'] . '" placeholder="Entrez un sujet." />';
							} else {
								echo '<input name="subject" style="width: 100%;" type="text" value="" placeholder="Entrez un sujet." />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['subject']) == '')) {
								echo '<span class="error">Vous devez saisir un sujet.</span>';
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<article>
			<header>
				<h2>Message</h2>
			</header>

			<textarea name="message" id="message"><?php if (count($_POST) > 0) {echo $_POST['message'];} ?></textarea>
			<script type="text/javascript">CKEDITOR.replace('message');</script>
		</article>

		<!--<center style="margin-top: 1rem;">
			<div class="g-recaptcha" data-sitekey="6LeIYzEUAAAAAI0B0etotQnokL_HN059BYBU5NgG"></div>
		</center>-->

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
