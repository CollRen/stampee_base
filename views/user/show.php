{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Users Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ user.name }}</p>
        <p><strong>User Name:</strong> {{ user.username }}</p>
        <p><strong>Id:</strong> {{ user.id }}</p>
        <p><strong>Privilège Id:</strong> {{ user.privilege_id }}</p>

        <a href="{{base}}/user/edit?id={{user.id}}" class="btn block">Edit</a>
        <form action="{{base}}/user/delete" method="post">
            <input type="hidden" name="id" value="{{ user.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    </main>
{{ include('layouts/footer.php') }}