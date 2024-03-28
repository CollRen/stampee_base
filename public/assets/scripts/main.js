(function(){

const valueAvant = document.querySelector("#value_avant");
const input = document.querySelector("#annee_maximum");
valueAvant.textContent = input.value;
input.addEventListener("input", (event) => {
  valueAvant.textContent = event.target.value;
});

const valueApres = document.querySelector("#value_apres");
const inputApres = document.querySelector("#annee_minimum");
valueApres.textContent = inputApres.value;
inputApres.addEventListener("input", (event) => {
  valueApres.textContent = event.target.value;
});

const prixMin = document.querySelector("#value_prix_min");
const inputPrixMin = document.querySelector("#prix_minimum");
prixMin.textContent = inputPrixMin.value;
inputPrixMin.addEventListener("input", (event) => {
  prixMin.textContent = event.target.value;
});

const prixMax = document.querySelector("#value_prix_max");
const inputPrixMax = document.querySelector("#prix_maximum");
prixMax.textContent = inputPrixMax.value;
inputPrixMax.addEventListener("input", (event) => {
  prixMax.textContent = event.target.value;
});

})();



