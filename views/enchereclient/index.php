{{ include('layouts/header.php', { titre: 'Catalogue enchères', css: 'styles', js: 'mainfiltre' })}}
<section class="flex-container" data-js-component="Router">
  <aside class="aside_menu">
    <h2>Filtres</h2>
    <form class="aside_menu__form">
      <h3>Prix</h3>
      <label for="prix_minimum">Minimum:<output id="value_prix_min"></output></label>
      <input id="prix_minimum" type="range" name="prix_minimum" min="0" max="1000" step="25" class="aside_menu__input_range" value="{% if filtres.prix_minimum is defined %}{{ filtres.prix_minimum }}{% else %}0{% endif %}" />






      <label for="prix_maximum">Maximum:<output id="value_prix_max"></output></label>
      <input id="prix_maximum" type="range" name="prix_maximum" min="0" max="1000" step="25" class="aside_menu__input_range" value="{% if filtres.prix_maximum is defined %}{{ filtres.prix_maximum }}{% else %}1000{% endif %}" />

      <div class="aside_menu_input_annee">
        <h3>Années</h3>
        <label for="annee_minimum">Après <output id="value_apres"></output></label>
        <input id="annee_minimum" type="range" min="1850" max="2000" step="25" name="annee_minimum" class="aside_menu__input_range" value="{% if filtres.annee_minimum is defined %}{{ filtres.annee_minimum }}{% else %}1850{% endif %}" />

        <label for="annee_maximum">Avant <output id="value_avant"></output></label>
        <input id="annee_maximum" type="range" min="1850" max="2025" step="25" name="annee_maximum" class="aside_menu__input_range" value="{% if filtres.annee_maximum is defined %}{{ filtres.annee_maximum }}{% else %}2025{% endif %}" />

      </div>

      <div class="aside_menu_input_pays">
        <label for="pays">Pays</label>
        <select id="pays" name="pays" class="aside_menu_input_pays_select">
          <option value="Faite votre choix">Faite votre choix</option>
          {% for pays in payss %}
          <option value="{{ pays.id }}" {% if filtres.pays is defined %}{% if filtres.pays == pays.id %} selected {% endif %}{% endif %}>{{ pays.nom }}</option>
          {% endfor %}
        </select>
      </div>

      <div>
        <div class="aside_menu_input_coup_coeur_lord">
          <h3>Coup de coeur Lord</h3>
          <div class="aside_menu_input_coup_coeur_lord">



            <label for="est_coup_coeur_lord">Cocher pour ne voir que ses coups de coeurs</label>
            <input id="est_coup_coeur_lord" type="checkbox" name="est_coup_coeur_lord" value="true"{% if filtres.est_coup_coeur_lord is defined %}
            checked
            {% endif %}/>

          </div>


        </div>
        <div class="aside_menu_input_condition">
          <h3>Condition</h3>
          <div class="aside_menu_input_condition_option">

            {% for etat in etats %}

            <label for="etat_conservation">{{ etat.nom }}</label>
            <input id="etat_conservation_id={{ etat.id }}" type="checkbox" name="etat_conservation[]" value="{{ etat.id }}" {% if etats_conservation is defined %} {% for etat_c in etats_conservation %} {% if etat_c == etat.id %} checked {% endif %} {% endfor %} {% endif %} />
            {% endfor %}
          </div>


        </div>
      </div>
      </div>

      <div class="aside_menu_input_autentication">
        <p><abbr title="Copie officielle">Authentifié&nbsp;?</abbr></p>

        <div class="aside_menu_input_autentication_options">
          <label for="authentifie">Oui</label>
          <input type="radio" name="authentifie" value="1" />

          <label for="authentifie">Non</label>
          <input type="radio" name="authentifie" value="0" />

          <label for="authentifie">Oui ou non</label>
          <input type="radio" name="authentifie" value="2" />
        </div>
      </div>

      <button type="submit" class="btn">Soumettre</button>
    </form>
  </aside>

  <main class="main-grid" data-js-main>

    {% if message is defined %}

  <h2>{{ message }}</h2>
  <a href="{{base}}/">Retour à l'accueil</a>
    {% else %}

    {% for timbre in timbres %}
    {% for enchere in encheres %}
    {% if enchere.timbre_id == timbre.id %}

    <div class="main-grid__tuile" data-js-encheres>

      <img src="{{asset}}{% for image in images %}{% if image.timbre_id == timbre.id %}{{image.adresse}}" alt="{{image.nom}}{% endif %}{% endfor %}" />
      <h4>{{timbre.titre}}</h4>

      <span>Date limite: {{ enchere.date_limite }}</span>

      <!-- <a href="href="{{base}}/mise/create?enchere_id={{ enchere.id }}" class="btn btn-miser">Miser</a> -->
      <a href="{{ base }}/enchere/show?id={{ enchere.id }}" class="btn">Détails</a>
    </div>
    {% endif %}
    {% endfor %}
    {% endfor %}
    {% endif %}
    </div>
    </div>
  </main>

</section>
{{ include('layouts/footer.php') }}