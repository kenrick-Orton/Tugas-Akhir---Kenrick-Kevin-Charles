const span = document.querySelectorAll(".inner span");

function invUser(){
    span[0].style.transform = "translateY(35px)";
    span[0].innerHTML = "USERNAME MUST LESS THAN 50";
}

function invEmail(){
    span[1].style.transform = "translateY(35px)";
    span[1].innerHTML = "E-MAIL MUST LESS THAN 50";
}

function invPhone(){
    span[2].style.transform = "translateY(35px)";
    span[2].innerHTML = "PHONE NUMBER HAS BEEN USED";
}

function sameUser(){
    span[0].style.transform = "translateY(35px)";
    span[0].innerHTML = "USERNAME HAS BEEN USED";
}

function sameEmail(){
    span[1].style.transform = "translateY(35px)";
    span[1].innerHTML = "E-MAIL HAS BEEN USED";
}

function phoneNum(){
    span[2].style.transform = "translateY(35px)";
    span[2].innerHTML = "PHONE NUMBER ISN'T VALID";
}

function succedd(){
    document.querySelector(".sc").style.transform = "translateY(0)";
}

const ta = document.querySelector(".inner textarea");
function puting(subjek,limit){
    subjek.addEventListener('keydown',() => {
        subjek.value = subjek.value.substring(0,limit);
    })
    subjek.addEventListener('keyup',() => {
        subjek.value = subjek.value.substring(0,limit);
    })
}

puting(ta,200);