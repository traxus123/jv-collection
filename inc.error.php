<?php

class MyError {

	const CODE_DEFAULT_OK = 0;
	const CODE_DEFAULT_KO = 1;

	public $code;
	public $title;
	public $message;

	function __construct($code = self::CODE_DEFAULT_KO, $title = null, $message = null) {
		$this->code = $code;
		$this->title = $title;
		$this->message = $message;
	}

	public function display () {
		echo '<!-- ' . $this->message . ' -->';
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
					<h1>
						<?php
							if (isset($this->title)) {
								echo $this->title;
							} else {
								echo 'Erreur';
							}
						?>
					</h1>
				</header>

				<?php
					if (isset($this->message)) {
						echo $this->message;
					} else {
						echo '<p>Erreur inconnue.</p>';
					}
				?>
			</section>

			<?php
				include('./inc.aside.php');
				include('./inc.footer.php');
			?>

			</body>

			</html>
		<?php
	}

}

class CalliopeError {

	const CODE_DEFAULT_OK = 0;
	const CODE_DEFAULT_KO = 1;

	public $code;
	public $title;
	public $message;

	function __construct($code = self::CODE_DEFAULT_KO, $title = null, $message = null) {
		$this->code = $code;
		$this->title = $title;
		$this->message = $message;
	}

	public function redirect () {
		$_SESSION['calliope_error'] = $this;
		header('Location: ./erreur.html');
	}

}

?>