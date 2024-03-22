<?php
namespace App\Models;
use App\Models\CRUD;

class Image extends CRUD{
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2];
    protected $fillable = ['nom', 'est_principale', 'adresse', 'timbre_id'];
}

	