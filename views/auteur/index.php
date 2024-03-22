{{ include('layouts/header.php', { title: 'Aj Etat'})}}
    <h1>Etats</h1>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
        {% for etat in etats %}
            <tr>
                <td><a href="{{ base }}/etat/show?id={{ etat.id }}">{{ etat.prenom }}</a></td>
                <td>{{ etat.nom }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/etat/create" class="btn" >Ajouter un etat</a>

    {{ include('layouts/footer.php') }}
