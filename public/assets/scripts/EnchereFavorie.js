import App from "./App.js";
class EnchereFavorie {
  _elTemplateEnchere;
  _elDetails;
  constructor() {
    // Variable en rapport l'ajout d'une enchère aux favories d'un membre
    // this._elDetails = document.querySelectorAll("[data-js-template-container]");
    this.addToFavorie = this.addToFavorie.bind(this);
  }

  /**
   * Récupère en asynchrone les encheres
   * @param {String} id
   */
  addToFavorie(id) {
    let data = {
      action: "storefavorie",
      id: id,
    };
    let oOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    };


    //fetch("{{ BASE }}controllers/EnchereFavorieController.php", oOptions)
    fetch("http://localhost:8000/h24/stampee_base/stampeeFromRecette/enchere/storefavorie", oOptions)
      .then(function (reponse) {
        if (reponse.ok) return reponse.json();
        else throw new Error("La réponse n'est pas OK");
      })
      .then(
        function (data) {

          if (data && data != "Erreur query string") {
            
            this.injecteDetail(data);
          } else {
            console.log("Erreur query string");
          }
        }.bind(this)
      )
      .catch(function (erreur) {

        console.log(
          `Il y a eu un problème avec l'opération fetch: ${erreur.message}`
        );
      });
  }
}
export const { addToFavorie } = new EnchereFavorie();
