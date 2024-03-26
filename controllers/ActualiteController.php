<?php

namespace App\Controllers;

use App\Providers\Auth;
use App\Models\Actualite;
use App\Providers\View;
use App\Providers\Validator;


class ActualiteController
{

    public function __construct()
    {
        $actualite = new Actualite;
        $arrayAuth = $actualite->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index()
    {
        $actualite = new Actualite;
        $select = $actualite->select();

        //include('views/actualite/index.php');
        if ($select) {
            return View::render('actualite/index', ['actualites' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $actualite = new Actualite;
            $selectId = $actualite->selectId($data['id']);
            if ($selectId) {
                return View::render('actualite/show', ['actualite' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('actualite/create');
    }

    public function store($data)
    {

        $validator = new Validator;
        $validator->field('text', $data['text'])->min(2)->max(45);

        if ($validator->isSuccess()) {
            $actualite = new Actualite;
            $insert = $actualite->insert($data);
            if ($insert) {
                return View::redirect('actualite');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('actualite/create', ['errors' => $errors, 'actualites' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $actualite = new Actualite;
            $selectId = $actualite->selectId($data['id']);
            if ($selectId) {
                return View::render('actualite/edit', ['actualite' => $selectId]);
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
        $validator->field('text', $data['text'])->min(2)->max(45);

        if ($validator->isSuccess()) {
            $actualite = new Actualite;
            $update = $actualite->update($data, $get['id']);

            if ($update) {
                return View::redirect('actualite/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('actualite/edit', ['errors' => $errors, 'actualite' => $data]);
        }
    }

    public function delete($data)
    {
        $actualite = new  Actualite;
        $delete = $actualite->delete($data['id']);
        if ($delete) {
            return View::redirect('actualite');
        } else {
            return View::render('error');
        }
    }
}
