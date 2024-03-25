{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<div class="container">
    <h2>Enchere Show</h2>
    <hr>
    <p><strong>Nom:</strong> {{ enchere.nom }}</p>

    {% for enchereCat in encherecats %}
    {% if enchereCat.id == enchere.timbre_id %}

    <p><strong>Catégorie:</strong> {{ enchereCat.nom }} </p>

    {% endif %}
    {% endfor %}

    {% if session.privilege_id <= 2 %}
    <a href="{{base}}/enchere/edit?id={{enchere.id}}" class="btn block">Edit</a>
    <form action="{{base}}/enchere/delete" method="post">
        <input type="hidden" name="id" value="{{ enchere.id }}">
        <button class="btn block red">Delete</button>
    </form>
</div>
{% endif %}

{{ include('layouts/footer.php') }}