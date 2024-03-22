
    export class Navigation {

        constructor(_el) {
            this._elNav = _el;

            this.init();
        }


        init() {
            this._elNav.addEventListener('click', function(e) {
                console.log(e);
            }.bind(this))
        }
    }