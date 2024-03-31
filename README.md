# Projet web 1

## Rencontre avec prof.

- Filtrer le edit pour empêcher le validateur de valider son propre champs


## Page catalogue (enchereclient/index)

### Affichage

1. base = page PHP
2. JS pour écouter les événements
    - Miser
    - Lier avec BD avec un Router.js ? À réfléchir
    
3. Btn "En savoir plus" {{ timbre.lien }}
4. image: { asset } { timbre.image_pricipale}
    - Faudra new Image

### Pagination

1. À suivre...


### Filtres

1. Prix
    - Range

2. Année
    - Range

3. Pays
    - Select

4. Condition
    - Checkbox
    - fonction PHP noddle in array

5. Authentifié
    - Radio oui = value="1"
    - Radio Non = value="0"


## Attention

Les labels n'ont pas de nom, à vérifier!
Ajuster toutes les entrées de dates

- Peut-être en ajoutant: annee ****, jour **, mois **, heure **, minute **

Puis en gérant ces données en PHP


2. membre edit timbre n'a pas l'option de mettre authetifié
3. admin edit user
    - vérif formulaire
    - faire $validator
    - renvoyer vers le show de ce user
    - Ajouter un btn de rtr vers la liste des users

## SQL

1. À ajouter
    - enchere:
        - date_debut
        - est_coup_coeur_lord

    - timbre
        - tirage
        - couler(s)
        - dimensions




## Intéressant

1. Le session.user_name est intéressant peut-être éventuellement pour l'espace membre en haut à droite

```php 
        {% if guest is empty %}
        <h3 class="mot_bienvenu">Bienvenue {{ session.user_name }},</h3>
        {% endif %}


```

### Sprint 2
[X] Invité Filte timbres
[X] Invité Créer compte
[X] Membre édite timbre

Membre Mise
[X] Membre ajout enchère


[X] Limiter la vue des enchères à cet utilisateur

Faire la page Coup de coeur du Lord


[X] Membre modif enchère
[X] Membre suppr enchère

Pas nécessaire(

Gestionnaire Ajout privilèges
Gestionnaire Édite privilèges
Gestionnaire Ajout utilisateurs
Gestionnaire Ajout État timbre
Gestionnaire Édite État timbre
Gestionnaire État timbre
Gestionnaire Suppr enchères
Gestionnaire Édite les enchères membres
Gestionnaire Suppr les enchères membres
Gestionnaire Ajout les enchères membres
Gestionnaire Ajout enchères

)

> Prioritaire

> Créer sous menu enchere: coup de coeur, mes encheres, enchère favorie et créer une enchère


1. Coup de coeur Lord
    1. Ajouter dans diagram entité ( Est déjà dans la bd)
2. Enchère favorie (
    - Nettoie la fonction mesencheres dans enchereController
    - Part de là pour faire l'affichage des Enchères Favories


    - addToFavorie (Simplement un btn qui lance la fonction et affiche la page de nouveau)
        - enchere_id
        - user_id
        - est_favorie
)

3. Mise
    - createMise
        - enchere_id
        - user_id
        - prix_offert double
4. Pouvoir ajouter une image lors de la création de timbre





### Sprint 3

1. Encheres
 - Garder en mémoire les filtres lors du submit
 - Membre ajout enchère à ses favories
 - Enlever l'option de créer une enchère pour un timbre qui en a déjà (enchere a timbre_id -> user_id)
 - Ajouter un ti bouton dans create: 'Débute maintenant', sinon, formulaire date_debut
 - Définir cette phrase du devis:
 > Membre devrait avoir accès à des informations pertinentes sur son profil d’acheteur et
son historique d’offres.

- Section "Profil du membre"
    - Les offres en cours et leur état
        - Menu: Offre en cours

- Fonctionnalité de zoomer à l'intérieur des timbres
- Naviguation à deux niveau
    - Pouvoir naviguer facilement sur les (2) pages les plus importantes (enchères et offres)

- Base de données
    - Timbre
        -> *couleur(s) (Select) Je ne le ferai pas
        -> tirage (double)

        -> dimensions (en mm) 
            - largeur int
            - longueur int

2. Contenu de la page d'accueil

3. Style de la page catalogue

