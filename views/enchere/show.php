{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>enchere Show</h2>
        <hr>
        <p><strong>Enchere id</strong> {{ enchere.id }}</p>
        <p><strong>Date limite</strong> {{ enchere.date_limite }}</p>

        <a href="{{base}}/enchere/edit?id={{enchere.id}}" class="btn block">Edit</a>
        <form action="{{base}}/enchere/delete" method="post">
            <input type="hidden" name="id" value="{{ enchere.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}