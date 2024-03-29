<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\Enchere;
use App\Models\Etat;
use App\Models\Image;
use App\Models\TimbreCategorie;
use App\Models\User;
use App\Models\Pays;
use App\Models\Timbre;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Filter;


class EnchereController
{

    public function __construct()
    {
        $enchere = new Enchere;
        $arrayAuth = $enchere->isAuth();
        //Auth::verifyAcces($arrayAuth);
    }

    public function index()
    {

        //Array ( [prix_minimum] => 500 [prix_maximum] => 500 [annee_minimum] => 1925 [annee_maximum] => 1925 [pays] => 3 [etat_conservation] => 1 [authentifie] => 1 )
        $timbre = new Timbre;
        $selectTimbres = $timbre->select();
        $filteredDataA = [];

        if (isset($_GET) && $_GET != null) {
            $dataAFiltrer = [];
            $filter = new Filter;
            $filter->field($selectTimbres, $_GET)->min('prix_depart', 'prix_minimum')->max('prix_depart','prix_maximum')->min('annee', 'annee_minimum')->max('annee', 'annee_maximum')->present('pays_id', 'pays');

            print_r($filter); die();

            if (isset($_GET['prix_minimum'])) {
                $prix_minimum = $_GET['prix_minimum'];
                $dataAFiltrer['prix_minimum'] = $prix_minimum;
            }
            if (isset($_GET['prix_maximum'])) {
                $prix_maximum = $_GET['prix_maximum'];
                $dataAFiltrer['prix_maximum'] = $prix_maximum;
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
            $y = 0;




            for ($i = 0; $i < count($selectTimbres); $i++) {
                if (isset($dataAFiltrer['prix_minimum'])) {

                    if ($selectTimbres[$i]['prix_depart'] > $dataAFiltrer['prix_minimum']) {
                        array_push($filteredDataA, $selectTimbres[$i]);
                    }
                }
            }

            $filteredDataB = [];
            for ($i = 0; $i < count($filteredDataA); $i++) {
                if (isset($dataAFiltrer['prix_maximum'])) {

                    if ($filteredDataA[$i]['prix_depart'] < $dataAFiltrer['prix_maximum']) {
                        array_push($filteredDataB, $filteredDataA[$i]);
                    }
                }
            }
            print_r($filteredDataB);
            die();
            unset($filteredDataA);

            // Ça va prendre la pays Id
            $filteredDataA = [];
            for ($i = 0; $i < count($filteredDataB); $i++) {
                if (isset($dataAFiltrer['pays'])) {

                    if ($filteredDataB[$i]['pays'] == $dataAFiltrer['pays']) {
                        array_push($filteredDataA, $filteredDataB[$i]);
                    }
                }
            }
            print_r($filteredDataA);
            die();






            /* Array ( [prix_minimum] => 200 [prix_maximum] => 750 [annee_minimum] => 1925 [pays] => 4 [etat_conservation] => Array ( [0] => 3 [1] => 4 [2] => 5 ) [authentifie] => 2 ) */



            // Il serait bien de filtrer selon la date de fin de l'enchère
            // Prix minimum et prix maximum
            $enchere = new Enchere;
            $selectEncheres = $enchere->select();


            // print_r($select); die();

            $etat = new Etat;
            $selectEtats = $etat->select();

            $timbreCats = new TimbreCategorie;
            $selectCat = $timbreCats->select();

            $user = new User;
            $selectUsers = $user->select();

            $pays = new Pays;
            $selectPays = $pays->select();

            $image = new Image;
            $selectImages = $image->select();
        } else {
            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

            $timbre = new Timbre;
            $selectTimbres = $timbre->select();
            // print_r($select); die();

            $etat = new Etat;
            $selectEtats = $etat->select();

            $timbreCats = new TimbreCategorie;
            $selectCat = $timbreCats->select();

            $user = new User;
            $selectUsers = $user->select();

            $pays = new Pays;
            $selectPays = $pays->select();

            $image = new Image;
            $selectImages = $image->select();
        }

        if ($selectEncheres) {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == 1) {
                    return View::render('enchere/index', ['encheres' => $selectEncheres]);
                } else {
                    return View::render('enchereclient/index', ['images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                }
            } else {
                return View::render('enchereclient/index', ['encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
            }
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {

            $enchere = new Enchere;
            $selectId = $enchere->selectId($data['id']);

            if ($selectId) {
                $timbre = new Timbre;
                $select = $timbre->select();
                return View::render('enchere/show', ['enchere' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {

        $timbre = new Timbre;
        $select = $timbre->select();
        return View::render('enchere/create', ['timbres' => $select]);
    }

    public function store($data)
    {

        $validator = new Validator;

        $validator->field('timbre_id', $data['timbre_id'])->min(1)->max(45)->int()->required();

        if ($validator->isSuccess()) {
            $enchere = new Enchere;
            $insert = $enchere->insert($data);
            if ($insert) {
                return View::redirect('enchere');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $timbre = new Timbre;
            $select = $timbre->select();
            return View::render('enchere/create', ['errors' => $errors, 'enchere' => $data]);
        }
    }

    public function edit($data = [])
    {
        $arrayCanEnter = [1, 2];
        Auth::verifyAcces($arrayCanEnter);
        if (isset($data['id']) && $data['id'] != null) {
            $enchere = new Enchere;
            $selectId = $enchere->selectId($data['id']);
            if ($selectId) {
                $timbre = new Timbre;
                $select = $timbre->select();

                return View::render('enchere/edit', ['enchere' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        $id = $_GET['id']; // S'il n'y a pas de changement

        $validator = new Validator;

        $validator->field('date_limite', $data['date_limite'])->min(1)->max(10)->required();

        if ($validator->isSuccess()) {
            $enchere = new Enchere;
            $update = $enchere->update($data, $get['id']);

            if ($update) {
                return View::redirect('enchere/show?id=' . $get['id']);
            } else {
                return View::redirect('enchere/show?id=' . $id);
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('enchere/edit', ['errors' => $errors, 'enchere' => $data]);
        }
    }

    public function delete($data)
    {
        $enchere = new  Enchere;
        $delete = $enchere->delete($data['id']);
        if ($delete) {
            return View::redirect('enchere');
        } else {
            return View::render('error');
        }
    }

    public function filtre($data)
    {
        print_r($data);
        die();
    }
}
