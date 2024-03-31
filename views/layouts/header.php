<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Bienvenue sur Lord Stampee - Votre destination exclusive pour les enchères de timbres rares." />
  <meta name="author" content="René de Montigny" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="{{ asset }}/img/logos/Stampee_logo_pale_header.svg" type="image/x-icon" alt="logo Stampee" />
  <script type="module" src="{{ asset }}/scripts/{{ js }}.js" defer></script>
  <!-- Pour production -->
  <!-- <link rel="stylesheet" href="build/css/stylesfinaux.css"> -->
  <!--     <link rel="stylesheet" href="{{ asset }}/css/styles.css" /> -->
  {% if session.privilege_id == 1 %}
  <!-- <link rel="stylesheet" href="{{ asset_admin }}/css/{{ css }}.css" /> -->
  <link rel="stylesheet" href="{{ asset }}/css/{{ css }}.css" />
  {% else %}
  <link rel="stylesheet" href="{{ asset }}/css/{{ css }}.css" />
  {% endif %}
  <title>{{ titre }}</title>
  <!-- <link rel="stylesheet" href="{{ asset }}/css/style.css">-->
  <!-- <link rel="stylesheet" href="{{ asset }}/css/main.css">  -->
</head>

<body class="body-index">
  <header class="header-top">

    <div class="header-top__superieur">
      <div class="header-top__logo">
        <a href="{{ base }}/home"><img src="{{ asset }}/img/logos/Stampee_logo_titre.png" alt="logo Stampee" class="header-top_img" alt="logo Stampee" />
        </a>
      </div>

      <div class="barre-recherche">
        <input type="text" class="barre-recherche__champ" placeholder="Recherchez le timbre souhaité" />
        <i class="fa-solid fa-magnifying-glass icon_img1" alt="icon recherche"></i>
      </div>
      <i class="fa-solid fa-bars" alt="icon menu portable"></i>

      <div class="header-top_icons">
        <a href="./">

          <i class="fa-solid fa-house icon_img1" role="img" aria-label="icon page d'accueil"></i></a>
        <a href="{% if session.privilege_id == 2 %}{{ base }}/user/show?id={{ users.id }}{% else %}{{ base }}/user/create{% endif %}">
          <i class="fa-solid fa-user icon_img1" role="img" aria-label="icon inscription ou connexion"></i></a>
        <i class="fa-solid fa-cart-shopping icon_img1" role="img" aria-label="icon inscription ou connexion"></i>
      </div>
    </div>
    <nav class="header-nav navbar"> <!-- Pas navbar qui change grand chose -->

      <ul>
        
        {% if session.privilege_id is defined %}


        <!-- Menu admin -->
        {% if session.privilege_id == 1 %}
        <li><a href="{{base}}/timbre">Liste de timbre</a></li>
        <!--         <li><a href="{{base}}/etat">Etats</a></li>
        <li><a href="{{base}}/categorie">Catégorie</a></li> -->
        <li><a href="{{base}}/user">Users</a></li>
        <li><a href="{{base}}/privilege">Privilège</a></li>
        <li><a href="{{base}}/enchere">Enchères</a></li>
        <li><a href="{{base}}/enchereFavorie">Enchères favorie</a></li>
        <li><a href="{{base}}/actualite">Actualités</a></li>
        {% endif %}


        <!-- Menu membre -->
        {% if session.privilege_id == 2 %}
        <div class="subnav">
          <li><button class="subnavbtn">Enchères&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
        </button>
        
        <ul class="subnav-content">
          <li><a href="{{base}}/enchere">Consulter</a></li>
          <li><a href="{{base}}/enchere/create">Créer</a></li>
          <li><a href="{{base}}/enchere/mesencheres">Ma liste</a></li>
          <li><a href="{{base}}/enchere/mesencheresfavorites">Mes préférées</a></li>
        </ul>
        
      </li>
      
    </div>
    <li><a href="{{base}}/timbre">Ma liste de timbre</a></li>
        {% endif %}
        {% endif %}

        <li><a href="{{base}}/coupcoeurlord">Coup de coeur du Lord</a></li>
        <!-- menu guest  -->
        {% if guest %}
        <li><a href="{{base}}/enchere">Enchères</a></li>
        <li class="connexion connexion__not-connected"><a href="{{base}}/user/create">Créer votre compte</a></li>
        <li class="connexion connexion__not-connected"><a href="{{base}}/login">Login</a></li>
        {% else %}
        <li class="connexion connexion__connected"><a href="{{base}}/logout">Logout</a></li>
        {% endif %}
        
      </ul>
    </nav>
  </header>