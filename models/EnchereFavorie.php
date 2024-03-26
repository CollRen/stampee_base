<?php
namespace App\Models;
use App\Models\CRUD;

class EnchereFavorie extends CRUD{
    protected $table = 'enchere_favorie';
    protected $primaryKey = 'enchere_id';
    protected $secondaryKey = 'user_id';
    protected $isAuth = [1, 2];
    protected $fillable = ['enchere_id', 'user_id', 'est_favorie'];
}

	