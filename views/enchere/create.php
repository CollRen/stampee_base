{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Créer une enchère</h2>
        <form method="post">

        <label for="timbre_id"></label>Pour quel timbre?
        <select name="timbre_id" id="timbre_id">

            {% for timbre in timbres %}

            <option value="{{ timbre.id }}">{{ timbre.titre }}</option>

            {% endfor %}
        </select>


        <label for="date_limite">Date limite
            <input type="datetime-local" name="date_limite">
        </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}