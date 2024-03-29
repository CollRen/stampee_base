<?php

namespace App\Providers;

class Filter
{
    private $array;
    private $data = array();
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
    {   print_r($this->data);
        echo '<br><br>';
        if (isset($this->data[$key])) {
            for ($i = 0; $i < count($this->array); $i++) {
                echo $this->array[$i][$dbKey];
                echo '<br>';
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
