{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
<main class="main-index">
<div class="container">
    <h2>Timbre Create</h2>
    <form method="post">
        <label for="titre" {% if errors.titre is defined %}class="error" {% endif %}>Titre
            <input type="text" name="titre" value="{{ data.titre }}">
        </label>
        <label for="description">Description
            <input type="text" name="description" value="{{ data.description }}">
        </label>

        <label for="annee">Année
            <input type="date" name="annee" value="{{ timbre.annee }}">
        </label>

        <label for="timbre_categorie_id"></label>Catégorie
        <select name="timbre_categorie_id" id="">

            {% for timbreCategorie in timbreCategories %}

            <option value="{{ timbreCategorie.id }}" {% if timbreCategorie.id == data.timbre_categorie_id %} selected {% endif %}>{{ timbreCategorie.nom }}</option>
            {% endfor %}
        </select>

        <label for="pays_id"></label>Pays de provenence
        <select name="pays_id" id="pays_id">

            {% for pays in payss %}

            <option value="{{ pays.id }}" {% if pays.id == data.pays_id %} selected {% endif %}>{{ pays.nom }}</option>

            {% endfor %}
        </select>
        <label for="prix_depart">Prix de départ
            <input type="number" name="prix_depart" step=".01" value="{{ data.prix_depart }}">
        </label>

        {% if errors.nom is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}



        <label for="authentifie">Est-ce que ce timbre est authentifié
            <input type="checkbox" id="authentifie" name="authentifie" value="1">
        </label>

        <label for="etat_conservation_id"></label>État générale du timbre
        <select name="etat_conservation_id">


            {% for timbreEtat in timbreEtats %}

            <option value="{{ timbreEtat.id }}" {% if timbreEtat.id == data.etat_conservation_id %} selected {% endif %}>{{ timbreEtat.nom }}</option>

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

{% for validator in validators %}

{{ validator.nom }}

{% endfor %}

</main>
{{ include('layouts/footer.php') }}