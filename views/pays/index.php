{{ include('layouts/header.php', { title: 'Pays', css: 'admin'})}}
    <h1>Pays</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for pays in pays %}
            <tr>
                <td><a href="{{ base }}/pays/show?id={{ pays.id }}">{{ pays.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/pays/create" class="btn" >Pays Create</a>

    {{ include('layouts/footer.php') }}