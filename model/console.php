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
	public function image () {return $this->row['Image'];}

	public function u_id () {return $this->row['id'];}
	public function u_id_user () {return $this->row['id_user'];}
	public function u_id_console () {return $this->row['id_console'];}
	public function u_etat () {return $this->row['etat'];}

	/**
	 * Fonctions statiques.
	 **/

	public static function insert ($nom, $model, $constructeur, $annee, $prix, $description, $image) {
		global $pdo;

		$stmt = $pdo->prepare('insert into console (nom, model, constructeur, annee, prix, description, Image) values (:nom, :model, :constructeur, :annee, :prix, :description, :image);');
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':model', $model, PDO::PARAM_STR);
		$stmt->bindValue(':constructeur', $constructeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':image', $image, PDO::PARAM_STR);

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

	public static function select_filters_orderbyname($nom, $model, $constructeur, $annee){
		global $pdo;

		$stmt = $pdo->prepare('select * from console where nom like :nom and model like :model and constructeur like :constructeur and annee like :annee order by nom, model;');
		$stmt->bindValue(':nom','%'.$nom.'%', PDO::PARAM_STR);
		$stmt->bindValue(':model','%'.$model.'%', PDO::PARAM_STR);
		$stmt->bindValue(':constructeur','%'.$constructeur.'%', PDO::PARAM_STR);
		$stmt->bindValue(':annee','%'.$annee.'%');
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

	public static function select_name_d_orderbyname ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select nom from console where id = :id and games = 1 order by nom, model;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
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
	
	public static function update ($id, $nom, $model, $constructeur, $annee, $prix, $description, $image) {
		global $pdo;

		$stmt = $pdo->prepare('update console set nom = :nom, model = :model, constructeur = :constructeur, annee = :annee, prix = :prix, description = :description, Image = :image where id = :id;');

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindParam(':model', $model, PDO::PARAM_STR);
		$stmt->bindParam(':constructeur', $constructeur, PDO::PARAM_STR);
		$stmt->bindParam(':annee', $annee);
		$stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':image', $image, PDO::PARAM_STR);

		try {
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $exception) {
			echo '<p>' . $exception->getMessage() . '</p>';
		}

		return true;
	}



	public static function u_insert ($id_user, $id_console, $etat) {
		global $pdo;

		$stmt = $pdo->prepare('insert into user_console (id_user, id_console, etat) values (:id_user, :id_console, :etat);');
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_STR);
		$stmt->bindValue(':id_console', $id_console, PDO::PARAM_STR);
		$stmt->bindValue(':etat', $etat, PDO::PARAM_STR);

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
	 * Sélectionne le jeu dont l'identifiant est passé en paramètre.
	 */
	public static function u_select ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select * from user_console where ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_name_model_const_date ($nom, $model, $constructeur, $annee) {
		global $pdo;

		$stmt = $pdo->prepare('select * from console where nom = :nom and model = :model and constructeur = :constructeur and annee = :annee limit 1;');
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindValue(':model', $model, PDO::PARAM_STR);
		$stmt->bindValue(':constructeur', $constructeur, PDO::PARAM_STR);
		$stmt->bindValue(':annee', $annee);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_c ($id) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from console c, user_console u where c.id = u.id_console AND u.ID = :id limit 1;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_orderbyname ($user) {
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from console c, user_console u where c.id = u.id_console AND u.id_user = :user order by nom;');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_select_contains_orderbyname($user, $filtre) {
		global $pdo;
		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from console c, user_console u where c.id = u.id_console AND u.id_user = :user AND c.nom like :filtre order by nom');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->bindValue(':filtre','%'.$filtre.'%', PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);
		
		return $data;
	}

	public static function u_select_filters_orderbyname($user, $nom, $model, $constructeur, $annee){
		global $pdo;

		$stmt = $pdo->prepare('select c.*, u.etat, u.id as uid from console c, user_console u where c.nom like :nom and c.model like :model and c.constructeur like :constructeur and c.annee like :annee and c.id = u.id_console AND u.id_user = :user order by nom, model;');
		$stmt->bindValue(':user', $user, PDO::PARAM_INT);
		$stmt->bindValue(':nom','%'.$nom.'%', PDO::PARAM_STR);
		$stmt->bindValue(':model','%'.$model.'%', PDO::PARAM_STR);
		$stmt->bindValue(':constructeur','%'.$constructeur.'%', PDO::PARAM_STR);
		$stmt->bindValue(':annee','%'.$annee.'%');
		$stmt->execute();
		$data = $stmt->fetchALL();
		$stmt->closeCursor();
		unset($stmt);
		
		return $data;
	}

	public static function u_delete ($id) {
		global $pdo;

		$stmt = $pdo->prepare('DELETE FROM user_console where ID = :id;');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		unset($stmt);

		return $data;
	}

	public static function u_update ($id, $id_user, $etat) {
		global $pdo;

		$stmt = $pdo->prepare('update user_console set id_user = :id_user,  etat = :etat where id = :id;');

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
		$stmt->bindParam(':etat', $etat, PDO::PARAM_STR);

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