<?php

namespace App\Controllers;

use App\Providers\Auth;

use App\Models\Pays;
use App\Providers\View;
use App\Providers\Validator;


class PaysController
{

    public function __construct()
    {
        $pays = new Pays;
        $arrayAuth = $pays->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index()
    {
        $pays = new Pays;
        $select = $pays->select();

        //include('views/pays/index.php');
        if ($select) {
            return View::render('pays/index', ['pays' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $pays = new Pays;
            $selectId = $pays->selectId($data['id']);
            if ($selectId) {
                return View::render('pays/show', ['pays' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('pays/create');
    }

    public function store($data)
    {

        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if ($validator->isSuccess()) {
            $pays = new Pays;
            $insert = $pays->insert($data);
            if ($insert) {
                return View::redirect('pays');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('pays/create', ['errors' => $errors, 'pays' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $pays = new Pays;
            $selectId = $pays->selectId($data['id']);
            if ($selectId) {
                return View::render('pays/edit', ['pays' => $selectId]);
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
            $pays = new Pays;
            $update = $pays->update($data, $get['id']);

            if ($update) {
                return View::redirect('pays/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('pays/edit', ['errors' => $errors, 'pays' => $data]);
        }
    }

    public function delete($data)
    {
        $pays = new  Pays;
        $delete = $pays->delete($data['id']);
        if ($delete) {
            return View::redirect('pays');
        } else {
            return View::render('error');
        }
    }
}
