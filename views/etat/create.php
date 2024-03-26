{{ include('layouts/header.php', { titre: 'Aj Etat', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Création d'un etat</h2>
        <form method="post">

            <label>Nom
                <input type="text" name="nom" value="{{ etat.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom}}</span>
            {% endif %}

            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}