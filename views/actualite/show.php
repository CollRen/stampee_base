{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
    <div class="container">
        <h2>Actualite Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ actualite.date }}</p>
        <p><strong>Nom:</strong> {{ actualite.text }}</p>

        <a href="{{base}}/actualite/edit?id={{actualite.id}}" class="btn block">Edit</a>
        <form action="{{base}}/actualite/delete" method="post">
            <input type="hidden" name="id" value="{{ actualite.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}