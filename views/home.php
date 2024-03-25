{{ include('layouts/header.php', { titre: 'Create', css: 'styles' })}}

    <h1>{{ var }}</h1>

    <section>
            <a href="{{base}}/timbre">Timbre</a>
            <a href="{{base}}/etat">Etats</a>
            <a href="{{base}}/enchere">Ingrédients</a>
    </section>

    <div>
        <img src="../public/assets/images/imageMvc_etats-copie.jpg" alt="">
    </div>

    {{ include('layouts/footer.php') }}