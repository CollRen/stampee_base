{{ include('layouts/header.php', { titre: 'Login', css: 'styles' })}}
<h1>User</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Privilège</th>
        </tr>
    </thead>
    <tbody>
        {% for user in users %}
        <tr>
            <td><a href="{{ base }}/user/show?id={{ user.id }}">{{ user.name }}</a></td>
            <td>{{ user.username }}</td>
            {% for privilege in privileges %}
                {% if privilege.id == user.privilege_id %}
                    <td>{{ privilege.nom }}</td>
                {% endif %}
            {% endfor %}
        </tr>
        {% endfor %}
    </tbody>
</table>
<a href="{{ base }}/user/create" class="btn">User Create</a>
{{ include('layouts/footer.php') }}