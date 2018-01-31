<?php

include_once('./model/pdo.php');

class Menu {

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
	public function type () {return $this->row['type'];}
	public function nom () {return $this->row['nom'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($type, $nom) {
		global $pdo;

		$stmt = $pdo->prepare('insert into menu (type, nom) values (:type, :nom);');
		$stmt->bindValue(':type', $type);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			echo '<p>' . $exception->getMessage() . '</p>';
		}

		return $pdo->lastInsertId();
	}

	/*
	 * Sélectionne le menu dont l'identifiant est passé en paramètre.
	 */
	public static function select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select * from menu where id = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_type ($type) {
		global $pdo;

		$stmt = $pdo->prepare('select * from menu where type = :type order by nom;');
		$stmt->bindValue(':type', $type);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_orderbyname () {
		global $pdo;

		$stmt = $pdo->prepare('select * from menu order by nom;');
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM menu where id = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function update ($id, $type, $nom) {
		global $pdo;

		$stmt = $pdo->prepare('update jeu set type = :type, nom = :nom where id = :id;');

		$stmt->bindValue(':type', $type);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);

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

?>