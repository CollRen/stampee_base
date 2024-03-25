{{ include('layouts/header.php', { titre: 'Timbre', css: 'styles' })}}
<div class="container">
    <h2>Timbre Edit</h2>
    <form method="post">
        <label>Titre
            <input type="text" name="titre" value="{{ timbre.titre }}">
        </label>

        <label>Description
            <input type="text" name="description" value="{{ timbre.description }}">
        </label>

        <label>Année
            <input type="text" name="annee" value="{{ timbre.annee }}">
        </label>

        <label>Prix de départ
            <input type="text" name="prix_depart" value="{{ timbre.prix_depart }}">
        </label>

        <label for="pays_id"></label>Pays de provenence
        <select name="pays_id" id="pays_id">

            {% for pays in payss %}

            <option value="{{ pays.id }}">{{ pays.nom }}</option>

            {% endfor %}
        </select>

        <label for="etat_conservation_id">Etat:</label>
        <select name="etat_conservation_id" id="etat_conservation_id">
            {% for etat in etats %}

                <option value="{{ etat.id }}" {% if etat.id == timbre.etat_conservation_id %} selected {% endif %}>{{ etat.nom }}</option>

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






