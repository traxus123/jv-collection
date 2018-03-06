<nav>
	<ul>
		<li><a href="./accueil.html">Accueil</a></li>
		<li><a href="./list-collection-utilisateur.html">Collections</a></li>
		<?php
			if ($user->isLogged()) {
				echo '<li><p>Mes Collections</p>';
				echo '	<ul>';
				echo '		<li><a href="./list-console-utilisateur.html">Mes Consoles</a></li>';
				echo '		<li><a href="./list-jeu-utilisateur.html">Mes Jeux</a></li>';
				echo '	</ul>';
				echo '</li>';
				echo '<li><a href="./profil.html">' . $user->pseudo . '</a></li>';
				echo '<li><a href="./deconnection.html">Déconnection</a></li>';
				if($user->isAdmin()) {
					echo '<li><p>Outils d\'administration</p>';
					echo 	'<ul>';
					echo 		'<li><a href="./list-console.html">Gestion Consoles</a></li>';
					echo 		'<li><a href="./list-jeu.html">Gestion Jeux</a></li>';
					echo 	'</ul>';
					echo '</li>';
				}
			}
			else {
				echo '<li><a href="./login.html">Connexion</a></li>';
			}
		?>
	</ul>
</nav>