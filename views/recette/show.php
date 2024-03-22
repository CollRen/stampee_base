{{ include('layouts/header.php', { title: 'Show'})}}
<div class="timbre">
    <h1 class="timbre__titre">{{ timbre.titre }}</h1>
    <div class="timbre__durees">
        <p><strong>Temps de préparation:</strong> {{ timbre.temps_preparation }}</p>
        <p><strong>Temps de cuisson:</strong> {{ timbre.temps_cuisson }}</p>
        <a href="{{ base }}/timbre/pdf">Imprimer en pdf</a>
    </div>
    <div class="timbre__description">
        <p>{{ timbre.description }}</p>
    </div>

    <div class="liste_enchere--container">


        {% if timbrehasencheres is defined %}

        {% for timbrehasenchere in timbrehasencheres %}

        {% if session.privilege_id <= 3 %}
        <ul class="liste_enchere">

            <div class="btn-delete_rhi">
                <li><a href="{{ base }}/timbrehasenchere/edit?timbre_id={{timbrehasenchere.timbre_id}}&enchere_id={{ timbrehasenchere.enchere_id }}&id={{ timbrehasenchere.id }}"><span class="liste_enchere__qte"></span>{{ timbrehasenchere.quantite }}&nbsp;<span class="liste_enchere__pays"></span>{{ timbrehasenchere.unite_mesure_nom }}&nbsp;<span class="liste_enchere__enchere">{{ timbrehasenchere.enchere_nom }}&nbsp;</span></a></li>
                <!--                                  <form action="{{base}}/timbrehasenchere/delete" method="post">
                                            <input type="hidden" name="timbre_id" value="{{ timbre.id }}">
                                            <button class="btn block red">Delete</button>
                                        </form> -->
            </div>
        </ul>
        {% else %}
        <ul class="liste_enchere">

            <div class="btn-delete_rhi">
                <li><span class="liste_enchere__qte"></span>{{ timbrehasenchere.quantite }}&nbsp;<span class="liste_enchere__pays"></span>{{ timbrehasenchere.unite_mesure_nom }}&nbsp;<span class="liste_enchere__enchere">{{ timbrehasenchere.enchere_nom }}&nbsp;</span></li>

                <!--                                  <form action="{{base}}/timbrehasenchere/delete" method="post">
                                <input type="hidden" name="timbre_id" value="{{ timbre.id }}">
                                <button class="btn block red">Delete</button>
                            </form> -->
            </div>
        </ul>
        {% endif %}



        {% endfor %}



        {% endif %}


        {% if timbrehasenchere is defined %}



        <ul class="liste_enchere">

            <div class="btn-delete_rhi">


                <li><a href="{{ base }}/timbrehasenchere/edit?timbre_id={{timbrehasenchere.timbre_id}}&enchere_id={{ timbrehasenchere.enchere_id }}&id={{ timbrehasenchere.id }}"><span class="liste_enchere__qte"></span>{{ timbrehasenchere.quantite }}&nbsp;<span class="liste_enchere__pays"></span>{{ timbrehasenchere.unite_mesure_nom }}&nbsp;<span class="liste_enchere__enchere">{{ timbrehasenchere.enchere_nom }}&nbsp;</span></a></li>
                <!--                                  <form action="{{base}}/timbrehasenchere/delete" method="post">
                                    <input type="hidden" name="timbre_id" value="{{ timbre.id }}">
                                    <button class="btn block red">Delete</button>
                                </form> -->
            </div>
        </ul>








        {% endif %}



    </div>

</div>
<div class="timbre__infos">
    <p><strong>Etat:</strong> {{ etat.nom }}</p>
    <p><strong>Catégorie:</strong> {{ timbreCat.nom }}</p>
</div>

{% if session.privilege_id <= 3 %}
<div class="timbre_btn">
    <a href="{{base}}/timbre/edit?id={{timbre.id}}" class="btn block">Edit</a>
    <form action="{{base}}/timbre/delete" method="post">
        <input type="hidden" name="id" value="{{ timbre.id }}">
        <button class="btn block red">Delete</button>
    </form>
</div>
{% endif %}

{{ include('layouts/footer.php') }}