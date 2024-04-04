<?php
namespace App\Models;
use App\Models\CRUD;

class EnchereFavorie extends CRUD{
    protected $table = 'enchere_favorie';
    protected $primaryKey = 'enchere_id';
    protected $secondaryKey = 'user_id';
    protected $isAuth = [1, 2];
    protected $fillable = ['enchere_id', 'user_id', 'est_favorie'];
    
    
    
/*     public function ajouteFavorie($enchere_id)
    {
        $query = "INSERT INTO $this->table ('enchere_id', 'user_id', 'est_favorie') 
				  VALUES ('" . $enchere_id . "','" . $_SESSION['user_id'] . "','" . 1 . "')";
	return executeRequete($query, true);
} */


public function connexionDB() {

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




function executeRequete($requete, $insert = false)
{

	$laConnexion = mysqli_connect('localhost', 'root', 'root');

	if (!$laConnexion) {
		// La connexion n'a pas fonctionné
		die('Erreur de connexion à la base de données. ' . mysqli_connect_error());
	}

	$db = mysqli_select_db($laConnexion, 'stampee');

	if (!$db) {
		die('La base de données n\'existe pas.');
	}

	mysqli_query($laConnexion, 'SET NAMES "utf8"');

	$connexion = $laConnexion;
	if ($insert) {
		mysqli_query($connexion, $requete);
		$resultats = $connexion->insert_id;
	} else {
		$resultats = mysqli_query($connexion, $requete);
	}
	return $resultats;
}

}
	