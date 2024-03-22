<?php
namespace App\Models;
use App\Models\CRUD;

class Pays extends CRUD{
    protected $table = 'pays';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2];
    protected $fillable = ['nom'];
}


