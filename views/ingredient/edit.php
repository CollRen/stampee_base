{{ include('layouts/header.php', { title: 'Enchere'})}}
<div class="container">
    <h2>Enchere Edit</h2>
    <form method="post">
        <label>Nom
            <input type="text" name="nom" value="{{ enchere.nom }}">
        </label>
        {% if errors.name is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}

        <select name="timbre_id" id="">

            {% for enchereCat in encherecats %}

            <option value="{{ enchereCat.id }}" {% if enchereCat.id == enchere.timbre_id %} selected {% endif %}>{{ enchereCat.nom }}</option>

            {% endfor %}
        </select>

        <input type="submit" class="btn" value="Update">
    </form>
</div>
{{ include('layouts/footer.php') }}