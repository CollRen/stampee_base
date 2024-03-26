{{ include('layouts/header.php', { titre: 'Actualite', css: 'styles' })}}
    <h1>Actualite</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Texte</th>

            </tr>
        </thead>
        <tbody>
        {% for actualite in actualites %}
            <tr>
                <td><a href="{{ base }}/actualite/show?id={{ actualite.id }}">{{ actualite.date }}</a></td>
                <td>{{ actualite.text }}</td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/actualite/create" class="btn" >Actualite Create</a>

    {{ include('layouts/footer.php') }}