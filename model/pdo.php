<?php

include_once('./inc.error.php');

$bdd_host = '';
$bdd_dbname = '';
$bdd_user = '';
$bdd_pwd = '';



try {
    $strConnection = 'mysql:host=' . $bdd_host . ';dbname=' . $bdd_dbname;
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $pdo = new PDO($strConnection, $bdd_user, $bdd_pwd, $arrExtraParam); // Instancie la connexion.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	echo '<p>' . $exception->getMessage() . '</p>';
}

/*
 * Vérifie le format d'une adresse email.
 */
function check_email ($email) {
	return (filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
}

/*
 * Vérifie le format d'une url.
 */
function check_url ($url) {
	/* return (filter_var($url, FILTER_VALIDATE_URL) !== false); */
	return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url);
}

function dateFromSQL ($date) {
	if ($date == '') {
		return '';
	}
	$date = explode('-', $date);
	return $date[2] . '/' . $date[1] . '/' . $date[0];
}

function dateToSQL ($str) {
	$str = explode('/', $str);
	return $str[2] . '-' . $str[1] . '-' . $str[0];
}

 error_reporting(E_ALL);   // Activer le rapport d'erreurs PHP

?>