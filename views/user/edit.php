{{ include('layouts/header.php', { titre: 'User', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>User Edit</h2>
        <form method="post">
            <label for="name">Nom
                <input type="text" name="name" value="{{ user.name }}">
            </label>
            <label for="username">Username
                <input type="text" name="username" value="{{ user.username }}">
            </label>

            <label for="password">Password
                <input type="password" name="password">
            </label>
            <label for="email">Email
                <input type="email" name="email" value="{{ user.email}}">
            </label>
            <label for="privilege_id">
                Privilege
                <select name="privilege_id">
                    <option value="">Select Privilege</option>
                    {% for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.nom }}</option>
                    {% endfor %}
                </select>
            </label>


            {% if errors is defined %}
            {% for error in errors %}
            <span class="error">{{ error }}</span>
           {% endfor %} {% endif %}

            <input type="submit" class="btn" value="Update">
        </form>
    </div>
</main>
{{ include('layouts/footer.php') }}

Array ( [name] => Membre 3 [username] => membre2@me.com )
Array ( [id] => 4 )