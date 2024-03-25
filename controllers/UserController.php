<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Models\User;
use App\Providers\Auth;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;

class UserController
{

    public function __construct()
    {
        $user = new User;
        $arrayAuth = $user->isAuth();
        Auth::verifyAcces($arrayAuth);;
    }

    public function index()
    {

        $user = new User;
        $select = $user->select();

        $privilege = new Privilege;
        $privileges = $privilege->select();

        if ($select) {
            return View::render('user/index', ['users' => $select, 'privileges' => $privileges]);
        } else {
            return View::render('error');
        }
    }


    public function create()
    {

        $privilege = new Privilege;
        $privileges = $privilege->select('nom');
        return View::render('user/create', ['privileges' => $privileges]);
    }




    public function store($data)
    {

        $validator = new Validator;
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->min(2)->max(50)->email()->unique('User');
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('email', $data['email'])->required()->max(100)->email()->unique('User');
        $validator->field('privilege_id', $data['privilege_id'], 'Privilege')->required();


        if ($validator->isSuccess()) {
            $user = new User;

            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('nom');
            return View::render('user/edit', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
        }
    }

    public function edit($data)
    {  
        if (isset($data['id']) && $data['id'] != null) {
        $user = new User;
        $selectId = $user->selectId($data['id']);

        $validator = new Validator;
        $validator->field('name', $selectId['name'])->min(2)->max(50);
        $validator->field('username', $selectId['username'])->min(2)->max(50)->email()->unique('User');
        $validator->field('password', $selectId['password'])->min(6)->max(20);
        $validator->field('email', $selectId['email'])->required()->max(100)->email()->unique('User');
        $validator->field('privilege_id', $selectId['privilege_id'], 'Privilege')->required();

/* Rendu ici */
        if ($validator->isSuccess()) {
            $user = new User;

            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('nom');
            return View::render('user/edit', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
        }
    }}

    public function show($data = [])
    {

        if (isset($data['id']) && $data['id'] != null) {
            $user = new User;
            $selectId = $user->selectId($data['id']);
            if ($selectId) {
                /* Array ( [id] => 1 [0] => 1 [name] => admin [1] => admin [username] => admin@me.com [2] => admin@me.com [password] => $2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy [3] => $2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy [email] => admin@me.com [4] => admin@me.com [privilege_id] => 1 [5] => 1 ) */
                return View::render('user/show', ['user' => $selectId]);
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
            $user = new User;
            $update = $user->update($data, $get['id']);

            if ($update) {
                return View::redirect('user/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('user/edit', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function delete($data)
    {
        $user = new  User;
        $delete = $user->delete($data['id']);
        if ($delete) {
            return View::redirect('user');
        } else {
            return View::render('error');
        }
    }
}
