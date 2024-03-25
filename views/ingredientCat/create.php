{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
    <div class="container">
        <h2>TimbreCat Create</h2>
        <form method="post">
            <label>Nom
                <input type="text" name="nom" value="{{ enchereCat.nom }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}