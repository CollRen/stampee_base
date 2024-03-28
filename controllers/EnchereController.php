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

        if ($selectEncheres) {
            if(isset($_SESSION['user_id'])){
                if($_SESSION['user_id'] == 1) {
                    return View::render('enchere/index', ['encheres' => $selectEncheres]);
                } else{
                    return View::render('enchereclient/index', ['images' => $selectImages, 'encheres' => $selectEncheres, 'timbres' => $selectTimbres, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
                }

            } else{
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
}
