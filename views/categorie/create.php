{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Categorie Create</h2>
        <form method="post">
            <label>Nom
                <input type="text" name="nom" value="{{ categorie.name }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.name }}</span>
            {% endif %}
           
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}