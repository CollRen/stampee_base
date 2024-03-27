<?php
namespace App\Controllers;

use App\Models\ExampleModel;
use App\Models\Timbre;
use App\Models\Enchere;
use App\Models\EnchereFavorie;
use App\Models\User;
use App\Models\Actualite;
use App\Providers\View;

class HomeController {
    
    public function index(){


        /* Pour l'affichage des actualités */
        $timbre = new Timbre;
        $selectTimbre = $timbre->select();

        $enchere = new Enchere;
        $selectEncheres = $enchere->select();

        $actualite = new Actualite;
        $selectActualite = $actualite->select();


        
        for ($i=0; $i < count($selectActualite) ; $i++) { 
            $selectActualite[$i]['date'] = date_format(date_create($selectActualite[$i]['date']), 'Y-m-d'); 
        }
        
        /* Affichage des coups de coeur Lord */

        $enchereFavorie = new EnchereFavorie;
        $selectFavories = $enchereFavorie->select();

        //$selectEncheresFavorie = $enchere->selectIdTwoKeys($selectFavories['enchere_id'], $_SESSION['user_id']);

        //include 'views/home.php';
       View::render('home', ['timbres' => $selectTimbre, 'encheres' => $selectEncheres, 'actualites' => $selectActualite]);
    }

    public function home(){
        $data = 'Hello from HomeController';
        include 'views/home.php';
    }
}