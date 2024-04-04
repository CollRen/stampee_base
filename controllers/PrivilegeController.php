<?php
namespace App\Controllers;

use App\Providers\Auth;

use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;


class PrivilegeController
{

    public function __construct()
    {
        $privilege = new Privilege;
        $arrayAuth = $privilege->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index()
    {
        $privilege = new Privilege;
        $select = $privilege->select();

        //include('views/privilege/index.php');
        if ($select) {
            return View::render('privilege/index', ['privilege' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $privilege = new Privilege;
            $selectId = $privilege->selectId($data['id']);
            if ($selectId) {
                return View::render('privilege/show', ['privilege' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('privilege/create');
    }

    public function store($data)
    {

        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(50);

        if ($validator->isSuccess()) {
            $privilege = new Privilege;
            $insert = $privilege->insert($data);
            if ($insert) {
                return View::redirect('privilege');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('privilege/create', ['errors' => $errors, 'privilege' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $privilege = new Privilege;
            $selectId = $privilege->selectId($data['id']);
            if ($selectId) {
                return View::render('privilege/edit', ['privilege' => $selectId]);
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
            $privilege = new Privilege;
            $update = $privilege->update($data, $get['id']);

            if ($update) {
                return View::redirect('privilege/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('privilege/edit', ['errors' => $errors, 'privilege' => $data]);
        }
    }

    public function delete($data)
    {
        $privilege = new  Privilege;
        $delete = $privilege->delete($data['id']);
        if ($delete) {
            return View::redirect('privilege');
        } else {
            return View::render('error');
        }
    }
}
