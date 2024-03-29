<?php

namespace App\Providers;

class Filter
{
    public $array; // Provient de la BD
    public $data = array();  // $_GET
    public $key;
    public $dbKey;
    public $value = array();

    public $newArray = array();

    public function field($array, $data)
    {
        $this->array = $array;
        $this->data = $data;

        return $this;
    }

    public function min($dbKey, $key)
    {
        if (isset($this->data[$key])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if ($dbKey == 'annee') {
                    $this->array[$i][$dbKey] = substr($this->array[$i][$dbKey], 0, 4);
                }
                if ($this->array[$i][$dbKey] > $this->data[$key]) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }

    public function max($dbKey, $key)
    {
        if (isset($this->data[$key])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if ($dbKey == 'annee') {
                    $this->array[$i][$dbKey] = substr($this->array[$i][$dbKey], 0, 4);
                }
                if ($dbKey == 'annee') date('Y', $this->array[$i][$dbKey]);
                if ($this->array[$i][$dbKey] < $this->data[$key]) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }

    public function present($dbKey, $key)
    {
        if (isset($this->data[$key])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if ($this->array[$i][$dbKey] == $this->data[$key]) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }

    public function presentArray($dbKey, $key)
    {

        if (isset($this->data[$key])) {

            foreach ($this->data[$key] as $id) {
                for ($i = 0; $i < count($this->array); $i++) {
                    if ($this->array[$i][$dbKey] == $id) {
                        array_push($this->newArray, $this->array[$i]);
                    }
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }

    public function booleen($dbKey, $key)
    {

        if (isset($this->data[$key])) {
            if ($this->data[$key] == 2) return $this;
            for ($i = 0; $i < count($this->array); $i++) {
                if ($this->array[$i][$dbKey] == $this->data[$key]) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }
}