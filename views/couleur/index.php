{{ include('layouts/header.php', { titre: 'Couleur', css: 'styles' })}}
<main class="main-index">
    <h1>Couleur</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for couleur in couleur %}
            <tr>
                <td><a href="{{ base }}/couleur/show?id={{ couleur.id }}">{{ couleur.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/couleur/create" class="btn" >Couleur Create</a>

    </main>
{{ include('layouts/footer.php') }}