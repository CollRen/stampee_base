{{ include('layouts/header.php', { titre: 'Pays', css: 'styles' })}}
<main class="main-index">
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

    </main>
{{ include('layouts/footer.php') }}