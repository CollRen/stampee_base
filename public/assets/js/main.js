const nav = document.querySelector('nav');

nav.addEventListener("click", function(){
    const isOpen = nav.dataset.opened === "true"
    
    nav.dataset.opened = !isOpen; 
})