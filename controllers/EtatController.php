<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Providers\Auth;
use App\Models\Etat;
use App\Providers\View;
use App\Providers\Validator;


class EtatController
{

    public function __construct()
    {
        $etat = new Etat;
        $arrayAuth = $etat->isAuth();
        Auth::verifyAcces($arrayAuth);
        
    }

    public function index()
    {
        $etat = new Etat;
        $select = $etat->select();

        if ($select) {
            return View::render('etat/index', ['etats' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $etat = new Etat;
            $selectId = $etat->selectId($data['id']);

            if ($selectId) {
                return View::render('etat/show', ['etat' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('etat/create');
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(45);



        if ($validator->isSuccess()) {

            $etat = new Etat;
            $insert = $etat->insert($data);

            if ($insert) {
                return View::redirect('etat');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('etat/create', ['errors' => $errors, 'etat' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $etat = new Etat;
            $selectId = $etat->selectId($data['id']);
            if ($selectId) {
                return View::render('etat/edit', ['etat' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        // $get['id'];
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->max(45);


        if ($validator->isSuccess()) {
            $etat = new Etat;
            $update = $etat->update($data, $get['id']);

            if ($update) {
                return View::redirect('etat/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            
            return View::render('etat/edit', ['errors' => $errors, 'etat' => $data]);
        }
    }

    public function delete($data)
    {
        $etat = new  Etat;
        $delete = $etat->delete($data['id']);
        if ($delete) {
            return View::redirect('etat');
        } else {
            return View::render('error');
        }
    }
}
