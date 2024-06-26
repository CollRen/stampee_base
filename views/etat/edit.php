{{ include('layouts/header.php', { titre: 'Ajuste etat', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Édition de l'etat</h2>
        <form method="post">

            <label>Nom
                <input type="text" name="nom" value="{{ etat.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom}}</span>
            {% endif %}

            <input type="hidden" id="id" name="id" value="{{ etat.id }}"/>
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}