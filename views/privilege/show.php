{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Privilege Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ privilege.nom }}</p>

        <a href="{{base}}/privilege/edit?id={{privilege.id}}" class="btn block">Edit</a>
        <form action="{{base}}/privilege/delete" method="post">
            <input type="hidden" name="id" value="{{ privilege.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}