<?php

namespace App\Models;

use App\Models\CRUD;

class Encherehasuser extends CRUD
{
    protected $table = 'enchere_has_user';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2, 3]; // Ici juste 1 pour la ligne 14 du CRUD mais faudra 2
    protected $fillable = ['recette_id', 'etat_conservation_id', 'quantite', 'unite_mesure_id'];


    public function delete($value)
    {

        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uniqueKeys($field1, $value1, $field2, $value2)
    {
        $sql = "SELECT * FROM $this->table WHERE $field1 = :$field1 and $field2 = :$field2 ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field1", $value1);
        $stmt->bindValue(":$field2", $value2);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 0) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    

    final public function selectIdKeys($value1, $value2)
    {

        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);
/*         $stmt->bindValue(":$this->primaryKey", $value1);
        $stmt->bindValue(":$this->secondaryKey", $value2); */
        $stmt->execute(array(":$this->primaryKey" => $value1));
        $count = $stmt->rowCount();

        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

}
