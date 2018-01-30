<?php

include_once('./model/pdo.php');

class JVUser {

	/*
	 * Variables membres.
	 */
	public $id;
	public $pseudo; 
	public $email;
	public $description;
	public $droit = 0; // Rang.

	/*
	 * Constructeur.
	 */
	function __construct($id) {
		$this->id = $id;
	}

	/*
	 * Fonction permettant de vérifier si un utilisateur possède un droit.
	 */
	function hasRight ($sRight, $id = null) {
		switch ($sRight) {
			/*
			case self::RIGHT_ARTICLE_ADD :
			case self::RIGHT_ARTICLE_DELETE :
			case self::RIGHT_ARTICLE_EDIT :
			case self::RIGHT_PLAY_ADD :
			case 'ajouter-evenement' :
			case 'modifier-evenement' :
			case 'modifier-jeu' :
			case 'supprimer-evenement' :
				return ($this->rank >= self::RANK_MEMBER);

			case self::RIGHT_PLAY_DELETE :
			case self::RIGHT_PLAY_EDIT :
			case 'modifier-partie' :
			case 'supprimer-partie' :
				return ($this->rank >= self::RANK_ADMIN) || (($this->rank >= self::RANK_MEMBER) && ($id == $this->id));

			case self::RIGHT_USER_ADD :
			case 'ajouter-utilisateur' :
				//Seul un administrateur peut ajouter un utilisateur. 
				return ($this->rank >= self::RANK_ADMIN);
			*/
		}
		return false;
	}

	/*
	 * Fonction permettant de vérifier si un utilisateur est de rang administrateur.
	 */
	function isAdmin () {
		return $this->droit >= 2;
	}

	/*
	 * Fonction permettant de vérifier si un utilisateur est identifié.
	 */
	function isLogged () {
		return $this->droit > 0;
	}

	public static function select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select pseudo from utilisateur where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function check_email ($id, $email) {
		global $pdo;

		$stmt = $pdo->prepare('select count(*) line_count from utilisateur where email = :email and id <> :id');
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return ($row['line_count'] <= 0);
	}

	public static function select_hash ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select mdp from utilisateur where id = :id limit 1');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $row['mdp'];
	}

	public static function select_contains_orderbyname ($filtre) {
		global $pdo;

		$stmt = $pdo->prepare('select id, pseudo, private from utilisateur where pseudo like :filtre order by pseudo;');
		$stmt->bindValue(':filtre','%'.$filtre.'%', PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function set_privacy($user, $private){
				global $pdo;

		$stmt = $pdo->prepare('update user set private = :private where id = :user;');
		$stmt->bindValue(':private', $private, PDO::PARAM_INT);
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			return $exception;
		}

		return true;
	}

	function load ($email, $pwd) {
		global $pdo;
		global $_SESSION;
		$stmt = $pdo->prepare('select * from utilisateur where email = :email limit 1');
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);

		if (!$stmt->execute()) {
			$stmt->closeCursor();
			unset($stmt);

			return self::ERROR_USERUNKNOWN;
		} else if ($stmt->rowCount() <= 0) {
			$stmt->closeCursor();
			unset($stmt);

			return self::ERROR_USERUNKNOWN;
		} else {
			$row = $stmt->fetch();
			$stmt->closeCursor();
			unset($stmt);

			if (strtolower($row['mdp']) != strtolower(hash('sha256', $pwd))) {
				return self::ERROR_INCORRECTPASSWORD;
			} else {
				$this->id = $row['id'];
				$this->pseudo = $row['pseudo'];
				$this->email = $row['email'];
				$this->droit = $row['droit'];
				$this->description = $row['description'];
				$this->private = $row['private'];

				$_SESSION['user'] = $this;
				session_commit();

				return 0;
			}
		}
	}

	public static function update_profil ($id, $email, $pseudo, $description, $private){
		global $pdo;

		$stmt = $pdo->prepare('update utilisateur set email = :email, pseudo = :pseudo, description = :description , private = :private where id = :id;');
		$stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':private', $private, PDO::PARAM_INT);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			echo '<p>' . $exception->getMessage() . '</p>';
		}
		$user->pseudo = $pseudo;
		$user->email = $email;
		$user->description = $description;
		$user->private = $private;
		$_SESSION['user'] = $user;
		return true;
	}

	public static function update_hash ($id, $mdp) {
		global $pdo;

		$stmt = $pdo->prepare('update utilisateur set mdp = :mdp where id = :id limit 1');
		$stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			echo '<p>' . $exception->getMessage() . '</p>';
		}

		return true;
	}
}

session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = new JVUser(-1);
}

?>