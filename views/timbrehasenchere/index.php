{{ include('layouts/header.php', { titre: 'Timbrehasenchere', css: 'styles' })}}
<main class="main-index">
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

    </main>
{{ include('layouts/footer.php') }}

    
