/*import { classesMapping } from "./classMapping.js";
import Filtres from "./Filtres.js";


(function(){
    let elComponents = document.querySelectorAll("[data-js-component]");
    const elFiltres = document.querySelector(".aside_menu");
    
/*     this._elEncheres = document.querySelectorAll('[data-js-encheres]'); */

// Lancer les comportement sur les filtres de la page catalogue

/*
new Filtres(elFiltres);


for (let i = 0, l = elComponents.length; i < l; i++) {
    let datasetComponent = elComponents[i].dataset.jsComponent,
      elComponent = elComponents[i];

    for (let key in classesMapping) {
      if (datasetComponent == key)
        new classesMapping[datasetComponent](elComponent);
    }
  }

})();



