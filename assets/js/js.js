let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');
let item = document.querySelector('.item');
let employe = document.querySelector('.userentry');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}
window.onscroll = () => {

    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    if (window.scrollY > 0) {
        document.querySelector('.header').classList.add('active');
    } else {
        document.querySelector('.header').classList.remove('active');
    };

};

//on veut hide le formulaire des enregistrement pour le voitures et employés:
item.classList.add('hidden');
employe.classList.add('hidden');

//on veut faire apparaitre les formulaires des voitures et des employés starts:
//show product form
document.querySelector('#publieritem').onclick = () => {
    item.classList.remove('hidden');
}

//show employé form:
document.querySelector('#publieruser').onclick = () => {
    employe.classList.remove('hidden');
}