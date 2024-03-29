<?php

namespace App\Providers;

class Filter
{
    private $key;
    private $value = array();
    private $array;
    private $newArray = array();

    public function field($array, $value = null)
    {
        $this->value = $value;
        $this->array = $array;

        return $this;
    }

    public function min()
    {
        if (isset($this->value['prix_minimum'])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if ($this->array[$i]['prix_depart'] > $this->value['prix_minimum']) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
        }
        return $this->array;
    }

    public function max()
    {
        if (isset($this->value['prix_maximum'])) {
            for ($i = 0; $i < count($this->array); $i++) {
                if ($this->array[$i]['prix_depart'] > $this->value['prix_maximum']) {
                    array_push($this->newArray, $this->array[$i]);
                }
            }
            $this->array = $this->newArray;
        }
        return $this->array;
    }
}
