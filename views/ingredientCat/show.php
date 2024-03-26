{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>TimbreCat Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ enchereCat.nom }}</p>


        <a href="{{base}}/enchereCat/edit?id={{enchereCat.id}}" class="btn block">Edit</a>
        <form action="{{base}}/enchereCat/delete" method="post">
            <input type="hidden" name="id" value="{{ enchereCat.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}