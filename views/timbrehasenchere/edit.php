{{ include('layouts/header.php', { titre: 'Edit RHI', css: 'styles' })}}

<div class="container">
    <h2>Ajuster cet ingrédient</h2>
    <p>Timbre numéro: {{ timbrehasencheres.timbre_id }}</p>


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
                        <label for="quantite">Quantité: </label>
                        <input type="number" name="quantite" min="0.25" max="100" value="{{ timbrehasencheres.quantite }}" step="0.25" />
                    </td>

                    <td>
                        <select name="unite_mesure_id">
                            {% for pays in pays %}
                            
                            <option value="{{ pays.id }}"{% if pays.id == timbrehasencheres.unite_mesure_id %} selected {% endif %}>{{ pays.nom }}</option>
                            
                            {% endfor %}
                        </select>
                    </td>

                    <td>
                        <select name="enchere_id">
                            {% for enchere in encheres %}
                            <option value="{{ enchere.id }}"{% if enchere.id == timbrehasencheres.enchere_id %} selected {% endif %}>{{ enchere.nom }}</option>
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
        <input type="hidden" name="timbre_id" value="{{ timbre_id }}">
        <input type="submit" class="btn" value="Save">
    </form>
</div>