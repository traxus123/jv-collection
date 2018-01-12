<?php

class Console {

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
	public function nom () {return $this->row['nom'];}
	public function model () {return $this->row['model'];}
	public function constructeur () {return $this->row['constructeur'];}
	public function annee () {return $this->row['annee'];}
	public function prix () {return $this->row['prix'];}
	public function description () {return $this->row['description'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($nom, $model, $constructeur, $annee, $prix, $description) {
		global $pdo;

		$stmt = $pdo->prepare('insert into console (nom, model, constructeur, annee, prix, description) values (:nom, :model, :constructeur, :annee, :prix, :description);');
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':model', $model, PDO::PARAM_STR);
		$stmt->bindValue(':constructeur', $constructeur, PDO::PARAM_STR);
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

		$stmt = $pdo->prepare('select * from console where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_orderbyname () {
		global $pdo;

		$stmt = $pdo->prepare('select * from console order by nom, model;');
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function select_contains_orderbyname($filtre) {
		global $pdo;

		$stmt = $pdo->prepare('select * from console where nom like :filtre order by nom, model;');
		$stmt->bindValue(':filtre','%'.$filtre.'%', PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);
		
		return $data;
	}

	public static function select_d_orderbyname () {
		global $pdo;

		$stmt = $pdo->prepare('select * from console where games = 1 order by nom, model;');
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM console where ID = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}
	
	public static function update ($id, $nom, $model, $constructeur, $annee, $prix, $description) {
		global $pdo;

		$stmt = $pdo->prepare('update console set nom = :nom, model = :model, constructeur = :constructeur, annee = :annee, prix = :prix, description = :description where id = :id;');

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindParam(':model', $model, PDO::PARAM_STR);
		$stmt->bindParam(':constructeur', $constructeur, PDO::PARAM_STR);
		$stmt->bindParam(':annee', $annee);
		$stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);

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