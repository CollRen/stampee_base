{{ include('layouts/header.php', { titre: 'Actualite', css: 'styles' })}}
    <div class="container">
        <h2>Actualite Edit</h2>
        <form method="post">
        <label>text
                <input type="text" name="text" value="{{ actualite.text }}">
            </label>

            <label>Date
                <input type="datetime-local" name="text" value="{{ actualite.date }}">
            </label>


            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}