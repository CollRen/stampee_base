{{ include('layouts/header.php', { titre: 'Enchère Edit', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Enchère Edit</h2>
        <h2>{{ enchere.id }}</h2>
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




                {% if user.privilege_id == 1 %}

                <label for="est_coup_coeur_lord">Est coup de coeur lord
                <input type="checkbox" name="est_coup_coeur_lord"{% if enchere.est_coup_coeur_lord == 1 %} checked {% endif %} value="1" >
            </label>
            
            {% else %}
            <input type="hidden" name="est_coup_coeur_lord"{% if enchere.est_coup_coeur_lord == 1 %} value="1" {% else %} value="0" {% endif %}>
                {% endif %}

            <input type="hidden" id="id" name="id" value="{{ enchere.id }}"/>
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}