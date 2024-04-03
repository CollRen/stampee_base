{{ include('layouts/header.php', { titre: 'Privilege', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Privilege Edit</h2>
        <form method="post">
        <label>Nom
                <input type="text" name="nom" value="{{ privilege.nom }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}