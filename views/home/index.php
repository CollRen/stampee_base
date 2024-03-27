{{ include('layouts/header.php', { titre: 'Accueil', css: 'styles' })}}
<main class="main-index">
<hero class="index-hero">
        <div class="index-hero__carroussel">
          <div class="index-hero-photo">
            <i class="fa-solid fa-chevron-left"></i>
            <div class="index-hero-photo-g">
              <img
                class="hero-photo"
                src="{{ asset }}/img/timbres/timbreCA.webp"
                loading="lazy"
                alt="image du timbre aux enchères de derniere minute"
              />
            </div>
            <i class="fa-solid fa-chevron-right"></i>
          </div>

          <div class="encheres-jour_vedettes">
            <div class="vedette-p">
              <img
                class="vedette-photo"
                src="{{ asset }}/img/timbres/timbre1.webp"
                loading="lazy"
                alt="image du timbre aux enchères du jour"
              />
            </div>
            <div class="vedette-p">
              <img
                class="vedette-photo"
                src="{{ asset }}/img/timbres/timbre2.webp"
                loading="lazy"
                alt="image du timbre aux enchères du jour"
              />
            </div>
            <div class="vedette-p">
              <img
                class="vedette-photo"
                src="{{ asset }}/img/timbres/timbre3.webp"
                loading="lazy"
                alt="image du timbre aux enchères du jour"
              />
            </div>
          </div>
        </div>

        <div class="encheres-jour">
          <div class="enchere_description vedette">
            <h1>Les enchères de dernière minute</h1>
            <p class="enchere_description_titre">Canada 2022</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
            <p>
              <span class="enchere_description_detail">Prix actuel : </span>
              5497.00$
            </p>
            <p>
              <span class="enchere_description_detail">Temps restant: </span>
              3j 5h02min ⌛
            </p>

            <div class="enchere_description_btns">
              <button class="btn">Miser</button>
              <button class="btn">Info +</button>
            </div>
          </div>
        </div>
      </hero>

      <section class="index-services">
        <div class="index-services_icones">
          <img
            src="{{ asset }}/img/icons/collection.svg"
            class="index-services_svg"
            alt="image d'illustration du service de vente"
          />
          <h2>Achetez dès maintenant</h2>
        </div>
        <div class="index-services_icones">
          <img
            src="{{ asset }}/img/icons/evaluation.svg"
            class="index-services_svg"
            alt="image d'illustration du service de evaluation de timbres"
          />
          <h2>Faites une évaluation</h2>
        </div>
        <div class="index-services_icones">
          <img
            src="{{ asset }}/img/icons/worldstamp.svg"
            class="index-services_svg"
            alt="image d'illustration pour la page commencez votre collection"
          />
          <h2>Commencez une collection</h2>
        </div>
      </section>

      <section class="index-encheres">
        <div class="index-encheres_gallerie">
          <h2>Les coups de coeur</h2>

          <div class="index-encheres_gallerie__photos">
            <div class="timbre-index-photo">
              <div class="photo-index-produit">
                <h3>Hiver Canadien</h3>
                <img
                  src="{{ asset }}/img/timbres/timbre1.webp"
                  alt="timbre Hiver Canadien"
                />
                <p>Prix actuel: 1988.02$</p>
                <p>Temps restant: 2j 1h28min ⌛</p>
                <div class="enchere_description_btns">
                  <button class="btn">Miser</button>
                  <button class="btn">Info +</button>
                </div>
              </div>
            </div>
            <div class="timbre-index-photo">
              <div class="photo-index-produit">
                <h3>Automne Canada</h3>
                <img
                  src="{{ asset }}/img/timbres/timbre3.webp"
                  alt="timbre Automne Canad "
                />
                <p>Prix actuel: 1788.10$</p>
                <p>Temps restant: 2h39min ⌛</p>
                <div class="enchere_description_btns">
                  <button class="btn">Miser</button>
                  <button class="btn">Info +</button>
                </div>
              </div>
            </div>
            <div class="timbre-index-photo">
              <div class="photo-index-produit">
                <h3>Love Canada</h3>
                <img
                  src="{{ asset }}/img/timbres/timbre2.webp"
                  alt="timbre Love Canada"
                />
                <p>Prix actuel: 1500.99$</p>
                <p>Temps restant: 4h55min ⌛</p>
                <div class="enchere_description_btns">
                  <button class="btn">Miser</button>
                  <button class="btn">Info +</button>
                </div>
              </div>
            </div>
            <div class="timbre-index-photo">
              <div class="photo-index-produit">
                <h3>Les Animaux</h3>
                <img
                  src="{{ asset }}/img/timbres/timbre6.webp"
                  alt="timbre Les Animaux"
                />
                <p>Prix actuel: 5497.00$</p>
                <p>Temps restant: 3j 5h02min ⌛</p>
                <div class="enchere_description_btns">
                  <button class="btn">Miser</button>
                  <button class="btn">Info +</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="nouvelles">
        <h2>Actualités</h2>
        {% for actualite in actualites %}
        <div class="nouvelle-p">
          <p>
          {{ actualite.date }} - {{ actualite.text }}
          </p>
        </div>

        {% endfor %}
       
      </section>
    </main>



</main>
{{ include('layouts/footer.php') }}