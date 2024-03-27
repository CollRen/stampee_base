const nav = document.querySelector('nav');

console.log('test');
nav.addEventListener("click", function(){
    const isOpen = nav.dataset.opened === "true"
    
    nav.dataset.opened = !isOpen; 
})