<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\Enchere;
use App\Models\EnchereFavorie;
use App\Models\Etat;
use App\Models\Image;
use App\Models\Mise;
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
       
            //print_r($_SERVER);die(); // REDIRECT_URL] => /h24/stampee_base/stampeeFromRecette/enchere
        $REQUEST_URI = '';
        if (isset($_GET) && $_GET != null) {

            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

            $timbre = new Timbre;

            $selectTimbres = [];
            foreach ($selectEncheres as $key => $value) {
                array_push($selectTimbres, $timbre->selectId($value['timbre_id']));
            }

            $filter = new Filter;
            $filter->field($selectTimbres, $_GET)->min('prix_depart', 'prix_minimum')->max('prix_depart', 'prix_maximum')->min('annee', 'annee_minimum')->max('annee', 'annee_maximum')->present('pays_id', 'pays')->presentArray('etat_conservation_id', 'etat_conservation')->booleen('authentifie', 'authentifie');

            $selectTimbres = [];
            $i = 0;
            $selectTimbres = (array) $filter;

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

        /**
         * index des enchères archivées
         */
        if($_SERVER['REQUEST_URI'] == '/h24/stampee_base/stampeeFromRecette/enchere/archive') {
            
            $filter = new Filter;
            $filter->field($selectEncheres)->datePassee('date_limite');
            
            $selectEncheres = [];
            $selectEncheres = (array) $filter;
            $REQUEST_URI = 'archive';
        }

        /**
         * index des enchères favorites 
         * 
         * PAS DU TOUT TRAVAILLER: Il faut pouvoir créer des enchères favorites...
         */
        if($_SERVER['REQUEST_URI'] == '/h24/stampee_base/stampeeFromRecette/enchere/mesencheresfavorites') {

            $enchereFavorie = new EnchereFavorie;
            $selectEnchereFavorie = $enchereFavorie->select();
            
            $selectEncheres = [];
            $selectEncheres = (array) $filter;
            $REQUEST_URI = 'active';
        }

        /**
         * index des enchères préférées
         */
        if($_SERVER['REQUEST_URI'] == '/h24/stampee_base/stampeeFromRecette/enchere/active') {

            $filter = new Filter;
            $filter->field($selectEncheres)->dateActive('date_limite')->datePassee('date_debut');
            
            $selectEncheres = [];
            $selectEncheres = (array) $filter;
            $REQUEST_URI = 'active';
        }

        if ($selectEncheres) {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == 1) {
                    return View::render('enchere/index', ['thisuser' => $_SESSION['user_id'], 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                } else {

                    return View::render('enchereclient/index', ['thisuser' => $_SESSION['user_id'], 'images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                }
            } else {

                return View::render('enchereclient/index', ['encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers, 'images' => $selectImages]);
            }
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {   
        if (isset($data['id']) && $data['id'] != null) {

            $enchere = new Enchere;
            $selectEnchereId = $enchere->selectId($data['id']);

            if ($selectEnchereId) {
                $timbre = new Timbre;
                $selectTimbre = $timbre->selectId($selectEnchereId['timbre_id']);

                $image = new Image;
                $selectImages = $image->selectId($selectEnchereId['timbre_id'], 'timbre_id');

                // print_r($selectImages); die();

                $mise = new Mise;
                $selectMises = $mise->selectId($selectEnchereId['id'], 'enchere_id');

                $filter = new Filter;
                $filter->field($selectMises)->max('prix_offert');

                $selectMises = [];
                $selectMise = (array) $filter;
                $selectMise = $selectMise['array'];

                return View::render('enchere/show', ['thisuser' => $_SESSION['user_id'], 'enchere' => $selectEnchereId, 'timbre' => $selectTimbre, 'images' => $selectImages, 'mise' => $selectMise]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        $enchere = new Enchere;
        $selectEncheres = $enchere->select();

        $timbre = new Timbre;
        $selectTimbres = $timbre->selectId($_SESSION['user_id'], 'user_id');

        $filter = new Filter;
        $filter->field($selectTimbres, $selectEncheres)->absent('id', 'user_id');

        $selectTimbres = (array) $filter;
        $selectTimbres = $selectTimbres['array'];

        return View::render('enchere/create', ['timbres' => $selectTimbres, 'encheres' => $selectEncheres]);
    }

    public function store($data)
    {
        if (empty($data['date_debut'])) array_pop($data);

        $validator = new Validator;
        $validator->field('timbre_id', $data['timbre_id'])->min(1)->max(45)->int()->required();
        $validator->field('date_limite', $data['date_limite'])->max(16)->required();

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

            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

            $timbre = new Timbre;
            $selectTimbres = $timbre->selectId($_SESSION['user_id'], 'user_id');

            $filter = new Filter;
            $filter->field($selectTimbres, $selectEncheres)->absent('id', 'user_id');

            $selectTimbres = (array) $filter;
            $selectTimbres = $selectTimbres['array'];


            return View::render('enchere/create', ['errors' => $errors, 'enchere' => $data, 'timbres' => $selectTimbres, 'encheres' => $selectEncheres]);
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
/*         print_r($data); 
        echo '<br>';
        print_r($get);die(); */
        if (empty($data['date_debut'])) array_pop($data);
        $id = $_GET['id']; // S'il n'y a pas de changement

        $validator = new Validator;

        $validator->field('date_limite', $data['date_limite'])->max(20)->required();

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

    public function archive()
    {


    }

    public function mesencheres()
    {

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

        if ($selectEncheres) {
            if (isset($_SESSION['user_id'])) {
                    return View::render('enchereclient/mesencheres', ['thisuser' => $_SESSION['user_id'], 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);

            } else {

                return View::render('enchereclient/index', ['encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers, 'images' => $selectImages]);
            }
        } else {
            return View::render('error');
        }
    }
}
