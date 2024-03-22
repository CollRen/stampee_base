{{ include('layouts/header.php', { title: 'Create'})}}
<div class="container">
    <h2>Ajouter maintenant vos ingrédients</h2>
    <form method="post">
       
        <table>
    <thead>
        <tr>
            <td>Quantité</td>
            <td>Unité de mesure</td>
            <td>Ingrédient</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" min="0.25" max="100" value="0.25" step="0.25" />
            </td>

            <td>
                <select name="unite_mesure_id">
                    {% for pays in pays %}
                    <option value="{{ pays.id }}">{{ pays.nom }}</option>
                    {% endfor %}
                </select>
            </td>

            <td>
                <select name="enchere_id">
                    {% for enchere in encheres %}
                    <option value="{{ enchere.id }}">{{ enchere.nom }}</option>
                    {% endfor %}
                </select>
            </td>
        </tr>
    </tbody>

</table>

        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        <input type="submit" class="btn" value="Save">
    </form>
</div>

{{ include('layouts/footer.php') }}