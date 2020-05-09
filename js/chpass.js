const span  = document.querySelector(".inner span");
function less(){
    span.style.transform = "translateY(35px)";
    span.innerHTML = "PASSWORD MUST MORE THEN 8 CHARACTER";
}

const hide = document.querySelector(".hide");
const pw = document.querySelector(".pw");

hide.addEventListener('click',() => {
    hide.classList.toggle("oh");
    if(hide.classList.contains("oh")) pw.setAttribute('type','text');
    if(!hide.classList.contains("oh")) pw.setAttribute('type','password');
})