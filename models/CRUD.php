<?php

namespace App\Models;

abstract class CRUD extends \PDO
{

    final public function __construct()
    {


        parent::__construct('mysql:host=localhost;dbname=stampee;port=3306;charset=utf8', 'root', 'root');
    }

    final public function isAuth()
    {
        return $this->isAuth;
    }

    final public function select($field = null, $order = 'asc')
    {
        if ($field == null) {
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        if ($stmt = $this->query($sql)) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    final public function selectId($value, $field = null)
    {
        if ($field == null) {
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table WHERE $field = :$field;";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 1) {
            return $stmt->fetch();
        } else if ($count > 1) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    final public function selectIdTwoKeys($value1, $value2, $field1 = null, $field2 = null)
    {
        if ($field1 == null) {
            $field1 = $this->primaryKey;
        }

        if ($field2 == null) {
            $field2 = $this->secondaryKey;
        }
        $sql = "SELECT * FROM $this->table WHERE $field1 = :$field1 AND $field2 = :$field2 ;";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field1", $value1);
        $stmt->bindValue(":$field2", $value2);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else if ($count > 1) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }



    public function insert($data)
    {
        
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }
    
    public function insertTwoKeys($data)
    {

        $data_keys = array_fill_keys($this->fillable, '');

        $data = array_intersect_key($data, $data_keys);

        $fieldName = implode(', ', array_keys($data));

        $fieldValue = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return true;
        } else {

            return false;
        }
    }
    public function delete($value)
    {
        if ($this->selectId($value)) {
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->primaryKey", $value);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Peut maintenant faire update avec une clé composée, pour vrai
     */
    public function update($data, $id, $id2 = null)
    {   

        if (!$id2) {

            if ($this->selectId($id)) {
                $data_keys = array_fill_keys($this->fillable, '');
                $data = array_intersect_key($data, $data_keys);
                $fieldName = null;
                foreach ($data as $key => $value) {
                    $fieldName .= "$key = :$key, ";
                }
                $fieldName = rtrim($fieldName, ', ');
                $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey;";

                
                $stmt = $this->prepare($sql);
                $data[$this->primaryKey] = $id;
                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
            } else {
                return false;
            }
        } else {

            if ($this->selectIdTwoKeys($id, $id2)) { // Array ( [enchere_id] => 5 [0] => 5 [user_id] => 2 [1] => 2 [prix_offert] => 600 [2] => 600 )
                $data_keys = array_fill_keys($this->fillable, '');
                $data = array_intersect_key($data, $data_keys);

                $fieldName = null;
                foreach ($data as $key => $value) {
                    $fieldName .= "$key = :$key, ";
                }
                $fieldName = rtrim($fieldName, ', ');
                $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey AND $this->secondaryKey = :$this->secondaryKey;";

                $stmt = $this->prepare($sql);
                $data[$this->primaryKey] = $id;
                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
                $data[$this->secondaryKey] = $id2;
                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
            } else {
                return false;
            }


        }
        $stmt->execute();


        $count = $stmt->rowCount();
        if ($count >= 1) {
            return true;
        }
    }

    public function unique($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }
}
