{{ include('layouts/header.php', { titre: 'enchere', css: 'styles' })}}
<main class="main-index">
    <h1>Enchères</h1>
    <table>
        <thead>
            <tr>
                <th># d'enchères</th>
                <th># du timbre</th>
                <th>Date début</th>
                <th>Date limite</th>

            </tr>
        </thead>
        <tbody>
        {% for enchere in encheres %}
        {% for timbre in timbres %}
        {% if thisuser == timbre.user_id %}
        {% if timbre.id == enchere.timbre_id %}

            <tr>
                <td><a href="{{ base }}/enchere/show?id={{ enchere.id }}">{{ enchere.id }}</a></td>
                <td>{{ enchere.timbre_id }}</td>
                <td>{{ enchere.date_debut }}</td>
                <td>{{ enchere.date_limite }}</td>

            </tr>

        {% endif %}
        {% endif %}
        {% endfor %}
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/enchere/create" class="btn" >enchere Create</a>

    </main>
{{ include('layouts/footer.php') }}