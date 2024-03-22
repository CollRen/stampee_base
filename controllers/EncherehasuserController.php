<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\RecetteCategorie;
use App\Models\Timbre;
use App\Models\Pays;
use App\Models\Etat;
use App\Models\Auteur;
use App\Models\Encherehasuser;
use App\Providers\View;
use App\Providers\Validator;
use PharData;

class RecettehasetatController
{

    public function __construct()
    {
        $EnchereHU = new Encherehasuser;
        $arrayAuth = $EnchereHU->isAuth();
        Auth::verifyAcces($arrayAuth);
        JournalStore::store();;
    }

    public function index()
    {

        $timbre = new Timbre;
        $select = $timbre->select();

        $pays = new Pays;
        $selectPays = $pays->select();

        $etat = new Etat;
        $selectEtat = $etat->select();

        $encherehasuser = new Encherehasuser;
        $select = $encherehasuser->select();


        //include('views/encherehasuser/index.php');
        if ($select) {
            return View::render('encherehasuser/index', ['encherehasusers' => $select, 'payss' => $selectPays, 'etats' => $selectEtat]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $encherehasuser = new Encherehasuser;
            $selectId = $encherehasuser->selectId($data['id']);
            if ($selectId) {
                return View::render('encherehasuser/show', ['encherehasuser' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create($data = NULL)
    {


        $data['id'] ? $recette_id = $data['id'] : $recette_id = $data['recette_id'];

        $pays = new Pays;
        $selectPays = $pays->select();

        $etat = new Etat;
        $selectEtat = $etat->select();

        return View::render('encherehasuser/create', ['recette_id' => $recette_id, 'payss' => $selectPays, 'etats' => $selectEtat]);
    }

    public function store($data)
    {


        /*         $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);
        $validator->field('etat_categorie_id', $data['etat_categorie_id'], 'Le ID')->min(1)->max(45);
 */
        if ($data['unite_mesure_id']) {

            $encherehasuser = new Encherehasuser;
            $insert = $encherehasuser->insert($data);


            if ($insert) {

                $pays = new Pays;
                $selectPays = $pays->select();

                $etat = new Etat;
                $selectEtat = $etat->select();
                $selectRHI =  $encherehasuser->select();


                return View::render('encherehasuser/create', ['recette_id' => $data['recette_id'], 'encherehasusers' => $selectRHI, 'payss' => $selectPays, 'etats' => $selectEtat]);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('encherehasuser/create', ['errors' => $errors, 'encherehasuser' => $data]);
        }
    }

    public function edit($data = [])
    {   //print_r($data); die(); // Array ( [recette_id] => 10 [etat_id] => 1 [id] => 25 )

        if (isset($data['id']) && $data['etat_id'] != null) {


            $encherehasuser = new Encherehasuser;
            $selectId = $encherehasuser->selectId($data['id']);
            // print_r($data['id']); die();
            // 25
            //print_r($selectId); die();
            // Array ( [id] => 25 [0] => 25 [recette_id] => 10 [1] => 10 [etat_id] => 1 [2] => 1 [quantite] => 0.5 [3] => 0.5 [unite_mesure_id] => 1 [4] => 1 )
            $pays = new Pays;
            $selectPays = $pays->select();
            // print_r($selectPays); die();
            // Array ( [0] => Array ( [id] => 1 [0] => 1 [nom] => TBS [1] => TBS ) [1] => Array ( [id] => 2 [0] => 2 [nom] => Tbs [1] => Tbs ) [2] => Array ( [id] => 3 [0] => 3 [nom] => ml [1] => ml ) [3] => Array ( [id] => 4 [0] => 4 [nom] => --- [1] => --- ) [4] => Array ( [id] => 5 [0] => 5 [nom] => lb [1] => lb ) [5] => Array ( [id] => 6 [0] => 6 [nom] => gr [1] => gr ) [6] => Array ( [id] => 7 [0] => 7 [nom] => --- [1] => --- ) [7] => Array ( [id] => 8 [0] => 8 [nom] => oz [1] => oz ) [8] => Array ( [id] => 9 [0] => 9 [nom] => Cup [1] => Cup ) )

            $etat = new Etat;
            $selectEtat = $etat->select();
            // print_r($selectEtat); die();
            // Array ( [0] => Array ( [id] => 1 [0] => 1 [nom] => Poulet [1] => Poulet [etat_categorie_id] => 1 [2] => 1 ) [1] => Array ( [id] => 2 [0] => 2 [nom] => Truites [1] => Truites [etat_categorie_id] => 8 [2] => 8 ) [2] => Array ( [id] => 3 [0] => 3 [nom] => Artichauds [1] => Artichauds [etat_categorie_id] => 7 [2] => 7 ) )

            if ($selectId) {
                return View::render('encherehasuser/edit', ['encherehasusers' => $selectId, 'payss' => $selectPays, 'etats' => $selectEtat]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        $data['recette_id'] = $get['recette_id'];

        $validator = new Validator;
        $validator->fieldkeys('etat_id', $data['etat_id'], 'recette_id', $get['recette_id'])->uniquekeys('Encherehasuser');


        
        if ($validator->isSuccess()) {
 
            $encherehasuser = new Encherehasuser;
            $update = $encherehasuser->update($data, $get['id']);

            $timbre = new Timbre;
            $selectId = $timbre->selectId($get['recette_id']);

            if ($update) {
                return View::redirect('timbre/show?id=' . $get['recette_id'] . '&recette_categorie_id=' . $selectId['recette_categorie_id'] . '&auteur_id=' . $selectId['auteur_id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('encherehasuser/edit', ['errors' => $errors, 'encherehasuser' => $data]);
        }
    }

    public function delete($data)
    {
        $encherehasuser = new  Encherehasuser;
        $delete = $encherehasuser->delete($data['recette_id']);
        if ($delete) {
            return true;
            /* return View::redirect('encherehasuser'); */
        } else {
            return View::render('error');
        }
    }
}
