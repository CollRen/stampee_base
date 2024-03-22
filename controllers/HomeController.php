<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Providers\Auth;
use App\Models\Timbre;
use App\Models\Etat;
use App\Models\TimbreCategorie;
use App\Providers\View;
use App\Providers\Validator;


class HomeController
{

    public function __construct()
    {
        
    }
    public function index()
    {
        $timbre = new Timbre;
        $select = $timbre->select();

        $etat = new Etat;
        $selectEtats = $etat->select();

        $timbreCats = new TimbreCategorie;
        $selectCat = $timbreCats->select();
        
        //include('views/timbre/index.php');
        if ($select) {
            return View::render('timbre/index', ['timbres' => $select, 'timbreCats' => $selectCat, 'etats' => $selectEtats]);
        } else {
            return View::render('error');
        }
    }
}
