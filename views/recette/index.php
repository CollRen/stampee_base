{{ include('layouts/header.php', { title: 'Timbre'})}}
<h1>Timbre</h1>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Temps préparation <small>(min)</small></th>
            <th>Temps de cuisson <small>(min)</small></th>
            <th>Etat</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        {% for timbre in timbres %}
        <tr>
            <td><a href="{{ base }}/timbre/show?id={{ timbre.id }}&timbre_categorie_id={{ timbre.timbre_categorie_id }}&etat_id={{ timbre.etat_id }}">{{ timbre.titre }}</a></td>
            <td>{{ timbre.temps_preparation }}</td>
            <td>{{ timbre.temps_cuisson }}</td>

            {% for etat in etats %}
            {% if timbre.etat_id == etat.id %}
            <td>{{ etat.nom }}</td>
            {% endif %}
            {% endfor %}

            {% for timbreCat in timbreCats %}
            {% if timbre.timbre_categorie_id == timbreCat.id %}
            <td>{{ timbreCat.nom }}</td>
            {% endif %}
            {% endfor %}

            {% endfor %}

        </tr>
    </tbody>
</table>


{% if session.privilege_id <= 3 %}
<a href="{{ base }}/timbre/create" class="btn">Timbre Create</a>

{% endif %}

{{ include('layouts/footer.php') }}