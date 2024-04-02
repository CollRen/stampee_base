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
        $get['thisMise'] = 1;

        $enchere = new Enchere;
        $selectEnchereId = $enchere->selectId($get['enchere_id']);

        $validator = new Validator;
        $validator->field('date_limite', $selectEnchereId, $get['enchere_id'])->dateActive('date_debut', $selectEnchereId['date_debut']);

        if ($validator->isSuccess()) {
            return View::render('mise/create', ['enchere' => $selectEnchereId, 'offre' => $get['offre']]);
        } else {
            if (isset($get['enchere_id']) && $get['enchere_id'] != null) {

                $enchere = new Enchere;
                $selectEnchereId = $enchere->selectId($get['enchere_id']);

                if ($selectEnchereId) {
                    $timbre = new Timbre;
                    $selectTimbre = $timbre->selectId($selectEnchereId['timbre_id']);

                    $image = new Image;
                    $selectImages = $image->selectId($selectEnchereId['timbre_id'], 'timbre_id');

                    $errors = $validator->getErrors();


                    return View::render('enchere/show', ['errors' => $errors, 'thisuser' => $_SESSION['user_id'], 'enchere' => $selectEnchereId, 'timbre' => $selectTimbre, 'images' => $selectImages, 'thisMise' => $get['thisMise']]);
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

        $validator = new Validator;
        $validator->field('date_limite', $selectEnchereId, $get['enchere_id'])->dateActive('date_debut', $selectEnchereId['date_debut']);

        if ($validator->isSuccess()) {
            $mise = new Mise;
            $insert = $mise->insert($data);
            if ($insert) {
                return View::redirect('mise');
            } else {
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
