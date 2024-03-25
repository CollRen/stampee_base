<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
      name="description"
      content="Bienvenue sur Lord Stampee - Votre destination exclusive pour les enchères de timbres rares."
    />
    <meta name="author" content="René de Montigny" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="icon"
      href="./assets/img/logos/Stampee_logo_pale_header.svg"
      type="image/x-icon"
      alt="logo Stampee"
    />
    <!-- Pour production -->
    <!-- <link rel="stylesheet" href="build/css/stylesfinaux.css"> -->
<!--     <link rel="stylesheet" href="{{ asset }}/css/styles.css" /> -->
{% if session.privilege_id == 1 %}
<link rel="stylesheet" href="{{ asset_admin }}/css/{{ css }}.css" />
{% else %}
<link rel="stylesheet" href="{{ asset }}/css/{{ css }}.css" />
{% endif %}
    <title>{{ titre }}</title>
    <!-- <link rel="stylesheet" href="{{ asset }}/css/style.css">-->
    <!-- <link rel="stylesheet" href="{{ asset }}/css/main.css">  -->
</head>


<body>
    <nav>
        <ul>
            <!-- Menu admin -->
            {% if session.privilege_id == 1 %}
            <li><a href="{{base}}/timbre">Liste de timbre</a></li>
            <li><a href="{{base}}/etat">Etats</a></li>
            <li><a href="{{base}}/categorie">Catégorie</a></li>
            <li><a href="{{base}}/user/create">Users</a></li>
            {% endif %}


            <!-- Menu membre -->
            {% if session.privilege_id == 2 %}
            <li><a href="{{base}}/timbre">Ma liste de timbre</a></li>
            <li><a href="{{base}}/enchere">Enchères</a></li>
            <li><a href="{{base}}/timrehasenchere">Mes enchères</a></li>
            {% endif %}

            <!-- menu guest  -->
            {% if guest %}
            <li><a href="{{base}}/timbre">Liste de timbre</a></li>
            <li class="connexion connexion__not-connected"><a href="{{base}}/login">Login</a></li>
            {% else %}
            <li class="connexion connexion__connected"><a href="{{base}}/logout">Logout</a></li>
            {% endif %}
        </ul>
    </nav>


        {% if guest is empty %}
        <h3 class="mot_bienvenu">Bienvenue {{ session.user_name }},</h3>
        {% endif %}