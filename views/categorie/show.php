{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Categorie Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ categorie.nom }}</p>
        <a href="{{base}}/categorie/edit?id={{categorie.id}}" class="btn block">Edit</a>
        <form action="{{base}}/categorie/delete" method="post">
            <input type="hidden" name="id" value="{{ categorie.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}