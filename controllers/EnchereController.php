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


        if (isset($_GET) && $_GET != null) {

            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

            $timbre = new Timbre;
/*             $selectTimbres = $timbre->select();
            print_r($selectTimbres); die(); */
            // Array ( [0] => Array ( [id] 
            $selectTimbres = [];
            foreach ($selectEncheres as $key => $value) {
                array_push($selectTimbres, $timbre->selectId($value['timbre_id']));
            }

            $filter = new Filter;
            $filter->field($selectTimbres, $_GET)->min('prix_depart', 'prix_minimum')->max('prix_depart', 'prix_maximum')->min('annee', 'annee_minimum')->max('annee', 'annee_maximum')->present('pays_id', 'pays')->presentArray('etat_conservation_id', 'etat_conservation')->booleen('authentifie', 'authentifie');
            // print_r($filter); die();

            $selectTimbres = [];
            $i = 0;
            $selectTimbres = (array) $filter;
/*             print_r($selectTimbres['array']); die();
            foreach ($filter as $key) {
                foreach ($key as $value) {
                    array_push($value, $selectTimbres);
                }
            } */

            $selectTimbres = $selectTimbres['array'];

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
            $timbre = new Timbre;
            $selectTimbres = $timbre->select();

            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

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

        // print_r($selectTimbres); die();
        if ($selectEncheres) {
            if (isset($_SESSION['user_id'])) {
                echo 'if top not isset';
                die();
                if ($_SESSION['user_id'] == 1) {
                    return View::render('enchere/index', ['encheres' => $selectEncheres]);
                } else {
                    echo 'else after if top not isset';
                    die();
                    return View::render('enchereclient/index', ['images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                }
            } else {
                echo 'else not isset';

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
