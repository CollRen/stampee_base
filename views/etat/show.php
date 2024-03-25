{{ include('layouts/header.php', { titre: 'Liste etats', css: 'styles' })}}
    <div class="container">
        <h2>Etats</h2>
        <hr>
        <p><strong>Nom de l'état:</strong> {{ etat.nom }}</p>

        <a href="{{base}}/etat/edit?id={{etat.id}}" class="btn block">Edit</a>
        <form action="{{base}}/etat/delete" method="post">
            <input type="hidden" name="id" value="{{ etat.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}