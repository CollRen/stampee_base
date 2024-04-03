<?php

namespace App\Controllers;

use App\Providers\Auth;
use App\Providers\JournalStore;
use App\Models\Couleur;
use App\Providers\View;
use App\Providers\Validator;


class CouleurController
{

    public function __construct()
    {
        $couleur = new Couleur;
        $arrayAuth = $couleur->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index()
    {
        $couleur = new Couleur;
        $select = $couleur->select();

        //include('views/couleur/index.php');
        if ($select) {
            return View::render('couleur/index', ['couleur' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $couleur = new Couleur;
            $selectId = $couleur->selectId($data['id']);
            if ($selectId) {
                return View::render('couleur/show', ['couleur' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('couleur/create');
    }

    public function store($data)
    {

        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if ($validator->isSuccess()) {
            $couleur = new Couleur;
            $insert = $couleur->insert($data);
            if ($insert) {
                return View::redirect('couleur');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('couleur/create', ['errors' => $errors, 'couleur' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $couleur = new Couleur;
            $selectId = $couleur->selectId($data['id']);
            if ($selectId) {
                return View::render('couleur/edit', ['couleur' => $selectId]);
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
            $couleur = new Couleur;
            $update = $couleur->update($data, $get['id']);

            if ($update) {
                return View::redirect('couleur/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('couleur/edit', ['errors' => $errors, 'couleur' => $data]);
        }
    }

    public function delete($data)
    {
        $couleur = new  Couleur;
        $delete = $couleur->delete($data['id']);
        if ($delete) {
            return View::redirect('couleur');
        } else {
            return View::render('error');
        }
    }
}
