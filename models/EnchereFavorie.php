<?php
namespace App\Models;
use App\Models\CRUD;

class EnchereFavorie extends CRUD{
    protected $table = 'enchere_favorie';
    protected $primaryKey = 'enchere_id';
    protected $secondaryKey = 'user_id';
    protected $isAuth = [1, 2];
    protected $fillable = ['enchere_id', 'user_id', 'est_favorie'];
    
    
    public function ajouteFavorie($enchere_id)
    {
        $query = "INSERT INTO $this->table ('enchere_id', 'user_id', 'est_favorie') 
				  VALUES ('" . $enchere_id . "','" . $_SESSION['user_id'] . "','" . 1 . "')";
	return executeRequete($query, true);
}


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

}
	