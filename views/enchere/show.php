{{ include('layouts/header.php', { titre: 'Show', css: 'styles' })}}

<main class="main-index">
    <div class="container">
        <h2>enchere Show</h2>
        <hr>
        <p><strong>Enchere id</strong> {{ enchere.id }}</p>
        <p><strong>Date début</strong> {{ enchere.date_debut }}</p>
        <p><strong>Date limite</strong> {{ enchere.date_limite }}</p>

        <a href="{{base}}/enchere/edit?id={{enchere.id}}" class="btn block">Edit</a>
        <form action="{{base}}/enchere/delete" method="post">
            <input type="hidden" name="id" value="{{ enchere.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

</main>

<main class="main-produit">
    <div class="page-produit">
        <div class="timbre">
            <div class="timbre-photo">
                <i class="fa-solid fa-chevron-left"></i>
                <div class="photo-produit-g">
                    <img src="{{asset}}{% for image in images %}{% if image.timbre_id == timbre.id %}{{image.adresse}}" alt="{{image.nom}}{% endif %}{% endfor %}" />
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </div>

            <div>
                <div class="icon-produit">
                    <div class="jaime" data-js-favorie={{ enchere.id }}>
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
                {% for timbre in timbres %}
                {% if timbre.id == enchere.timbre_id %}
                <h3>{{ timbre.titre }}</h3>
                <p>
                {{ timbre.description }}
                </p>
                {% for mise in mises %}
                <div class="misemax">{% if mise.enchere_id == enchere.id %}Prix </div>
            </div>
            
            <div class="btn btn-miser">Augmenter la mise</div>
            <label for="mise">Augmenter la mise</label>
            <input type="number" id="mise" name="mise" min="{{ mise.prix_offert }}" value="{{ mise.prix_offert }}{% endif %}"/> <!-- On peut mettre + 1 ? -->
        </div>
    </div>
    {% endfor %}
    {% endif %}
    {% endfor %}

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