<?php

namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;
use App\Models\Image;
use App\Models\Timbre;
use App\Providers\Auth;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Filter;


class MiseController
{

    public function __construct()
    {
        $mise = new Mise;
        $arrayAuth = $mise->isAuth();
        Auth::verifyAcces($arrayAuth);;
    }

    public function index()
    {
        $mise = new Mise;
        $select = $mise->select();

        if ($select) {
            return View::render('mise/index', ['mise' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $mise = new Mise;
            $selectId = $mise->selectId($data['id']);
            if ($selectId) {
                return View::render('mise/show', ['mise' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create($get = [])
    {

        // print_r($get); die();
        $enchere = new Enchere;
        $selectEnchereId = $enchere->selectId($get['enchere_id']);



        // print_r($selectEnchereId); die();

        //Valeur de départ du timbre
        $timbre = new Timbre;
        $selectTimbreId = $timbre->selectId($selectEnchereId['timbre_id']);
        $miseMax = $selectTimbreId['prix_depart'];


        $validator = new Validator;
        $validator->field('date_limite', $selectEnchereId, $get['enchere_id'])->dateActive('date_debut', $selectEnchereId['date_debut']);

        if ($validator->isSuccess()) {
            // echo 'validator succeded'; die();
            $selectMises = [];
            $mise = new Mise;
            $selectMises = $mise->selectId($get['enchere_id'], 'enchere_id');

            // print_r($selectMises); die(); Vide

            //Faire sortir l'enchère la plus élevé
            if ($selectMises) {

                foreach ($selectMises as $selectMise) {
                    if ($selectMise > $miseMax) $miseMax = $selectMise;
                }
                return View::render('mise/create', ['enchere' => $selectEnchereId, 'misemax' => $miseMax]);
            } else {
                // echo 'ici'; die();
                return View::render('mise/create', ['enchere' => $selectEnchereId, 'misemax' => $miseMax]);
            }
        } else {
            if (isset($get['enchere_id']) && $get['enchere_id'] != null) {

                if ($selectEnchereId) {
                    $timbre = new Timbre;
                    $selectTimbre = $timbre->selectId($selectEnchereId['timbre_id']);

                    $image = new Image;
                    $selectImages = $image->selectId($selectEnchereId['timbre_id'], 'timbre_id');

                    $errors = $validator->getErrors();


                    return View::render('enchere/show', ['errors' => $errors, 'thisuser' => $_SESSION['user_id'], 'enchere' => $selectEnchereId, 'timbre' => $selectTimbre, 'images' => $selectImages]);
                } else {

                    return View::render('error');
                }
            } else {

                return View::render('error', ['message' => 'Could not find this data']);
            }
        }
    }

    public function store($data)
    {
        
        $enchere = new Enchere;
        $selectEnchereId = $enchere->selectId($data['enchere_id']);

        $timbre = new Timbre;
        $selectTimbre = $timbre->selectId($selectEnchereId['timbre_id']);

        $miseMax = $selectTimbre['prix_depart'];
        $insert = '';

        

        $validator = new Validator;
        $validator->field('prix_offert', $data)->lower($miseMax);

        if ($validator->isSuccess()) {
            $data['user_id'] = $_SESSION['user_id'];

            $mises = new Mise;
            $selectMises = $mises->selectIdTwoKeys($data['enchere_id'], $data['user_id'], 'enchere_id', 'user_id');
            // echo 'test'; die();
            //print_r($selectMises); die(); // Array ( [enchere_id] => 5 [0] => 5 [user_id] => 2 [1] => 2 [prix_offert] => 600 [2] => 600 )
            if ($selectMises) {
                //echo 'selectMise ok'; die();
                $mise = new Mise;
                $insert = $mise->update($data, $data['enchere_id'], $data['user_id']);
            } else {
                //echo 'selectMise pas ok'; die();
                $mise = new Mise;
                $insert = $mise->insertTwoKeys($data);
            }



            if ($insert) {
                echo 'insert ok';
                return View::redirect('enchere/show?id=' . $data['enchere_id'], ['thisuser' => $_SESSION['user_id'], 'enchere' => $selectEnchereId, 'timbre' => $selectTimbre, 'images' => $selectImages, 'mises' => $selectMises]);
            } else {
                echo 'insert pas ok';
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();


            return View::render('mise/create', ['errors' => $errors, 'mise' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $mise = new Mise;
            $selectId = $mise->selectId($data['id']);
            if ($selectId) {
                return View::render('mise/edit', ['mise' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if ($validator->isSuccess()) {
            $mise = new Mise;
            $update = $mise->update($data, $get['id']);

            if ($update) {
                return View::redirect('mise/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('mise/edit', ['errors' => $errors, 'mise' => $data]);
        }
    }

    public function delete($data)
    {
        $mise = new  Mise;
        $delete = $mise->delete($data['id']);
        if ($delete) {
            return View::redirect('mise');
        } else {
            return View::render('error');
        }
    }
}
