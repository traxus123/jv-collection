<?php

include_once('./model/pdo.php');

class User_Jeu {

	/*
	 * Variables membres.
	 */
	public $row = null;

	/*
	 * Constructeur.
	 */
	function __construct($row) {
		$this->row = $row;
	}

	/**
	 * Accesseurs.
	 **/

	public function id () {return $this->row['id'];}
	public function id_user () {return $this->row['id_user'];}
	public function id_jeu () {return $this->row['id_jeu'];}
	public function etat () {return $this->row['etat'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($id_user, $id_jeu, $etat) {
		global $pdo;

		$stmt = $pdo->prepare('insert into user_jeu (id_user, id_jeu, etat) values (:id_user, :id_jeu, :etat);');
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_STR);
		$stmt->bindValue(':id_jeu', $id_jeu, PDO::PARAM_STR);
		$stmt->bindValue(':etat', $etat, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			//return new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de l\'ajout d\'un jeu', '<p>' . $exception->getMessage() . '</p>');
		}

		return $pdo->lastInsertId();
	}

	/*
	 * Sélectionne le jeu dont l'identifiant est passé en paramètre.
	 */
	public static function select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select * from user_jeu where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_c ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from jeu c, user_jeu u where c.id = u.id_jeu AND u.ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_orderbyname ($user) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from jeu c, user_jeu u where c.id = u.id_jeu AND u.id_user = :user order by nom;');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_contains_orderbyname($user, $filtre) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from jeu c, user_jeu u where c.id = u.id_jeu AND u.id_user = :user AND c.nom like :filtre order by nom;');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->bindValue(':filtre','%'.$filtre.'%', PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);
		
		return $data;
	}

	public static function delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM user_jeu where ID = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function update ($id, $id_user, $etat) {
		global $pdo;

		$stmt = $pdo->prepare('update user_jeu set id_user = :id_user,  etat = :etat where id = :id;');

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
		$stmt->bindParam(':etat', $etat, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			//return new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de la mise à jour d\'un jeu', '<p>' . $exception->getMessage() . '</p>');
		}

		return true;
	}
}

?>