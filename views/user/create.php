{{ include('layouts/header.php', { titre: 'Inscription', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        <form method="post">
            <h2>Inscription</h2>
            <label for="name">Nom
                <input type="text" name="name" value="{{ user.name}}">
            </label>
            <label for="username">Nom d'utilisateur
                <input type="email" name="username" value="{{ user.username}}">
            </label>
            <label for="password">Mot de passe
                <input type="password" name="password">
            </label>
            <label for="email">Courriel
                <input type="email" name="email" value="{{ user.email}}">
            </label>
            {% if session.privilege_id == 1 %}
            <label for="privilege_id">
                Privilège à accorder
                <select name="privilege_id">
                    <option value="">Sélectionner</option>
                    {% for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.nom }}</option>
                    {% endfor %}
                </select>
            </label>
            {% endif %}
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php')}}