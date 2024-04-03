import Filtres from "./Filtres.js";

(function(){
//  let directory = getDirectory();
  //console.log(directory);

    const elFiltres = document.querySelector(".aside_menu");
    console.log(elFiltres);
    
    
    // Lancer les comportement sur les filtres de la page catalogue
    new Filtres(elFiltres);

})();



