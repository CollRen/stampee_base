{{ include('layouts/header.php', { title: 'Liste etats'})}}
    <div class="container">
        <h2>Etats</h2>
        <hr>
        <p><strong>Prénom:</strong> {{ etat.prenom }}</p>
        <p><strong>Nom:</strong> {{ etat.nom }}</p>

        <a href="{{base}}/etat/edit?id={{etat.id}}" class="btn block">Edit</a>
        <form action="{{base}}/etat/delete" method="post">
            <input type="hidden" name="id" value="{{ etat.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}