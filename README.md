# Projet web 1


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





