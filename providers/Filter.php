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

    public function field($array, $data = null)
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

    public function max($dbKey, $key = null)
    {
        // print_r($this->array); die(); // Array ( [enchere_id] => 23 [0] => 23 [user_id] => 2 [1] => 2 [prix_offert] => 600 [2] => 600 )
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
        } else {
            if(isset($this->array[1][0])){
                for ($i = 1; $i < count($this->array); $i++) {
                    if ($this->array[$i][$dbKey] > $this->array[$i-1][$dbKey]) {
                        array_push($this->newArray, $this->array[$i]);
                    }
                }
            } else {
            array_push($this->newArray, $this->array);
        }
        $this->array = $this->newArray;
        $this->newArray = [];
    }
    return $this;
}

    public function enleveSiPresent($dbKey, $key)
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

    public function absent($dbKey, $key)
    {
        if (isset($this->data[$key])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if (!$this->array[$i][$dbKey] == $this->data[$key]) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
            $this->newArray = [];
        }
        return $this;
    }

    public function datePassee($key)
    {       $now = date("Y-m-d H:i:s");

        foreach ($this->array as $uneEnchere) {
                    if ($uneEnchere[$key] < $now) {
                        array_push($this->newArray, $uneEnchere);
                    }
                }
            $this->array = $this->newArray;
            $this->newArray = [];
            return $this;
        }

        public function dateActive($key)
    {       $now = date("Y-m-d H:i:s");

        foreach ($this->array as $uneEnchere) {
                    if ($uneEnchere[$key] >= $now) {
                        array_push($this->newArray, $uneEnchere);
                    }
                }
            $this->array = $this->newArray;
            $this->newArray = [];
            return $this;
        }
    }