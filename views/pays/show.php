{{ include('layouts/header.php', { title: 'Show'})}}
    <div class="container">
        <h2>Pays Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ pays.nom }}</p>

        <a href="{{base}}/pays/edit?id={{pays.id}}" class="btn block">Edit</a>
        <form action="{{base}}/pays/delete" method="post">
            <input type="hidden" name="id" value="{{ pays.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}