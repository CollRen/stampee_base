{{ include('layouts/header.php', { titre: 'Show connected', css: 'styles' })}}
<main class="main-index">
<div class="container">
    <h2>{{ timbre.titre }}</h2>

    <p><strong>Description:</strong> {{ timbre.description }}</p>
    <p><strong>Année:</strong> {{ timbre.annee }}</p>
    <p><strong>Catégorie:</strong> {{ categorie.nom }}</p>
    <p><strong>Pays de provenence:</strong> {{ pays.nom }}</p>
    <p><strong>Prix de départ:</strong> {{ timbre.prix_depart }}</p>

    <p><strong>Authentification:</strong> {{ timbre.authentifie }}</p>
    <p><strong>État du timbre:</strong> {{ etat.nom }}</p>

    <a href="{{base}}/timbre/edit?id={{timbre.id}}" class="btn block">Edit</a>

    <form action="{{base}}/image/import" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>



</div>




</main>
{{ include('layouts/footer.php') }}