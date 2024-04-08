export default class Mobile {
  #_el;
  #_headerNav;
  #_menuNavShow;

  constructor(_el) {
    this.#_el = _el;
    this.#_headerNav = document.querySelector(".header-nav");
    this.#_menuNavShow = this.#_el.querySelector(".header-nav_mobil--show-nav");

    this.init();
  }

  init() {
    this.#_el.addEventListener(
      "click",
      function (e) {
        this.#_headerNav.classList.toggle("header-nav_mobil--show");
      }.bind(this)
    );
  }
}
