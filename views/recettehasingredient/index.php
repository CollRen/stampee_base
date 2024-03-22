{{ include('layouts/header.php', { title: 'Timbrehasenchere'})}}
    <h1>Timbrehasenchere</h1>
    <table>
        <thead>
            <tr>
                <th>Page non nécessaire</th>

            </tr>
        </thead>
        <tbody>
        {% for timbrehasenchere in timbrehasencheres %}
            <tr>
                <td><a href="{{ base }}/timbrehasenchere/show?id={{ timbrehasenchere.id }}">{{ timbrehasenchere.enchere_id }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/timbrehasenchere/create" class="btn" >Timbrehasenchere Create</a>

    {{ include('layouts/footer.php') }}

    
