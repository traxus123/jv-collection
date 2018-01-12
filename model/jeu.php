<?php

include_once('./model/pdo.php');

class Jeu {

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
	public function id_console () {return $this->row['id_console'];}
	public function nom () {return $this->row['nom'];}
	public function genre () {return $this->row['genre'];}
	public function developpeur () {return $this->row['developpeur'];}
	public function editeur () {return $this->row['editeur'];}
	public function annee () {return $this->row['annee'];}
	public function prix () {return $this->row['prix'];}
	public function description () {return $this->row['description'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($id_console, $nom, $genre, $developpeur, $editeur, $annee, $prix, $description) {
		global $pdo;

		$stmt = $pdo->prepare('insert into jeu (id_console, nom, genre, developpeur, editeur, annee, prix, description) values (:id_console, :nom, :genre, :developpeur, :editeur, :annee, :prix, :description);');
		$stmt->bindValue(':id_console', $id_console, PDO::PARAM_STR);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
		$stmt->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
		$stmt->bindValue(':editeur', $editeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			echo $exception;
		}

		return $pdo->lastInsertId();
	}

	/*
	 * Sélectionne le jeu dont l'identifiant est passé en paramètre.
	 */
	public static function select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select * from jeu where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}
	public static function select_orderbyname () {
		global $pdo;

		$stmt = $pdo->prepare('select * from jeu order by nom;');
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_contains_orderbyname($filtre) {
		global $pdo;

		$stmt = $pdo->prepare('select * from jeu where nom like :filtre order by nom;');
		$stmt->bindValue(':filtre','%'.$filtre.'%', PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);
		
		return $data;
	}
	public static function delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM jeu where ID = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function update ($id, $id_console, $nom, $genre, $developpeur, $editeur, $annee, $prix, $description) {
		global $pdo;

		$stmt = $pdo->prepare('update jeu set id_console = :id_console, nom = :nom, genre = :genre, developpeur = :developpeur, editeur = :editeur, annee = :annee, prix = :prix, description = :description where id = :id;');

		$stmt->bindValue(':id_console', $id_console, PDO::PARAM_STR);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
		$stmt->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
		$stmt->bindValue(':editeur', $editeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);

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