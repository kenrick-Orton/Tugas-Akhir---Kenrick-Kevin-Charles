const hide = document.querySelectorAll(".hide");
const pw = document.querySelectorAll(".pw");

hide.forEach((hid,each) => {
    hide[each].addEventListener('click',() => {
        hide[each].classList.toggle("euy");
        if(!hide[each].classList.contains("euy")) pw[each].setAttribute("type","password");
        if(hide[each].classList.contains("euy")) pw[each].setAttribute("type","");
    })
})

const span = document.querySelectorAll(".inner span");

function invUser(){
    span[0].style.transform = "translateY(35px)";
    span[0].innerHTML = "USERNAME IS USED";
}

function invEmail(){
    span[1].style.transform = "translateY(35px)";
    span[1].innerHTML = "E-MAIL IS USED";
}

function invPhone(){
    span[2].style.transform = "translateY(35px)";
    span[2].innerHTML = "PHONE IS USED";
}

function same(){
    span[3].style.transform = "translateY(35px)";
    span[4].style.transform = "translateY(35px)";
    span[3].innerHTML = "CONFIRM PASSWORD AGAIN";
    span[4].innerHTML = "CONFIRM PASSWORD AGAIN";
}

function less(){
    span[3].style.transform = "translateY(35px)";
    span[4].style.transform = "translateY(35px)";
    span[3].innerHTML = "PASSWORD MUST MORE THEN 8 CHARACTER";
    span[4].innerHTML = "PASSWORD MUST MORE THEN 8 CHARACTER";
}

function phoneNum(){
    span[2].style.transform = "translateY(35px)";
    span[2].innerHTML = "PHONE NUMBER ISN'T VALID";
}

function succedd(){
    document.querySelector(".sc").style.transform = "translateY(0)";
}