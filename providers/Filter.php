<?php

namespace App\Providers;

class Filter
{
    private $array; // Provient de la BD
    private $data = array();  // $_GET
    private $key;
    private $dbKey;
    private $value = array();

    private $newArray = array();

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
}


if (isset($_GET['annee_minimum'])) {
    $annee_minimum = $_GET['annee_minimum'];
    $dataAFiltrer['annee_minimum'] = $annee_minimum;
}
if (isset($_GET['annee_minimum'])) {
    $annee_minimum = $_GET['annee_minimum'];
    $dataAFiltrer['annee_minimum'] = $annee_minimum;
}
if (isset($_GET['pays'])) {
    $pays = $_GET['pays'];
    $dataAFiltrer['pays'] = $pays;
}
if (isset($_GET['etat_conservation'])) {
    $etat_conservation = $_GET['etat_conservation'];
    $dataAFiltrer['etat_conservation'] = $etat_conservation;
}
if (isset($_GET['authentifie'])) {
    $authentifie = $_GET['authentifie'];
    $dataAFiltrer['authentifie'] = $authentifie;
}
