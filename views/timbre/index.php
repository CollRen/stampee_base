{{ include('layouts/header.php', { titre: 'Login', css: 'styles' })}}
<main class="main-index">


<h1>Timbre</h1>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Année</th>
            <th>Catégorie</th>          <!-- timbre_categorie_id -->
            <th>Propriétaire</th> <!-- user_id -->
            <th>Pays</th> <!-- pays_id -->
            <th>Prix de départ</th> <!-- prix_depart -->
            <th>Authentifié ?</th> <!-- authentifie -->
            <th>État de conservation</th> <!-- etat_conservation_id -->
        </tr>
    </thead>
    <tbody>

        {% for timbre in timbres %}
        {% if timbre.user_id == thisuser %}



        <tr>
            <td><a href="{{ base }}/timbre/show?id={{ timbre.id }}">{{ timbre.titre }}</a></td>
            <td>{{ timbre.description }}</td>
            <td>{{ timbre.annee }}</td>

            {% for etat in etats %}
            {% if timbre.etat_conservation_id == etat.id %}
            <td>{{ etat.nom }}</td>
            {% endif %}
            {% endfor %}


            {% for user in users %}
            {% if timbre.user_id == user.id %}
            <td>{{ user.name }}</td>
            {% endif %}
            {% endfor %}
            
            
            {% for pays in payss %}
            {% if timbre.pays_id == pays.id %}
            <td>{{ pays.nom }}</td>
            {% endif %}
            {% endfor %}
            
            <td>{{ timbre.prix_depart }} <small>$</small></td>
            <td>{{ timbre.authentifie }}</td>

            {% for etat in etats %}
            {% if timbre.etat_conservation_id == etat.id %}
            <td>{{ etat.nom }}</td>
            {% endif %}
            {% endfor %}

            {% endif %}
            {% endfor %}

        </tr>
    </tbody>
</table>


{% if session.privilege_id <= 3 %}
<a href="{{ base }}/timbre/create" class="btn">Timbre Create</a>

{% endif %}

</main>
{{ include('layouts/footer.php') }}