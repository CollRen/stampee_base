{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
    <div class="container">
        <h2>Actualite Create</h2>
        <form method="post">
            <label>Texte
                <input type="text" name="text" value="{{ actualite.text }}">
            </label>

            <label>Date
                <input type="datetime-local" name="text" value="{{ actualite.date }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}

