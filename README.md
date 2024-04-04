# Projet web 1

## Questions pour Mamadou

1. mise/create prix 3 on peut pas miser 4.25.


## Priorités

1. 

- Menu enchère, le premier item est plus haut que les autres?
- step des mises ça bloque

- Accueil: les trois picto en millieu:
    1. Acheter => Consulter les enchères actives
    2. Évaluation => Consulter les archives
    3. Votre liste de timbre

- Contenu de la page d'accueil
    - Afficher les Coups de coeur Lord (menu + Accueil)
- Ajouter une enchère aux favories
- Afficher 'mes préférées'

4. 
- Landing: filtres sont comme désactivés et affiche tous les résultats
- Empêcher de créer une enchère pour un timbre déjà mis aux enchère
- Bloquer le delete d'un timbre s'il y a une enchère dessus -> avec ti-message
- timbre/showconnected.php plus beau-> À partir du enchere/show serait plus beau

- Mettre le prix sur la tuile dans catalogue
- Ajuster les entrées de dates (tuile catalogue, année seulement dans timbre/show et create si possible)

- Empêcher de mettre un min plus bas que le max sélectionné et vice versa

* Enchère archivées est fonctionnelle, mais pas si on filtre ensuite... oh peut-être ajouter un filtre 'enchères archivé' hidden et qui est à ON lorsqu'on arrvivé... puis qui le reste ensuite. Mais pourquoi hidden alors ?
Donc, ajouter ce filtre, et l'activé automatiquement si on y arrive via le menu.
    



## Tests

- Vérifier qu'un mise est la plus haute avant de l'ajouter à la bd
- Membre edit timbre ajouter l'option de mettre authetifié

- admin edit user
    - vérif formulaire
    - faire $validator
    - renvoyer vers le show de ce user
    - Ajouter un btn de rtr vers la liste des users

## SQL

1. À ajouter


## Intéressant


```php 
    // Le session.user_name est intéressant peut-être éventuellement pour l'espace membre en haut à droite
        {% if guest is empty %}
        <h3 class="mot_bienvenu">Bienvenue {{ session.user_name }},</h3>
        {% endif %}
```

### Sprint 2

- 'Créer une enchère' ne devrait pas exister -> mais placé dans la liste de timbre

> Liste de timbre, colonne: Mettre en enchère || Voir l'enchère

[X] Invité Filte timbres
[X] Invité Créer compte
[X] Membre édite timbre

Membre Mise
[X] Membre ajout enchère


[X] Limiter la vue des enchères à cet utilisateur

Faire la page Coup de coeur du Lord


[X] Membre modif enchère
[X] Membre suppr enchère Ne devrait pas être possible

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

### Sprint 3

1. Encheres
    - Pouvoir commenter les enchères, archivées ou pas pourrait nous intéresser.
    - Garder en mémoire les filtres lors du submit
    - Membre ajout enchère à ses favories
    - Enlever l'option de créer une enchère pour un timbre qui en a déjà (enchere a timbre_id -> user_id)
    - Ajouter un ti bouton dans create: 'Débute maintenant', sinon, formulaire date_debut



2.  Membre devrait avoir accès à des informations pertinentes sur son profil d’acheteur et
son historique d’offres
- Faire un journal
    - Ses offres
    - Enchère gagnées ou perdu


- Section "Profil du membre"
    - Les offres en cours et leur état ('Offre en cours' dans le menu)

- Pouvoir naviguer facilement sur les (2) pages les plus importantes (enchères et offres)








