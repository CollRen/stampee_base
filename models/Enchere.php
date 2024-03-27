<?php
namespace App\Models;
use App\Models\CRUD;

class Enchere extends CRUD{
    protected $table = 'enchere';
    protected $primaryKey = 'id';
    protected $isAuth = [0, 1, 2, 3];
    protected $fillable = ['date_limite', 'date_debut', 'timbre_id'];
}

	