{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Mise Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ mise.nom }}</p>

        <a href="{{base}}/mise/edit?id={{mise.id}}" class="btn block">Edit</a>
        <form action="{{base}}/mise/delete" method="post">
            <input type="hidden" name="id" value="{{ mise.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}