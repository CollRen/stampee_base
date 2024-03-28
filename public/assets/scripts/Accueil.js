class Accueil {
    #_elMain;

    constructor() {
        this.#_elMain = document.querySelector('[data-js-main]');
        this.accueil = this.accueil.bind(this);
    }


    /**
     * Contenu de la page d'acceuil
     */
    accueil() {
        this.#_elMain.innerHTML = '';
    }
} 

export const { accueil } = new Accueil();