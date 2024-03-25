{{ include('layouts/header.php', { titre: 'User', css: 'styles' })}}
    <div class="container">
        <h2>User Edit</h2>
        <form method="post">
        <label>Name
                <input type="text" name="name" value="{{ user.name }}">
            </label>
        <label>Username
                <input type="text" name="username" value="{{ user.username }}">
            </label>


            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}