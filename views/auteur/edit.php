{{ include('layouts/header.php', { title: 'Ajuste etat'})}}
    <div class="container">
        <h2>Édition de l'etat</h2>
        <form method="post">
        <label>Prénom
                <input type="text" name="prenom" value="{{ etat.prenom }}">
            </label>
            {% if errors.prenom is defined %}
                <span class="error">{{ errors.prenom }}</span>
            {% endif %}
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