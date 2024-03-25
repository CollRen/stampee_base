{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
    <div class="container">
        <h2>Créer une enchère</h2>
        <form method="post">

        <label for="timbre_id"></label>Pour quel timbre?
        <select name="timbre_id" id="timbre_id">

            {% for timbre in timbres %}

            <option value="{{ timbre.id }}">{{ timbre.titre }}</option>

            {% endfor %}
        </select>


        <label for="date_limite">Année
            <input type="number" name="date_limite">
        </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}