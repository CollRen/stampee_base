{{ include('layouts/header.php', { titre: 'TimbreCat', css: 'styles' })}}
    <h1>TimbreCat</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for enchereCat in encherecats %}
            <tr>
                <td><a href="{{ base }}/enchereCat/show?id={{ enchereCat.id }}">{{ enchereCat.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    
    <a href="{{ base }}/enchereCat/create" class="btn" >TimbreCat Create</a>

    {{ include('layouts/footer.php') }}