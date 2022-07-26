const btn_close = document.querySelector ('#close')
const cont_cookies = document.querySelector('.cookies-boox')

const acep=document.querySelector('#acep');

const show = documen.querySelector('#mostrarpo');
const mod = document.querySelector('.modal');

const close_mod = document.querySelector('#close_modal');
const ac = document.querySelector('#acept_cookie');

(function comprobarCookies() {
    if(localStorage.cookie1 == 'true') {
        cont_cookies.style.bottom = '-200px'
    }
})()



function aceptarCookies() {
    localStorage.cookie1 = 'true'
    cont_cookies.style.bottom = '-200px'

    let expire = new Date()
    expire = new Date(expire.getTime() + 69120000)
    document.cookie1 = 'cookie1=aceptada; expire'+expire

}


acep.addEventListener('click', () => {
    aceptarCookies(); 
} )



btn_close.addEventListener('click', () => {
    cont_cookies.style.bottom = '-200px'} )




show.addEventListener('click', () =>{
    mod.style.visibility = 'visible'
    mod.style.opacity = '1'

})    

close_mod.addEventListener('click', () =>{
    mod.style.visibility = 'hidden'
    mod.style.opacity = '0'

})    

ac.addEventListener('click', () =>{
   aceptarCookies();
   mod.style.visibility = 'hidden'
    mod.style.opacity = '0'

})    

