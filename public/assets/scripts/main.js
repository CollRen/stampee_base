import { classesMapping } from "./classMapping.js";
import Filtres from "./Filtres.js";
import Mobile from "./Mobile.js";


(function(){

  const nav = document.querySelector('.header-nav');
  let elComponents = document.querySelectorAll("[data-js-component]");
  const elFiltres = document.querySelector(".aside_menu");
  const elMenuMobile = document.querySelector(".fa-solid_mobil");

  new Mobile(elMenuMobile);



  // Lancer les comportement sur les filtres de la page catalogue
  new Filtres(elFiltres);

/**
 * Lancement des comportement pour l'ajout d'enchère favorie favories
 */
for (let i = 0, l = elComponents.length; i < l; i++) {
    let datasetComponent = elComponents[i].dataset.jsComponent,
      elComponent = elComponents[i];

    for (let key in classesMapping) {
      if (datasetComponent == key)
        new classesMapping[datasetComponent](elComponent);
    }
  }

})();



