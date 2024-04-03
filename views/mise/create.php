{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}
<main class="main-index">
    <div class="container">
        <h2>Mise Create</h2>
        <form method="post">
            <label for="prix_offert">Montant misé
                <input type="number" name="prix_offert" min="{{ misemax }}" value="{{ misemax }}">
            </label>

            <label for="enchere_id">
                <input type="hidden" name="enchere_id" value="{{ enchere.id }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Miser">
        </form>
    </div>
    </main>
{{ include('layouts/footer.php') }}


<!-- 

- Montant minimum
- 
-
-
-
-




 -->