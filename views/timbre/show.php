
{{ include('layouts/header.php', { titre: 'Timbre', css: 'styles' })}}

<main class="main-produit">
      <div class="page-produit">
        <div class="timbre">
          <div class="timbre-photo">
            <i class="fa-solid fa-chevron-left"></i>
            <div class="photo-produit-g">
              <img src="../assets/img/photos/{{ images }}" alt="{{ image.alt }}" /> <!-- {{ image.alt }} sera éventuellement ajouté -->
            </div>
            <i class="fa-solid fa-chevron-right"></i>
          </div>

          <div>
            <div class="icon-produit">
              <div class="jaime">
                J'aime
                <i class="fa-regular fa-heart"></i>
              </div>
              <div class="partager">
                Partager
                <i class="fa-regular fa-share-from-square"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="detail-produit">
          <div class="section-detail">
            <h3>{{ timbre.titre }}</h3>
            <p>
              {{ timbre.description }}
            </p>
            <div class="produit-quantite">
              <label for="quantity">Quantite</label>
              <input
                type="number"
                id="quantity"
                name="quantity"
                min="1"
                value="1"
              />
              <div class="prix">Prix de départ {{ timbre.prix_depart }}&nbsp;<small>$</small></div>
            </div>

            <div class="btn btn-produit">Ajouter au Panier</div>
          </div>
        </div>

        <div class="produits-similaires">
          <h3 class="h3-produits-simulaires">Produits Similaires</h3>
          <hr />
          <img src="../assets/img/photos/senna.webp" alt="timbre Senna" />
          <img src="../assets/img/photos/frevo.webp" alt="timbre Frevo" />
          <img src="../assets/img/photos/barao.webp" alt="timbre Barao de Mauá" />
          <img src="../assets/img/photos/Santos-Dumont.webp" alt="timbre Santos-Dumont" />
        </div>
      </div>
    </main>

    {{ include('layouts/footer.php') }}