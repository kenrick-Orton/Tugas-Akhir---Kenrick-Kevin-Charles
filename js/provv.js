const profileImg = document.querySelector(".profile-img");

window.addEventListener("resize",() => {
    profileImg.style.height = profileImg.clientWidth+"px";
})
profileImg.style.height = profileImg.clientWidth+"px";



const cbtn = document.querySelectorAll(".custom-btn button");
const tot = document.querySelectorAll(".tot");
cbtn.forEach((asu,asiap) => {
    asu.addEventListener('click',() => {
        cbtn.forEach((asu,asiap) => {
            asu.classList.remove("cbtn");
            tot[asiap].classList.remove("act-tot");
        })
        asu.classList.add("cbtn");
        tot[asiap].classList.add("act-tot");
    })
})