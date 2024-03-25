{{ include('layouts/header.php', { titre: 'Create RHI', css: 'styles' })}}

<div class="container">
    <h2>Ajouter maintenant vos ingrédients</h2>
    <p>timbre numéro {{ timbre_id }}</p>


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
        <input type="hidden" name="timbre_id" value="{{ timbre_id }}">
        <input type="submit" class="btn" value="Save">
    </form>
</div>

<div class="container">

    <ul>
        <li>{{ timbre_id }}</li>
    </ul>


    {% if timbrehasencheres is defined %}
    <table>
        <thead>
            <tr>
                <td>Quantité</td>
                <td>Unité de mesure</td>
                <td>Ingrédient</td>
            </tr>
        </thead>
        <tbody>

            {% for timbrehasenchere in timbrehasencheres %}
                {% if timbrehasenchere.timbre_id == timbre_id %}
                    <tr>

                        <td>{{ timbrehasenchere.quantite }}</td>
                        {% for pays in pays %}
                            {% if pays.id == timbrehasenchere.unite_mesure_id %}
                                <td>{{ pays.nom }}</td>
                            {% endif %}
                        {% endfor %}

                        {% for enchere in encheres %}
                            {% if enchere.id == timbrehasenchere.enchere_id %}
                                <td>{{ enchere.nom }}</td>
                            {% endif %}
                        {% endfor %}
                    </tr>
                {% endif %}
            {% endfor %}
        </tbody>

    </table>
    {% endif %}


    <!--     {% if timbrehasencheres is defined %}
    <ul>

        {% for timbrehasenchere in timbrehasencheres %}

            {% if timbrehasenchere.timbre_id == timbre_id %}
                <li>{{ timbrehasenchere }}</li>
            {% endif %}
        {% endfor %}
    </ul>

    {% endif %} -->

</div>

{{ include('layouts/footer.php') }}