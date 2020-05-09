const profileImg = document.querySelector(".profile-img");

window.addEventListener("resize",() => {
    profileImg.style.height = profileImg.clientWidth+"px";
})
profileImg.style.height = profileImg.clientWidth+"px";


const foto = document.querySelector(".foto");
const imgBox = document.querySelector(".trobos");
const exit = document.querySelector(".exit-btn");
imgBox.addEventListener("click",() => {
    foto.classList.add("act-foto");
})

exit.addEventListener("click",() => {
    foto.classList.remove("act-foto");
})

const img = document.querySelector(".kotak-pilih img");
const ch = document.querySelector(".kotak-pilih input");
ch.addEventListener('change',function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.addEventListener("load",function(){
            img.setAttribute("src",this.result);
        })
        reader.readAsDataURL(file);
    }else{
        img.setAttribute("src","");
    }
})

const errbox = document.querySelector(".errbox");
function allerr(){
    foto.classList.add("act-foto");
}

function errsize(){
    errbox.innerHTML = "SIZE MUST LESS THEN 2MB";
}

function noimg(){
    errbox.innerHTML = "CHOOSE IMAGE";
}

function exerr(){
    errbox.innerHTML = "EXTENSION MUST JPG,PNG,JPEG";
}

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