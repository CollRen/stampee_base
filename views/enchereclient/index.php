{{ include('layouts/header.php', { titre: 'Catalogue enchères', css: 'styles', js: 'main' })}}
<section class="flex-container" data-js-component="Router">
  <aside class="aside_menu">
    <h2>Filtres</h2>
    <form class="aside_menu__form">
      <h3>Prix</h3>
      <label for="prix_minimum">Minimum:<output id="value_prix_min"></output></label>
      <input id="prix_minimum" type="range" name="prix_minimum" min="0" max="1000" step="25" class="aside_menu__input_range" />

      <label for="prix_maximum">Maximum:<output id="value_prix_max"></output></label>
      <input id="prix_maximum" type="range" name="prix_maximum" min="0" max="1000" step="25" class="aside_menu__input_range" />

      <div class="aside_menu_input_annee">
        <h3>Années</h3>
        <label for="annee_minimum">Après <output id="value_apres"></output></label>
        <input id="annee_minimum" type="range" min="1850" max="2000" step="25" name="annee_minimum" class="aside_menu__input_range" />

        <label for="annee_maximum">Avant <output id="value_avant"></output></label>
        <input id="annee_maximum" type="range" min="1850" max="2000" step="25" name="annee_maximum" class="aside_menu__input_range" />

      </div>

      <div class="aside_menu_input_pays">
        <label for="pays">Pays</label>
        <select id="pays" name="pays" class="aside_menu_input_pays_select">
          <option value="Faite votre choix">Faite votre choix</option>
          {% for pays in payss %}
          <option value="{{ pays.id }}">{{ pays.nom }}</option>
          {% endfor %}
        </select>
      </div>

      <div>
        <div class="aside_menu_input_condition">
          <h3>Condition</h3>
          <div class="aside_menu_input_condition_option">

            {% for etat in etats %}
            <label for="etat_conservation">{{ etat.nom }}</label>
            <input id="etat_conservation_id={{ etat.id }}" type="checkbox" name="etat_conservation[]" value="{{ etat.id }}" />
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

    <div class="main-grid__tuile">
      <div>
        <img src="{{asset}}/img/timbres/catalogue_brasilFootbal.jpeg" alt="Brasil Footbal" />
        <h4>Stampee Senna</h4>
      </div>
      <a href="./produit.html" class="btn">Miser</a>
      <a href="./produit.html" class="btn">En savoir plus</a>
    </div>
    
    <div class="main-grid__tuile">
      <div>
        <img src="{{asset}}/img/timbres/catalogue_brasilFootbal.jpeg" alt="Brasil Footbal" />
        <h4>Stampee Senna</h4>
      </div>
      <a href="./produit.html" class="btn">Miser</a>
      <a href="./produit.html" class="btn">En savoir plus</a>
    </div>


    {% for timbre in timbres %}
    {% for enchere in encheres %}
    {% if enchere.timbre_id == timbre.id %}
    
    <div class="main-grid__tuile" data-js-encheres>

      <img src="{{asset}}{% for image in images %}{% if image.timbre_id == timbre.id %}{{image.adresse}}" alt="{{image.nom}}{% endif %}{% endfor %}" />
      <h4>{{timbre.titre}}</h4>

    <span>{{ enchere.date_limite }}</span>
    <span>
      <button class="btn" data-js-action="miser">Miser</button>
      <a href="{{ base }}/enchere/show?id={{ enchere.id }}" class="btn">Détails</a>
    </span>

    </div>

    {% endif %}
    {% endfor %}
    {% endfor %}


    <template data-js-template>
      <div class="detail__enchere" data-js-template-container>
        <div class="main-grid__tuile" data-js-encheres="{{id}}">

          <img src="{{asset}}{{image.adresse}}" alt="{{image.titre}}" />
          <h4>{{titre}}</h4>
        </div>
        <span>
        <a href="{{ base }}/mise/show?enchere_id={{ enchere.id }}" class="btn" data-js-action="miser">Miser</a>
        </span>
      </div>
    </template>


    </div>
    </div>
    </div>
  </main>

</section>
{{ include('layouts/footer.php') }}