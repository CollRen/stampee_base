<?php

namespace App\Controllers;

use App\Providers\Auth;
use App\Models\EnchereFavorie;
use App\Models\Enchere;
use App\Models\User;
use App\Models\Timbre;
use App\Providers\View;
use App\Providers\Validator;


class EnchereFavorieController
{

    public function __construct()
    {
        $enchereFavorie = new EnchereFavorie;
        $arrayAuth = $enchereFavorie->isAuth();
        Auth::verifyAcces($arrayAuth);
    }

    /* Affiche la liste des enchères favories de cet usager */
    public function index()
    {
        $enchereFavorie = new EnchereFavorie;
        $selectFavories = $enchereFavorie->select();

        /* Faire sortir toutes les enchères
            Éventuellement filtrer pour ne faire ressortir que celles de cet utilisateur
        */
        $enchere = new Enchere;
        for ($i=0; $i < count($selectFavories) ; $i++) { 
                    $selectEnchere = $enchere->selectId($selectFavories[$i]['enchere_id']);
                    $selectEncheres[$i] = [$selectEnchere];
        }
        print_r($selectEncheres); die();

        $user = new User;
        $selectUser = $user->selectId($selectFavories['user_id']);

        print_r($_SESSION['user_id']); die();
        if($selectFavories['user_id'] == $_SESSION['user_id']){
            echo 'YO';
        }



        if ($selectFavories) {
            return View::render('enchereFavorie/index', ['enchereFavories' => $selectFavories, 'encheres' => $selectEnchere, 'user' => $selectUser,]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {   
        if (isset($data['id']) && $data['id'] != null) {

            $enchereFavorie = new EnchereFavorie;
            $selectFavoriesId = $enchereFavorie->selectId($data['id']);

            if ($selectFavoriesId) {
                $timbre = new Timbre;
                $selectFavories = $timbre->select();
                return View::render('enchereFavorie/show', ['enchereFavorie' => $selectFavoriesId]);
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
        $selectFavories = $timbre->select();
        return View::render('enchereFavorie/create', ['timbres' => $selectFavories]);
    }

    public function store($data)
    {

        $validator = new Validator;

        $validator->field('timbre_id', $data['timbre_id'])->min(1)->max(45)->int()->required();

        if ($validator->isSuccess()) {
            $enchereFavorie = new EnchereFavorie;
            $insert = $enchereFavorie->insert($data);
            if ($insert) {
                return View::redirect('enchereFavorie');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $timbre = new Timbre;
            $selectFavories = $timbre->select();
            return View::render('enchereFavorie/create', ['errors' => $errors, 'enchereFavorie' => $data]);
        }
    }

    public function edit($data = [])
    {
        $arrayCanEnter = [1, 2];
        Auth::verifyAcces($arrayCanEnter);
        if (isset($data['id']) && $data['id'] != null) {
            $enchereFavorie = new EnchereFavorie;
            $selectFavoriesId = $enchereFavorie->selectId($data['id']);
            if ($selectFavoriesId) {
                $timbre = new Timbre;
                $selectFavories = $timbre->select();

                return View::render('enchereFavorie/edit', ['enchereFavorie' => $selectFavoriesId]);
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

        $validator->field('date_limite', $data['date_limite'])->max(20)->required();

        if ($validator->isSuccess()) {
            $enchereFavorie = new EnchereFavorie;
            $update = $enchereFavorie->update($data, $get['id']);

            if ($update) {
                return View::redirect('enchereFavorie/show?id=' . $get['id']);
            } else {
                return View::redirect('enchereFavorie/show?id=' . $id);
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('enchereFavorie/edit', ['errors' => $errors, 'enchereFavorie' => $data]);
        }
    }

    public function delete($data)
    {
        $enchereFavorie = new  EnchereFavorie;
        $delete = $enchereFavorie->delete($data['id']);
        if ($delete) {
            return View::redirect('enchereFavorie');
        } else {
            return View::render('error');
        }
    }
}
