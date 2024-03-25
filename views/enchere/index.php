{{ include('layouts/header.php', { titre: 'enchere', css: 'styles' })}}
    <h1>enchere</h1>
    <table>
        <thead>
            <tr>
                <th># d'enchères</th>
                <th># du timbre</th>
                <th>Date limite</th>

            </tr>
        </thead>
        <tbody>
        {% for enchere in encheres %}
            <tr>
                <td><a href="{{ base }}/enchere/show?id={{ enchere.id }}">{{ enchere.id }}</a></td>
                <td>{{ enchere.timbre_id }}</td>
                <td>>{{ enchere.date_limite }}</td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/enchere/create" class="btn" >enchere Create</a>

    {{ include('layouts/footer.php') }}