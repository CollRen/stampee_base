<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    <link rel="stylesheet" href="{{ asset }}/css/main.css">
</head>

<body>
    <nav>
        <ul>
            <!-- Menu admin -->
            {% if session.privilege_id == 1 %}
            <li><a href="{{base}}/timbre">Liste de timbre</a></li>
            <li><a href="{{base}}/etat">Etats</a></li>
            <li><a href="{{base}}/enchere">Ingrédients</a></li>
            <li><a href="{{base}}/categorie">Catégorie</a></li>
            <li><a href="{{base}}/enchereCat">Catégorie d'ingrédients</a></li>
            <li><a href="{{base}}/pays">Unité de mesure</a></li>
            <li><a href="{{base}}/user/create">Users</a></li>
            <li><a href="{{base}}/journal">Journal de connexion</a></li>
            {% endif %}

            <!-- menu manager  -->
            {% if session.privilege_id == 2 %}
            <li><a href="{{base}}/etat">Etats</a></li>
            <li><a href="{{base}}/enchere">Ingrédients</a></li>
            <li><a href="{{base}}/categorie">Catégorie</a></li>
            <li><a href="{{base}}/enchereCat">Catégorie d'ingrédients</a></li>
            <li><a href="{{base}}/pays">Unité de mesure</a></li>
            {% endif %}

            <!-- Menu etat -->
            {% if session.privilege_id == 3 %}
            <li><a href="{{base}}/timbre">Liste de timbre</a></li>
            <li><a href="{{base}}/enchere">Ingrédients</a></li>
            {% endif %}

            <!-- menu guest  -->
            {% if guest or session.privilege_id == 4 %}
            <li><a href="{{base}}/timbre">Liste de timbre</a></li>
            <li class="connexion connexion__not-connected"><a href="{{base}}/login">Login</a></li>
            <li><a href="{{base}}/journal">Journal de connexion</a></li>
            {% else %}
            <li class="connexion connexion__connected"><a href="{{base}}/logout">Logout</a></li>
            {% endif %}
        </ul>
    </nav>
    <main>


        {% if guest is empty %}
        Bienvenue {{ session.user_name }},
        {% endif %}