<?php
namespace App\Models;
use App\Models\CRUD;

class Etat extends CRUD{
    protected $table = 'etat_conservation';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2];
    protected $fillable = ['nom'];
}


