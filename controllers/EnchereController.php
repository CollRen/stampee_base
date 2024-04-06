<?php

namespace App\Controllers;


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
    }

    public function index()
    {
        //Initialisation des filtres afin qu'ils ne filtrent rien
        $get['prix_minimum'] = 0;
        $get['prix_maximum'] = 1000;
        $get['annee_minimum'] = 1850;
        $get['annee_maximum'] = 2025;
        $get['pays'] = 0;
        $get['est_coup_coeur_lord'] = false;
        $get['authentifie'] = 1;
        if (isset($_GET['prix_minimum'])) $get['prix_minimum'] = $_GET['prix_minimum'];
        if (isset($_GET['prix_maximum'])) $get['prix_maximum'] = $_GET['prix_maximum'];
        if (isset($_GET['annee_minimum'])) $get['annee_minimum'] = $_GET['annee_minimum'];
        if (isset($_GET['annee_maximum'])) $get['annee_maximum'] = $_GET['annee_maximum'];
        if (isset($_GET['pays'])) $get['pays'] = $_GET['pays'];
        if (isset($_GET['est_coup_coeur_lord'])) $get['est_coup_coeur_lord'] = $_GET['est_coup_coeur_lord'];
        if (isset($_GET['etat_conservation'])) $get['etat_conservation'] = $_GET['etat_conservation'];
        if (isset($_GET['authentifie'])) $get['authentifie'] = $_GET['authentifie'];
        $REQUEST_URI = '';

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

        $timbre = new Timbre;
        $selectTimbres = $timbre->select();

        /**
         * Lancement des filtres
         */
        if (isset($_GET) && $_GET != null) {

            $selectTimbres = [];
            foreach ($selectEncheres as $key => $value) {
                array_push($selectTimbres, $timbre->selectId($value['timbre_id']));
            }

            $filter = new Filter;
            $filter->field($selectTimbres, $_GET)->min('prix_depart', 'prix_minimum')->max('prix_depart', 'prix_maximum')->min('annee', 'annee_minimum')->max('annee', 'annee_maximum')->present('pays_id', 'pays')->presentArray('etat_conservation_id', 'etat_conservation')->booleen('authentifie', 'authentifie');

            $i = 0;
            $selectTimbres = [];
            $selectTimbres = (array) $filter;
            $selectTimbres = $selectTimbres['array'];
        }

        /**
         * index des enchères archivées
         */
        if (str_contains($_SERVER['REQUEST_URI'], '/archive')) {
            // if ($_SERVER['REQUEST_URI'] == '/h24/stampee_base/stampeeFromRecette/enchere/archive') {

            $filter = new Filter;
            $filter->field($selectEncheres)->datePassee('date_limite');

            $selectEncheres = [];
            $selectEncheres = (array) $filter;
            $selectEncheres = $selectEncheres = $selectEncheres['array'];;
            $REQUEST_URI = 'archive';
        }

        /**
         * index des enchères favorites 
         */
        if (str_contains($_SERVER['REQUEST_URI'], '/favories')) {

            $enchereFavorie = new EnchereFavorie;
            $selectEnchereFavorie = $enchereFavorie->selectId($_SESSION['user_id'], 'user_id');

            $selectEncheres = [];
            if (isset($selectEnchereFavorie[0])) {

                if (!isset($selectEnchereFavorie[0][0])) {
                    $y = $enchere->selectId($selectEnchereFavorie['enchere_id']);
                    array_push($selectEncheres, $y);
                } else {

                    $enchere = new Enchere;
                    $selectEncheres = [];
                    for ($i = 0; $i < count($selectEnchereFavorie); $i++) {

                        $y = $enchere->selectId($selectEnchereFavorie[$i]['enchere_id']);
                        array_push($selectEncheres, $y);
                    }
                }
            } else {

                $message = "Vous n'avez pas de favorie";
            }

            $REQUEST_URI = 'favories';
        }

        /**
         * index des enchères favorites 
         */
        if (str_contains($_SERVER['REQUEST_URI'], '/coupcoeurlord')) {

            $enchere = new Enchere;
            $selectEncheres = $enchere->selectId(1, 'est_coup_coeur_lord');

            $REQUEST_URI = 'coupcoeurlord';
            $get['est_coup_coeur_lord'] = true;
        }

        /**
         * index des enchères préférées
         */
        if (str_contains($_SERVER['REQUEST_URI'], '/active')) {

            $filter = new Filter;
            $filter->field($selectEncheres)->dateActive('date_limite')->datePassee('date_debut');

            $selectEncheres = [];
            $selectEncheres = (array) $filter;

            $selectEncheres = $selectEncheres['array'];
            $REQUEST_URI = 'active';
        }

        if ($selectEncheres) {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == 1) {

                    return View::render('enchere/index', ['thisuser' => $_SESSION['user_id'], 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                } else {

                    if (!isset($get)) {

                        return View::render('enchereclient/index', ['thisuser' => $_SESSION['user_id'], 'images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                    } else {

                        if (!isset($get['etats_conservation'])) {

                            return View::render('enchereclient/index', ['filtrePayss' => $get['pays'], 'filtres' => $get, 'thisuser' => $_SESSION['user_id'], 'images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                        } else {

                            return View::render('enchereclient/index', ['filtrePayss' => $get['pays'], 'etats_conservation' => $get['etat_conservation'], 'filtres' => $get, 'thisuser' => $_SESSION['user_id'], 'images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                        }
                    }
                }
            } else {

                return View::render('enchereclient/index', ['encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers, 'images' => $selectImages]);
            }
        } else {
            if (isset($message)) {
                return View::render('enchereclient/index', ['message' => $message, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers, 'images' => $selectImages]);
            }

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

                $mise = new Mise;
                $selectMise = $mise->selectMax('prix_offert', $selectEnchereId['id'], 'enchere_id');


                $selectMise['prix_offert'] = $selectMise['MAX(prix_offert)'];
                $selectMise['enchere_id'] = $selectEnchereId['id'];

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
        $filter->field($selectTimbres, $selectEncheres)->enleveSiPresent('id', 'timbre_id');

        $selectTimbres = [];
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

            $selectTimbres = [];
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
                echo 'enchereclient/index';
                die();
                return View::render('enchereclient/index', ['encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers, 'images' => $selectImages]);
            }
        } else {
            echo 'dernier else';
            die();
            return View::render('error');
        }
    }

    function ajouteTachePhp($user_id, $enchere_id, $est_favorie)
    {
        $query = "INSERT INTO enchere_favorie (`user_id`, `enchere_id`, `est_favorie`) 
				  VALUES ('" . $user_id . "','" . $enchere_id . "','" . $est_favorie . "')";
        return executeRequete($query, true);
    }

    public function storefavorie()
    {
        $request_payload = file_get_contents('php://input');
        $data = json_decode($request_payload, true);

        if (isset($data['user_id']) && isset($data['enchere_id']) && isset($data['est_favorie'])) {
            $user_id = htmlspecialchars($data['user_id']);
            $enchere_id = htmlspecialchars($data['enchere_id']);
            $est_favorie = htmlspecialchars($data['est_favorie']);

            $query = "INSERT INTO enchere_favorie (`user_id`, `enchere_id`, `est_favorie`) 
				  VALUES ('" . $user_id . "','" . $enchere_id . "','" . $est_favorie . "')";

            $EnchereFavorie = new EnchereFavorie;
            $return_id = $EnchereFavorie->executeRequete($query, true);

            echo $return_id;
        } else {
            echo 'Erreur query string';
        }
    }
}
