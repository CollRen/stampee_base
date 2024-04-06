<?php
namespace App\Models;
use App\Models\CRUD;

class Actualite extends CRUD{
    protected $table = 'actualite';
    protected $primaryKey = 'id';
    protected $isAuth = [1];
    protected $fillable = ['text', 'date'];
}


