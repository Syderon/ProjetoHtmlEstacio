window.addEventListener("scroll", function(){
    let body = document.querySelector('#teste')
    teste.classList.toggle('rolagem',window.scrollY > 1)
})