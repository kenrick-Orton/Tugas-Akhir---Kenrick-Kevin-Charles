const hide = document.querySelector(".hide");
const pw = document.querySelector(".pw");

hide.addEventListener('click',() => {
    hide.classList.toggle("oh");
    if(hide.classList.contains("oh")) pw.setAttribute('type','text');
    if(!hide.classList.contains("oh")) pw.setAttribute('type','password');
})

const span = document.querySelectorAll(".inner span");
const input = document.querySelectorAll(".inner input");

function invalidUser(){
    span[0].style.transform = "translateY(40px)";
    span[0].innerHTML = "USERNAME ISN'T VALID";
}

function invalidPass(){
    span[1].style.transform = "translateY(40px)";
    span[1].innerHTML = "PASSWORD INS'T VALID";
}