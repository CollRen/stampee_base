{{ include('layouts/header.php', { title: 'Timbre'})}}
<div class="container">
    <h2>Timbre Edit</h2>
    <form method="post">
        <label>Titre
            <input type="text" name="titre" value="{{ timbre.titre }}">
        </label>

        <label>Description
            <input type="text" name="description" value="{{ timbre.description }}">
        </label>

        <label>Temps de préparation
            <input type="text" name="temps_preparation" value="{{ timbre.temps_preparation }}">
        </label>

        <label>Temps de cuisson
            <input type="text" name="temps_cuisson" value="{{ timbre.temps_cuisson }}">
        </label>

        <label for="etat_id">Etat:</label>
        <select name="etat_id" id="etat_id">
            {% for etat in etats %}

                <option value="{{ etat.id }}" {% if etat.id == timbre.etat_id %} selected {% endif %}>{{ etat.nom }}</option>

            {% endfor %}
        </select>

        <label for="timbre_categorie_id">Catégorie:</label>
        <select name="timbre_categorie_id" id="timbre_categorie_id">
            {% for timbreCat in timbreCats %}

                <option value="{{ timbreCat.id }}" {% if timbreCat.id == timbre.timbre_categorie_id %} selected {% endif %}>{{ timbreCat.nom }}</option>

            {% endfor %}
        </select>

        <input type="submit" class="btn" value="Update">
    </form>
</div>

{{ include('layouts/footer.php') }}






