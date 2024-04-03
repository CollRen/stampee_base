{{ include('layouts/header.php', { titre: 'Enchère Edit', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Enchère Edit</h2>
        <form method="post">

            <label for="date_limite">Date limite
                <input type="datetime-local" name="date_limite" {% if enchere.date_limite is defined %} value="{{ enchere.date_limite }}" {% endif %}>
            </label>
            {% if errors.date_limite is defined %}
            <span class="error">{{ errors.date_limite }}</span>
            {% endif %}

            <label for="date_debut">Date début
                <input type="datetime-local" name="date_debut" {% if enchere.date_debut is defined %} value="{{ enchere.date_debut }}" {% endif %}>
            </label>
            {% if errors.date_debut is defined %}
                    <span class="error">{{ errors.date_debut }}</span>
                {% endif %}
            <input type="hidden" id="id" name="id" value="{{ enchere.id }}"/>
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}