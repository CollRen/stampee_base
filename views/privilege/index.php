{{ include('layouts/header.php', { titre: 'Privilege', css: 'styles' })}}
<main class="main-index">
    <h1>Privilege</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for privilege in privilege %}
            <tr>
                <td><a href="{{ base }}/privilege/show?id={{ privilege.id }}">{{ privilege.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/privilege/create" class="btn" >Privilege Create</a>

    </main>
{{ include('layouts/footer.php') }}