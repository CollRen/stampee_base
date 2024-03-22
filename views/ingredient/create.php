{{ include('layouts/header.php', { title: 'Create'})}}
    <div class="container">
        <h2>Enchere Create</h2>
        <form method="post">
            <label>Nom
                <input type="text" name="nom" value="{{ enchere.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}


            <select name="timbre_id" id="">

{% for enchereCat in encherecats %}

    <option value="{{ enchereCat.id }}">{{ enchereCat.nom }}</option>

{% endfor %}
</select>
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}