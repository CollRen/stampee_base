<?php
require_once('functions.php');

$request_payload = file_get_contents('php://input');
$data = json_decode($request_payload, true);

if (isset($data['enchere']) && isset($data['description']) && isset($data['importance']) && $data['action'] == 'ajouteEnchere') {

    //Ajouter tâche
    if (isset($data['enchere']) && isset($data['description']) && isset($data['importance'])) {


        $enchere = htmlspecialchars($data['enchere']);
        $description = htmlspecialchars($data['description']);
        $importance = htmlspecialchars($data['importance']);

        $return_id = ajouteEnchere($enchere, $description, $importance);
        echo $return_id;
    } else {
        echo 'Erreur query string';
    }
} else if (isset($data['nom']) && isset($data['id']) && $data['action'] == 'edit') {

    // Change nom tâche
    $nom = htmlspecialchars($data['nom']);
    $id = htmlspecialchars($data['id']);

    changeNomEnchere($nom, $id);
    echo $nom;
} elseif (isset($data['id']) && $data['action'] == 'supprimer') {

    // Supprime tâche

    $id = htmlspecialchars($data['id']);

    supprimeEnchere($id);

    echo $id;
} elseif (isset($data['id']) && $data['action'] == 'getEnchereDetail') {

    // Va chercher toutes l'informations d'un enchere

    $id = htmlspecialchars($data['id']);
    $data_reponse = array();
    $detailsEnchere = getEnchereDetail($id);
    // Récupérer la ligne suivante d'un ensemble de résultats sous forme de tableau associatif
    while ($detailEnchere = mysqli_fetch_assoc($detailsEnchere)) {
        $data_reponse[] = $detailEnchere;
    }
    echo json_encode($data_reponse);

} elseif (isset($data['sort']) && $data['action'] == 'getEncheresTriees') {

    // Va chercher toutes l'informations d'un enchere

    $sort = htmlspecialchars($data['sort']);
    $data_reponse = array();
    $encheresTriees = getAllEncheresSort($sort);
    // Récupérer la ligne suivante d'un ensemble de résultats sous forme de tableau associatif
    while ($enchereTriee = mysqli_fetch_assoc($encheresTriees)) {
        $data_reponse[] = $enchereTriee;
    }
    echo json_encode($data_reponse);

} else {
    echo 'Erreur query string';
}
