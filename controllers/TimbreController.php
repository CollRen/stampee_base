<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\Timbre;
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

        if ($select) {
            return View::render('timbre/index', ['timbres' => $select, 'timbreCats' => $selectCat, 'etats' => $selectEtats]);
        } else {
            return View::render('error');
        }
    }


    public function show($data = [])
    {       // id vaut pour timbre_id
        if (isset($data['id']) && $data['id'] != null) {
            $timbre = new Timbre;
            $selectId = $timbre->selectId($data['id']);
            $timbreCat = new TimbreCategorie;
            $selectCatId = $timbreCat->selectId($data['timbre_categorie_id']);

            $etat = new Etat;
            $selectEtatId = $etat->selectId($data['etat_id']);

            $pays = new Pays;
            $selectPays = $pays->select();

            $enchere = new Enchere;
            $selectEncheres = $enchere->select();

            $timbrehasenchere = new Timbrehasenchere;
            $selectRHI = $timbrehasenchere->selectId($data['id'], 'timbre_id');



            $timbreHis[] = '';
            $i = 0;

            // Préparer l'affichage Timbre à 1 ingrédient
            if (is_array($selectRHI) && isset($selectRHI['id'])) {
                $nomEncheres = $enchere->selectId($selectRHI['enchere_id']);
                $nomPays = $pays->selectId($selectRHI['unite_mesure_id']);
                $nomEncheres = $enchere->selectId($selectRHI['enchere_id']);
                $timbreHis = ['quantite' => $selectRHI['quantite'], 'id' => $selectRHI['id'], 'timbre_id' => $selectRHI['timbre_id'], 'unite_mesure_id' => $selectRHI['unite_mesure_id'], 'enchere_id' => $selectRHI['enchere_id'], 'unite_mesure_nom' => $nomPays['nom'], 'enchere_nom' => $nomEncheres['nom']];
                return View::render('timbre/show', ['timbre' => $selectId, 'timbreCat' => $selectCatId, 'etat' => $selectEtatId, 'timbrehasenchere' => $timbreHis, 'encheres' => $selectEncheres, 'pays' => $selectPays]);

                // Préparer l'affichage Timbre à 2 ingrédients
            } elseif (isset($selectRHI[0][0])) {
                foreach ($selectRHI as $row) {

                    $nomEncheres[$i] = $enchere->selectId($row['enchere_id']);
                    $nomPays[$i] = $pays->selectId($row['unite_mesure_id']);
                    $nomEncheres[$i] = $enchere->selectId($row['enchere_id']);
                    $timbreHis[$i] = ['quantite' => $row['quantite'], 'id' => $row['id'], 'timbre_id' => $row['timbre_id'], 'unite_mesure_id' => $row['unite_mesure_id'], 'enchere_id' => $row['enchere_id'], 'unite_mesure_nom' => $nomPays[$i]['nom'], 'enchere_nom' => $nomEncheres[$i]['nom']];
                    $i++;
                };
                return View::render('timbre/show', ['timbre' => $selectId, 'timbreCat' => $selectCatId, 'etat' => $selectEtatId, 'timbrehasencheres' => $timbreHis, 'encheres' => $selectEncheres, 'pays' => $selectPays]);

                // Préparer l'affichage d'une Timbre qui n'a pas ingrédient
            } else {

                return View::render('timbre/show', ['timbre' => $selectId, 'timbreCat' => $selectCatId, 'etat' => $selectEtatId]);
            }
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

        $timbrehasenchere = new Timbrehasenchere;
        $selectRHI = $timbrehasenchere->select();



        return View::render('timbre/create', ['timbreCategories' => $timbreCategorieSelect, 'timbreEtats' => $timbreEtatSelect, 'timbrehasencheres' => $selectRHI, 'pays' => $selectPays, 'encheres' => $selectEnchere]);
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
        $validator->field('etat_id', $data['etat_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $timbre = new Timbre;
            $insert = $timbre->insert($data);

            if ($insert) {

                //On enregristre un premier ingrédient ici ?
                /*             $timbreHasI = new Timbrehasenchere;
            $insertHasI = $timbreHasI->insert($data); */

                $pays = new Pays;
                $selectPays = $pays->select();

                $enchere = new Enchere;
                $selectEnchere = $enchere->select();

                return View::redirect('timbrehasenchere/create?id=' . $insert);
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
        $validator->field('etat_id', $data['etat_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $timbre = new Timbre;
            $update = $timbre->update($data, $get['id']);
            if ($update) {
                return View::redirect('timbre/show?id=' . $get['id'] . '&timbre_categorie_id=' . $data['timbre_categorie_id'] . '&etat_id=' . $data['etat_id']);
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

        $timbrehasenchere = new Timbrehasenchere;
        $selectRHI = $timbrehasenchere->select();

        $i = 0;
        foreach ($selectRHI as $row) {
            if ($row['timbre_id'] == $data['id']) {
                $RHIdelete = $timbrehasenchere->delete($row['timbre_id']);
            }
        }


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
