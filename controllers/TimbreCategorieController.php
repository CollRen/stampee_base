<?php
namespace App\Controllers;


use App\Providers\Auth;
use App\Models\TimbreCategorie;
use App\Providers\View;
use App\Providers\Validator;


class TimbreCategorieController {

    public function __construct() {
        $timbreCategorie = new TimbreCategorie;
        $arrayAuth = $timbreCategorie->isAuth();
        Auth::verifyAcces($arrayAuth);
        ;
    }

    public function index(){
        $categorie = new TimbreCategorie;
        $select = $categorie->select();
        
        //include('views/categorie/index.php');
        if($select){
            return View::render('categorie/index', ['categories' => $select]);
        }else{
            return View::render('error');
        }    
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $categorie = new TimbreCategorie;
            $selectId = $categorie->selectId($data['id']);
            if($selectId){
                return View::render('categorie/show', ['categorie' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }

    public function create(){
        return View::render('categorie/create');
    }

    public function store($data){
        
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);


        if($validator->isSuccess()){
            $categorie = new TimbreCategorie;
            $insert = $categorie->insert($data);        
            if($insert){
                return View::redirect('categorie');
            }else{
                return View::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            
            return View::render('categorie/create', ['errors'=>$errors, 'categorie' => $data]);
        }
    }

    public function edit($data = []){
        // print_r($data); die();
        if(isset($data['id']) && $data['id']!=null){
            $categorie = new TimbreCategorie;
            $selectId = $categorie->selectId($data['id']);

            if($selectId){
                return View::render('categorie/edit', ['categorie' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }
    public function update($data, $get){
        $categorie = new TimbreCategorie;
        $selectId = $categorie->selectId($get['id']);

/*         echo '$data:<br>';
        print_r($data);
        echo '$get:<br>';
        print_r($selectId);
        die(); */ // $data c'est newValue et $selectId oldValue

        if($selectId){
        $oldValue = $selectId['nom'];
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(45)->changeCheck($oldValue);



        if($validator->isSuccess()){
                // Importer TimbreCategorie pour validator s'il y a un changement ou pas dans la bd-> faudra ajouter un bouton pour revenir à la timbre
                $categorie = new TimbreCategorie;
                $update = $categorie->update($data, $get['id']);

                if($update){
                    return View::redirect('categorie/show?id='.$get['id']);
                }else{
                    return View::render('error');
                }
        }else{
            $errors = $validator->getErrors();
            
            return View::render('categorie/edit', ['errors'=>$errors, 'categorie' => $data]);
        }
    }}

    public function delete($data){
        $categorie = new TimbreCategorie;
        $delete = $categorie->delete($data['id']);
        if($delete){
            return View::redirect('categorie');
        }else{
            return View::render('error');
        }
    }
}