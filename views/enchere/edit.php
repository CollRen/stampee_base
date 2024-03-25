{{ include('layouts/header.php', { titre: 'Pays', css: 'styles' })}}
    <div class="container">
        <h2>Pays Edit</h2>
        <form method="post">
        <label for="date_limite">Date limite
            <input type="number" name="date_limite">
        </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}