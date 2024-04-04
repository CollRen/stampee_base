import App from "./App.js";
import { appelFetchApp } from "./App3.js";
class EnchereFavorie {
  _elTemplateEnchere;
  _elDetails;
  constructor() {
    this.user_id = user_id;
    console.log(user_id);
    // Variable en rapport l'ajout d'une enchère aux favories d'un membre
    // this._elDetails = document.querySelectorAll("[data-js-template-container]");
    this.addToFavorie = this.addToFavorie.bind(this);
    this.objFavorie = {};
    this.oOptions = {
      method: "POST",
      headers: { "Content-type": "application/json" },
    };
  }

  /**
   * Récupère en asynchrone les encheres
   * @param {String} id
   */
  addToFavorie(id) {
    
    this.objFavorie = {
      action: "storefavorie",
      enchere_id: id,
      user_id: this.user_id,
      est_favorie: 1
    };
    console.log(this.objFavorie);
    this.oOptions.body = JSON.stringify(this.objFavorie);
    this.appelFetch();
  }

    
/*     appelFetch() {
      //console.log('oui');
    //fetch("{{ BASE }}controllers/EnchereFavorieController.php", oOptions)
    fetch(
      "http://localhost:8000/h24/stampee_base/stampeeFromRecette/enchere/storefavorie",
      this.oOptions
    )
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
  } */

  ajouteTache() {
    this.objFavorie = {
      tache: this._elInputTache.value,
      description: this._elInputDescription.value,
      importance: this._el.querySelector('input[name="importance"]:checked')
        .value,
      action: "ajouteTache",
    };
    this.oOptions.body = JSON.stringify(this.objFavorie);
    this.appelFetch();
  }

  appelFetch() {
    
    appelFetchApp("http://localhost:8000/h24/stampee_base/stampeeFromRecette/enchere/storefavorie", this.oOptions)
      .then(
        function (data) {
          console.log(data);
          if (data != "Erreur query string") {

            let datas = JSON.parse(this.oOptions.body);
            datas.id = data;
/*             this._el.reset();
            this.injecteTaches(datas); */
          }
        }.bind(this)
      )
      .catch(function (erreur) {
        console.log(erreur.message);
      });
  }
}
export const { addToFavorie } = new EnchereFavorie();
