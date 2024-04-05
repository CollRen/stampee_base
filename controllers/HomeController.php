<?php

namespace App\Controllers;


use App\Models\Timbre;
use App\Models\Enchere;
use App\Models\EnchereFavorie;
use App\Models\Image;
use App\Models\Mise;
use App\Models\User;
use App\Models\Actualite;
use App\Providers\View;

class HomeController
{

    public function index()
    {

        /* Pour l'affichage des actualités */
        $timbre = new Timbre;
        $selectTimbre = $timbre->select();

        $enchere = new Enchere;
        $selectEncheres = $enchere->selectId(1, 'est_coup_coeur_lord');

        $mise = new Mise;
        $selectMises = $mise->select();

        $actualite = new Actualite;
        $selectActualite = $actualite->select();

        $image = new Image;
        $selectImages = $image->select();

        for ($i = 0; $i < count($selectActualite); $i++) {
            $selectActualite[$i]['date'] = date_format(date_create($selectActualite[$i]['date']), 'Y-m-d');
        }


        /* Pour l'affichage des coups de coeur Lord */
        $enchereFavorie = new EnchereFavorie;
        $selectFavories = $enchereFavorie->select();



        for ($i = 0; $i < count($selectEncheres); $i++) {
            $selectEncheres[$i]['date_limite'] = date("m.d.y");
        }

        /**
         * Ajouter à $selectEncheres le prix_depart du timbre
         */
        for ($i = 0; $i < count($selectEncheres); $i++) {

            for ($y = 0; $y < count($selectTimbre); $y++) {
                if ($selectEncheres[$i]['timbre_id'] == $selectTimbre[$y]['id']) {
                    $selectEncheres[$i]['prix'] = $selectTimbre[$y]['prix_depart'];
                }
            }
        }

        
        // echo '<pre>';
        // print_r($selectEncheres[0]['id']); die();

        // echo '<pre>';
        // print_r($selectMises[0]['enchere_id']); die();

        // && $selectEncheres[$y]['prix'] < $selectMises[$i]['prix_offert']

        // print_r($selectEncheres[0]); die();


        // Ajoute la valeur maximal des mises sur une enchère, s'il y a une ou des mises.
        for ($i = 0; $i < count($selectEncheres); $i++) {
            $miseMax = $mise->selectMax('prix_offert', $selectEncheres[$i]['id'], 'enchere_id');

            if($miseMax[0] != '') $selectEncheres[$i]['prix'] = $miseMax[0] ;
        }






        //include 'views/home.php';
        View::render('home/index', ['mises' => $selectMises, 'images' => $selectImages, 'timbres' => $selectTimbre, 'encheres' => $selectEncheres, 'actualites' => $selectActualite]);
    }

    public function home()
    {
        $data = 'Hello from HomeController';
        include 'views/home.php';
    }
}
