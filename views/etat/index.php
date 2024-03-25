{{ include('layouts/header.php', { titre: 'Aj Etat', css: 'styles' })}}
    <h1>Etats</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de l'état</th>
            </tr>
        </thead>
        <tbody>
        {% for etat in etats %}
            <tr>
                <td><a href="{{ base }}/etat/show?id={{ etat.id }}">{{ etat.nom }}</a></td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/etat/create" class="btn" >Ajouter un etat</a>

    {{ include('layouts/footer.php') }}
