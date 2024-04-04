<?php

namespace App\Controllers;

use App\Providers\Auth;

use App\Models\Image;
use App\Providers\View;
use App\Providers\Validator;


class ImageController
{

    /*     public function __construct()
    {
        $image = new Image;

    } */

    public function index()
    {
        $image = new Image;
        $select = $image->select();

        //include('views/image/index.php');
        if ($select) {
            return View::render('image/index', ['image' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $image = new Image;
            $selectId = $image->selectId($data['id']);
            if ($selectId) {
                return View::render('image/show', ['image' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('image/create');
    }

    public function import($get)
    {
        // print_r($get); die();
        $image = new Image;
        $message = $image->upload();

        // Check if $uploadOk is set to 0 by an error
        if ($message == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $chemin = '/Applications/MAMP/htdocs/h24/stampee_base/stampeeFromRecette/public/assets/img/timbres/';
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $chemin. basename($_FILES["fileToUpload"]["name"]))) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                $data['adresse'] = '/img/timbres/' . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                $data['nom'] = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                $data['est_principale'] = 1;
                $data['timbre_id'] = $get['timbre_id'];


                $insert = $image->insert($data);
                // 'nom', 'est_principale', 'adresse', 'timbre_id'
                /* 'nom',
                '1',
                '/img/timbres/'.htmlspecialchars(basename($_FILES["fileToUpload"]["name"])),
                 'timbre_id' 
                 */
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function store($data)
    {

        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if ($validator->isSuccess()) {
            $image = new Image;
            $insert = $image->insert($data);
            if ($insert) {
                return View::redirect('image');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('image/create', ['errors' => $errors, 'image' => $data]);
        }
    }
}
