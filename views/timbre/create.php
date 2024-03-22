{{ include('layouts/header.php', { title: 'Create'})}}
<div class="container">
    <h2>Timbre Create</h2>
    <form method="post">
        <label {% if errors.titre is defined %}class="error" {% endif %}>Titre
            <input type="text" name="titre" value="{{ timbre.titre }}">
        </label>
        <label>Description
            <input type="text" name="description" value="{{ timbre.description }}">
        </label>

        <label>Temps de préparation <small>(En minutes)</small>
            <input type="text" name="temps_preparation" value="{{ timbre.temps_preparation }}">
        </label>

        <label>temps_cuisson <small>(En minutes)</small>
            <input type="text" name="temps_cuisson" value="{{ timbre.temps_cuisson }}">
        </label>

        <label for="timbre_categorie_id"></label>Catégorie
        <select name="timbre_categorie_id" id="">

            {% for timbreCategorie in timbreCategories %}

            <option value="{{ timbreCategorie.id }}">{{ timbreCategorie.nom }}</option>

            {% endfor %}
        </select>



        <label for="etat_conservation_id"></label>Etat
        <select name="etat_conservation_id" id="">


            {% for timbreEtat in timbreEtats %}

            <option value="{{ timbreEtat.id }}">{{ timbreEtat.nom }}</option>

            {% endfor %}
        </select>


        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        <input type="submit" class="btn" value="Save">
    </form>
</div>

{{ include('layouts/footer.php') }}