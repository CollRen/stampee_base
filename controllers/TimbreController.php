<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\Timbre;
use App\Models\User;
use App\Models\Image;
use App\Models\Etat;
use App\Models\TimbreCategorie;
use App\Models\Pays;
use App\Models\Enchere;

use App\Providers\View;
use App\Providers\Validator;
use DateTime;
use Dompdf\Dompdf;


class TimbreController
{

    public function __construct()
    {
        $timbre = new Timbre;
        $arrayAuth = $timbre->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index()

    {

        $timbre = new Timbre;
        $select = $timbre->select();

        $etat = new Etat;
        $selectEtats = $etat->select();

        $timbreCats = new TimbreCategorie;
        $selectCat = $timbreCats->select();

        $user = new User;
        $selectUsers = $user->select();

        $pays = new Pays;
        $selectPays = $pays->select();

        if ($select) {
            return View::render('timbre/index', ['timbres' => $select, 'timbreCats' => $selectCat, 'etats' => $selectEtats, 'payss' => $selectPays, 'users' => $selectUsers]);
        } else {
            return View::render('error');
        }
    }


    public function show($data = [])
    {
       if (isset($data['id']) && $data['id'] != null) {
            $timbre = new Timbre;
            $selectId = $timbre->selectId($data['id']);

            $images = new Image;
            $selectImages = $images->selectId($data['id'], 'timbre_id');

            $pays = new Pays;
            $selectPays = $pays->selectId($selectId['pays_id']);

            $user = new User;
            $selectUser = $user->selectId($selectId['user_id']);
            $userData = ['name' => $selectUser['name'], 'id' => $selectUser['id'], 'email' => $selectUser['email']];

            $timbreCat = new TimbreCategorie;
            $selectCat = $timbreCat->selectId($selectId['timbre_categorie_id']);
            
            $etat = new Etat;
            $selectEtat = $etat->selectId($selectId['etat_conservation_id']);

            $enchere = new Enchere;
            $selectEncheres = $enchere->selectId($data['id'], 'timbre_id');

            $timbreHis[] = '';
            $i = 0;

                return View::render('timbre/show', ['timbre' => $selectId, 'images' => $selectImages , '$pays' => $selectPays['nom'], '$user' => $userData , 'timbreCat' => $selectCat['nom'], 'etat' => $selectEtat['nom'], 'date_limite' => $selectEncheres['date_limite']]);

            } else {

                /* On fait quoi ici */
            }
        }
    



    public function create()
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

        $timbreCategorie = new TimbreCategorie;
        $timbreCategorieSelect = $timbreCategorie->select();

        $timbreEtat = new Etat;
        $timbreEtatSelect = $timbreEtat->select();

        $pays = new Pays;
        $selectPays = $pays->select();

        $enchere = new Enchere;
        $selectEnchere = $enchere->select();


        return View::render('timbre/create', ['timbreCategories' => $timbreCategorieSelect, 'timbreEtats' => $timbreEtatSelect, 'pays' => $selectPays, 'encheres' => $selectEnchere]);
    }


    public function store($data)
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

        $validator = new Validator;
        $validator->field('titre', $data['titre'])->min(2)->max(60)->required();
        $validator->field('description', $data['description'])->max(256)->required();
        $validator->field('temps_preparation', $data['temps_preparation'])->max(4)->number()->required();
        $validator->field('temps_cuisson', $data['temps_cuisson'])->max(4)->number()->required();
        $validator->field('timbre_categorie_id', $data['timbre_categorie_id'])->max(5)->int()->required();
        $validator->field('etat_conservation_id', $data['etat_conservation_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $timbre = new Timbre;
            $insert = $timbre->insert($data);

            if ($insert) {

                $pays = new Pays;
                $selectPays = $pays->select();

                $enchere = new Enchere;
                $selectEnchere = $enchere->select();

                return View::redirect('enchere/create?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {

            $errors = $validator->getErrors();

            $timbreCategorie = new TimbreCategorie;
            $timbreCategorieSelect = $timbreCategorie->select();

            $timbreEtat = new Etat;
            $timbreEtatSelect = $timbreEtat->select();

            return View::render('timbre/create', ['errors' => $errors, 'timbre' => $data, 'timbreCategories' => $timbreCategorieSelect, 'timbreEtats' => $timbreEtatSelect]);
        }
    }


    public function edit($data = [])
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

        if (isset($data['id']) && $data['id'] != null) {
            $timbre = new Timbre;
            $selectId = $timbre->selectId($data['id']);

            $timbreCategorie = new TimbreCategorie;
            $timbreCategorieSelect = $timbreCategorie->select();

            $timbreEtat = new Etat;
            $timbreEtatSelect = $timbreEtat->select();

            if ($selectId) {
                return View::render('timbre/edit', ['timbre' => $selectId, 'timbreCats' => $timbreCategorieSelect, 'etats' => $timbreEtatSelect]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Nous ne trouvons pas ces données']);
        }
    }


    public function update($data, $get)
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

        $validator = new Validator;
        $validator->field('titre', $data['titre'])->min(2)->max(60)->required();
        $validator->field('description', $data['description'])->max(256)->required();
        $validator->field('temps_preparation', $data['temps_preparation'])->max(4)->number()->required();
        $validator->field('temps_cuisson', $data['temps_cuisson'])->max(4)->number()->required();
        $validator->field('timbre_categorie_id', $data['timbre_categorie_id'])->max(5)->int()->required();
        $validator->field('etat_conservation_id', $data['etat_conservation_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $timbre = new Timbre;
            $update = $timbre->update($data, $get['id']);
            if ($update) {
                return View::redirect('timbre/show?id=' . $get['id'] . '&timbre_categorie_id=' . $data['timbre_categorie_id'] . '&etat_conservation_id=' . $data['etat_conservation_id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            $timbreCategorie = new TimbreCategorie;
            $timbreCategorieSelect = $timbreCategorie->select();

            $timbreEtat = new Etat;
            $timbreEtatSelect = $timbreEtat->select();
            return View::render('timbre/create', ['errors' => $errors, 'timbre' => $data, 'timbreCategories' => $timbreCategorieSelect, 'timbreEtats' => $timbreEtatSelect]);
        }
    }


    public function delete($data)
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);


        $timbre = new  Timbre;
        $delete = $timbre->delete($data['id']);
        if ($delete) {
            return View::redirect('timbre');
        } else {
            return View::render('error');
        }
    }

    public function pdf()
    {

        $pageToPrint = file_get_contents($_SERVER['HTTP_REFERER']);



        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pageToPrint);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        //return View::redirect('timbre/pdf');
    }
}
