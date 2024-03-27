{{ include('layouts/header.php', { titre: 'Timbre', css: 'styles' })}}
<main class="main-index">
<div class="container">
    <h2>Timbre Edit</h2>
    <form method="post">
        <label for="titre">Titre
            <input type="text" name="titre" value="{{ timbre.titre }}">
        </label>

        <label for="description">Description
            <input type="text" name="description" value="{{ timbre.description }}">
        </label>

        <label for="annee">Année
            <input type="date" name="annee" value="{{ timbre.annee }}">
        </label>

        <label for="prix_depart">Prix de départ
        <input type="number" name="prix_depart" step=".01" value="{{ timbre.prix_depart }}">
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

        <label for="authentifie">Est-ce que ce timbre est authentifié
            <input type="checkbox" id="authentifie" name="authentifie" value="1" {% if timbre.authentifie == 1 %} checked {% endif %}>
        </label>

        <input type="submit" class="btn" value="Update">
    </form>
</div>

</main>
{{ include('layouts/footer.php') }}






