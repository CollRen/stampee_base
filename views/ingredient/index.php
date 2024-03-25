{{ include('layouts/header.php', { titre: 'Enchere', css: 'styles' })}}
<h1>Enchere</h1>
</select>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        {% for enchere in encheres %}
        <tr>
            <td><a href="{{ base }}/enchere/show?id={{ enchere.id }}">{{ enchere.nom }}</a></td>
            <td>
                {% for enchereCat in encherecats %}

                    {% if enchereCat.id == enchere.timbre_id %} 
                        {{ enchereCat.nom }} 
                    {% endif %} 

                {% endfor %}
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>
<a href="{{ base }}/enchere/create" class="btn">Enchere Create</a>

{{ include('layouts/footer.php') }}