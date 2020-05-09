const body = document.querySelector("body");
const navBtn = document.querySelector(".nav");
const navSec = document.querySelector(".nav-section");
navBtn.addEventListener("click",() => {
    body.classList.toggle("body-pointer");
    navSec.classList.toggle("nsa");
    navSec.style.transform = "translate(0)";
    if(navSec.classList.contains("nsa")){
        navSec.style.transform = "translateY(0)";
        navSec.style.borderRadius = "0";
        navSec.style.width = "100vw";
    }else{
        navSec.style.transform = "translateY(-100%)";
        navSec.style.borderRadius = "0 0 500px 0";
        navSec.style.width = "0";
    }
})

const inHead = document.querySelector(".inside-header");
const kimo = document.querySelector(".kimochi");
window.addEventListener("scroll",() => {
    let y = window.scrollY;
    if(kimo === null) inHead.style.transform = "translateY("+(y/3)+"px)";
    if(inHead === null) kimo.style.transform = "translateY("+(y/3)+"px)";
})

const chk = document.querySelectorAll(".chk");
const navObj = document.querySelectorAll(".product-nav ul li");
chk.forEach(ch => {
    ch.addEventListener("click",() => {
        if(chk[4].checked === true){
            navObj[4].classList.add("act-product")
            chk[3].checked = false;
            chk[2].checked = false;
            chk[1].checked = false;
            chk[0].checked = false;
        }else{
            navObj[4].classList.remove("act-product")
        }
        if(chk[0].checked === true){
            navObj[0].classList.add("act-product")
        }else{
            navObj[0].classList.remove("act-product")
        }
        if(chk[1].checked === true){
            navObj[1].classList.add("act-product")
        }else{
            navObj[1].classList.remove("act-product")
        }
        if(chk[2].checked === true){
            navObj[2].classList.add("act-product")
        }else{
            navObj[2].classList.remove("act-product")
        }
        if(chk[3].checked === true){
            navObj[3].classList.add("act-product")
        }else{
            navObj[3].classList.remove("act-product")
        }
    })
})