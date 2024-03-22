<?php
namespace App\Models;
use App\Models\CRUD;

class TimbreCategorie extends CRUD{
    protected $table = 'timbre_categorie';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2];
    protected $fillable = ['nom'];



}


