<?php

namespace App\Models;
use App\Models\CRUD;


use App\Providers\Auth;
use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;


class Journal extends CRUD{
    protected $table = 'journal';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2];
    protected $fillable = ['mise_user_id', 'mise_enchere_id'];
}

