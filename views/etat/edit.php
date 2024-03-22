{{ include('layouts/header.php', { title: 'Ajuste etat', css: 'admin'})}}
    <div class="container">
        <h2>Édition de l'etat</h2>
        <form method="post">

            <label>Nom
                <input type="text" name="nom" value="{{ etat.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom}}</span>
            {% endif %}

            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}