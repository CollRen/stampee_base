{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Couleur Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ couleur.nom }}</p>

        <a href="{{base}}/couleur/edit?id={{couleur.id}}" class="btn block">Edit</a>
        <form action="{{base}}/couleur/delete" method="post">
            <input type="hidden" name="id" value="{{ couleur.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}