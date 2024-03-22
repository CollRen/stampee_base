<?php
namespace App\Models;
use App\Models\CRUD;

class Enchere extends CRUD{
    protected $table = 'enchere';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2, 3];
    protected $fillable = ['nom', 'timbre_id', 'mise_max', 'date_limite'];
}

	