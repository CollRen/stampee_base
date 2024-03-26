{{ include('layouts/header.php', { titre: 'Pays', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Pays Edit</h2>
        <form method="post">
        <label for="date_debut">Date début
            <input type="datetime-local" name="date_debut">
        </label>
        
        <label for="date_limite">Date limite
            <input type="datetime-local" name="date_limite">
        </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}