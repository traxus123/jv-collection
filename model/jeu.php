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
	public function image () {return $this->row['Image'];}


	public function u_id () {return $this->row['id'];}
	public function u_id_user () {return $this->row['id_user'];}
	public function u_id_jeu () {return $this->row['id_jeu'];}
	public function u_etat () {return $this->row['etat'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($id_console, $nom, $genre, $developpeur, $editeur, $annee, $prix, $description, $image) {
		global $pdo;

		$stmt = $pdo->prepare('insert into jeu (id_console, nom, genre, developpeur, editeur, annee, prix, description, Image) values (:id_console, :nom, :genre, :developpeur, :editeur, :annee, :prix, :description, :image);');
		$stmt->bindValue(':id_console', $id_console, PDO::PARAM_STR);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
		$stmt->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
		$stmt->bindValue(':editeur', $editeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':image', $image, PDO::PARAM_STR);

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

	public static function select_filters_orderbyname($nom, $console, $genre, $developpeur, $editeur, $annee){
		global $pdo;

		$stmt = $pdo->prepare('select * from jeu where nom like :nom and id_console like :console and genre like :genre and developpeur like :developpeur and editeur like :editeur and annee like :annee order by nom, id_console;');
		$stmt->bindValue(':nom','%'.$nom.'%', PDO::PARAM_STR);
		$stmt->bindValue(':console','%'.$console.'%', PDO::PARAM_STR);
		$stmt->bindValue(':genre','%'.$genre.'%', PDO::PARAM_STR);
		$stmt->bindValue(':developpeur','%'.$developpeur.'%', PDO::PARAM_STR);
		$stmt->bindValue(':editeur','%'.$editeur.'%', PDO::PARAM_STR);
		$stmt->bindValue(':annee','%'.$annee.'%');
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

	public static function update ($id, $id_console, $nom, $genre, $developpeur, $editeur, $annee, $prix, $description, $image) {
		global $pdo;

		$stmt = $pdo->prepare('update jeu set id_console = :id_console, nom = :nom, genre = :genre, developpeur = :developpeur, editeur = :editeur, annee = :annee, prix = :prix, description = :description, Image = :image where id = :id;');

		$stmt->bindValue(':id_console', $id_console, PDO::PARAM_STR);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
		$stmt->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
		$stmt->bindValue(':editeur', $editeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':image', $image, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			//return new CalliopeError(CalliopeError::CODE_DEFAULT_KO, 'Erreur lors de la mise à jour d\'un jeu', '<p>' . $exception->getMessage() . '</p>');
		}

		return true;
	}

	public static function u_insert ($id_user, $id_jeu, $etat) {
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
	public static function u_select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select * from user_jeu where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_c ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from jeu c, user_jeu u where c.id = u.id_jeu AND u.ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}
	
	public static function u_select_orderbyname ($user) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from jeu c, user_jeu u where c.id = u.id_jeu AND u.id_user = :user order by nom;');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_name_model_const_date ($console, $nom, $genre, $developpeur, $editeur, $annee) {
		global $pdo;

		$stmt = $pdo->prepare('select * from jeu where id_console = :console and nom = :nom and genre = :genre and developpeur = :developpeur and editeur = :editeur and annee = :annee limit 1;');
		$stmt->bindValue(':console', $console);
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
		$stmt->bindValue(':developpeur', $developpeur, PDO::PARAM_STR);
		$stmt->bindValue(':editeur', $editeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_contains_orderbyname($user, $filtre) {
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

	public static function u_delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM user_jeu where ID = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_update ($id, $id_user, $etat) {
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