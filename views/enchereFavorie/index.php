{{ include('layouts/header.php', { titre: 'enchere', css: 'styles' })}}
<main class="main-index">
    <h1>Enchères</h1>
    {% for enchereFavorie in enchereFavories %}

    {% if enchereFavorie.user_id ==  %}
                
            
    <table>
        <thead>
            <tr>
                <th>Id de l'utilisateur</th>
                <th># du timbre</th>
                <th>Date début</th>
                <th>Date limite</th>
                <th>Prix de départ</th>
                <th>Montant de l'enchère la plus élevé</th>


            </tr>
        </thead>
        <tbody>

        <!-- On veut afficher ici les enchères favorie pour un seul utilisateur -->


        <!-- 
            1- Faire un filtre pour l'affichage s'il n'y a pas de favorie
            2- On voudra pouvoir faire un delete directement sur cette page
            3- La table devrait contenir
    
    -->



        

            <tr>
                <td><a href="{{ base }}/enchere/show?user_id={{ enchereFavorie.user_id }}enchere_id={{ enchereFavorie.enchere_id }}">{{ enchereFavorie.user_id }}</a></td>
                <td>{{ enchereFavorie.timbre_id }}</td>
                <td>>{{ enchereFavorie.date_debut }}</td>
                <td>>{{ enchereFavorie.date_limite }}</td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    
    {% endif %}
    <a href="{{ base }}/enchere/create" class="btn" >enchere Create</a>

    </main>
{{ include('layouts/footer.php') }}