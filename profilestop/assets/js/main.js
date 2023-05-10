const wrapper = document.querySelector('.wrapper');
const girisLink = document.querySelector('.giris-link');
const kayitLink = document.querySelector('.kayit-link');
const btnPopup = document.querySelector('.giris-popup');
const ikon = document.querySelector('.kapama');

kayitLink.addEventListener('click', ()=>{
    wrapper.classList.add('active');
});
girisLink.addEventListener('click', ()=>{
    wrapper.classList.remove('active');
});
btnPopup.addEventListener('click', ()=>{
    wrapper.classList.add('active-popup');
});
ikon.addEventListener('click', ()=>{
    wrapper.classList.remove('active-popup');
});