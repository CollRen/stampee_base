{{ include('layouts/header.php', { titre: 'Show connected', css: 'styles' })}}
<main class="main-index">
<div class="container">
    <h2>Liste timbre, éventuellement, Ma liste de timbre</h2>

    <p><strong>Titre:</strong>  {{ timbre.titre }}</p>
    <p><strong>Description:</strong> {{ timbre.description }}</p>
    <p><strong>Année:</strong> {{ timbre.annee }}</p>
    <p><strong>Catégorie:</strong> {{ categorie.nom }}</p>
    <p><strong>Pays de provenence:</strong> {{ pays.nom }}</p>
    <p><strong>Prix de départ:</strong> {{ timbre.prix_depart }}</p>

    <p><strong>Authentification:</strong> {{ timbre.authentifie }}</p>
    <p><strong>État du timbre:</strong> {{ etat.nom }}</p>

    <a href="{{base}}/timbre/edit?id={{timbre.id}}" class="btn block">Edit</a>
    <form action="{{base}}/timbre/delete" method="post">
        <input type="hidden" name="id" value="{{ timbre.id }}">
        <button class="btn block red">Delete</button>
    </form>

</div>


</main>
{{ include('layouts/footer.php') }}