<?php
namespace App\Models;
use App\Models\CRUD;

class Timbre extends CRUD{
    protected $table = 'timbre';
    protected $primaryKey = 'id';
    protected $isAuth = [1];
    protected $fillable = ['titre', 'description', 'annee', 'prix_depart', 'timbre_categorie_id', 'etat_conservation_id'];


    /**
     * $value: id da la timbre
     * $what: nom de la 2e colonne à comparer
     * $idToFind: id de comparason avec la 2e colonne 
     */
    final public function selectIdWhere($value, $what, $idToFind)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey AND $what = :$what ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->bindValue(":$what", $idToFind);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }
}
