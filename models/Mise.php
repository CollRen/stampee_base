<?php
namespace App\Models;
use App\Models\CRUD;

class Mise extends CRUD{
    protected $table = 'mise';
    protected $primaryKey = 'enchere_id';
    protected $secondaryKey = 'user_id';
    protected $isAuth = [1, 2];
    protected $fillable = ['echere_id', 'user_id', 'prix_offert'];
}