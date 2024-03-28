import { classesMapping } from "./classMapping.js";
import Filtres from "./Filtres.js";


(function(){
    let elComponents = document.querySelectorAll("[data-js-component]");
/*     this._elTaches = document.querySelectorAll('[data-js-encheres]'); */

// Lancer les comportement sur les filtres
let filtres = new Filtres;

for (let i = 0, l = elComponents.length; i < l; i++) {
    let datasetComponent = elComponents[i].dataset.jsComponent,
      elComponent = elComponents[i];

    for (let key in classesMapping) {
      if (datasetComponent == key)
        new classesMapping[datasetComponent](elComponent);
    }
  }

})();



