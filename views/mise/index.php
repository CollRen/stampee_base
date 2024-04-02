{{ include('layouts/header.php', { titre: 'Mise', css: 'styles' })}}
<main class="main-index">
    <h1>Mise</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for mise in mises %}
            <tr>
                <td><a href="{{ base }}/mise/show?id={{ mise.id }}">{{ mise.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/mise/create" class="btn" >Mise Create</a>

    </main>
{{ include('layouts/footer.php') }}