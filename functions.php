<?php
$connexion = connexionDB();

/**
 * Connection avec la base de données
 */
function connexionDB()
{
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');			// MAC
	//define('DB_PASSWORD', '');			// Windows

	$laConnexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

	if (!$laConnexion) {
		// La connexion n'a pas fonctionné
		die('Erreur de connexion à la base de données. ' . mysqli_connect_error());
	}

	$db = mysqli_select_db($laConnexion, 'stampee');

	if (!$db) {
		die('La base de données n\'existe pas.');
	}

	mysqli_query($laConnexion, 'SET NAMES "utf8"');
	return $laConnexion;
}


/**
 * Exécute la requête SQL
 * Si le paramètre $insert est true, retourne l'id de la ressource ajoutée à la db
 */
function executeRequete($requete, $insert = false)
{
	global $connexion;
	if ($insert) {
		mysqli_query($connexion, $requete);
		$resultats = $connexion->insert_id;
	} else {
		$resultats = mysqli_query($connexion, $requete);
	}
	return $resultats;
}


/**
 * Retourne la liste des tâches
 */
function getAllEncheres()
{
	return executeRequete("SELECT * FROM enchere");
}

/**
 * Retourne la liste des tâches trié ASC
 */
function getAllEncheresSort($sort)
{
	return executeRequete("SELECT * FROM enchere ORDER BY $sort");
}

/**
 * Ajoute la nouvelle tâche
 */
function ajouteEnchere($enchere, $description, $importance)
{
	$query = "INSERT INTO enchere (`enchere`, `description`, `importance`) 
				  VALUES ('" . $enchere . "','" . $description . "','" . $importance . "')";
	return executeRequete($query, true);
}


/**
 * Change le nom d'une tâhce spécifiée en paramètre
 */
function changeNomEnchere($nom_enchere, $id_enchere)
{
	global $connexion;
	$nom_enchere = mysqli_real_escape_string($connexion, $nom_enchere);
	$id_enchere = mysqli_real_escape_string($connexion, $id_enchere);

	return executeRequete("UPDATE enchere 
							   SET nom = '$nom_enchere' 
							   WHERE id ='$id_enchere'");
}


/**
 * Supprime l'tâche spécifiée en paramètre
 */
function supprimeEnchere($id_enchere)
{
	global $connexion;
	$id_enchere = mysqli_real_escape_string($connexion, $id_enchere);

	return executeRequete("DELETE FROM enchere WHERE id = " . $id_enchere);
}

/**
 * Change le nom d'une tâhce spécifiée en paramètre
 */
function getEnchereDetail($id_enchere)
{
	global $connexion;
	$id_enchere = mysqli_real_escape_string($connexion, $id_enchere);

	return executeRequete("SELECT * FROM enchere WHERE id = " . $id_enchere);
}
