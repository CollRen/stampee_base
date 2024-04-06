{{ include('layouts/header.php', { titre: 'Show', css: 'styles', js: 'main' })}}

<main class="main-produit" data-js-component="Router">
    <div class="page-produit">
        <div class="timbre">
            <div class="timbre-photo">
                <i class="fa-solid fa-chevron-left"></i>
                <div class="photo-produit-g">
                    <!-- <img src="{{asset}}/img/timbres/catalogue_Brazil-CA-DP3_2-253x300.webp" alt="" /> -->

                    <img src="{{asset}}{{ images.adresse }}" alt="{{image.nom}}" />
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

                <h3>{{ timbre.titre }}</h3>
                <h4>État de conservation</h4>
                <p>{{ etat }}</p>
                
                <p>
                    Description - {{ timbre.description }}
                </p>
                
                <p>Mise aux enchères # {{ enchere.id }}</p>
                <div class="misemax">Prix:&nbsp;{% if mise.enchere_id == enchere.id and mise.prix_offert > timbre.prix_depart %}{{ mise.prix_offert }}{% else %}{{ timbre.prix_depart }}{% endif %}<small>&nbsp;$</small></div>

                <a href="{{base}}/mise/create?enchere_id={{ enchere.id }}" class="btn btn-miser">Augmenter la mise
                </a>
            </div>
        </div>

</main>
{% if timbre.user_id == thisuser or thisuser == 1 %}
<aside class="main-index">
    <div class="container">
        <h2>Modifier cet enchère</h2>
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

</aside>
{% endif %}
{{ include('layouts/footer.php') }}