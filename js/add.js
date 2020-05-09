const title = document.querySelector(".judul");
const chartit = document.querySelector(".chartit");
const desc = document.querySelector(".deskripsi");
const chardesc = document.querySelector(".chardesc");

function inputing(subjek,objek,limit){
    subjek.addEventListener('keydown',() => {
        if(subjek.value.length < limit){
            objek.innerHTML = subjek.value.length;
        }else{
            subjek.value = subjek.value.substring(0,limit);
            objek.innerHTML = limit;
        }
    })
    subjek.addEventListener('keyup',() => {
        if(subjek.value.length < limit){
            objek.innerHTML = subjek.value.length;
        }else{
            subjek.value = subjek.value.substring(0,limit);
            objek.innerHTML = limit;
        }
    })
}

inputing(title,chartit,50);
inputing(desc,chardesc,300);

const harga = document.querySelector(".harga");
harga.addEventListener('keydown',(e) => {
    let key = e.code;
    let val = harga.value;
    if(key === "KeyE" || key === "Minus" || key === "Equal"){
        e.preventDefault();
        return false;
    }
})
harga.addEventListener('keyup',(e) => {
    let key = e.code;
    let val = harga.value;
    if(key === "KeyE" || key === "Minus" || key === "Equal"){
        e.preventDefault();
        return false;
    }
})
        
const pileh = document.querySelector(".pileh");
const preview = document.querySelector(".img-preview");

pileh.addEventListener('change',function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.addEventListener('load',function(){
            preview.setAttribute("src",this.result);
        })
        reader.readAsDataURL(file);
    }
})

const infoer = document.querySelector(".infoerr");
const errbox = document.querySelector(".err-info");
function allerr(){
    infoer.style.transform = "translateY(0)";
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

function errtit(){
    errbox.innerHTML = "FILL YOUR CONTENT PRODUCT";
}
function dataerr(){
    errbox.innerHTML = "COURSE = MP4 FILE<br>PRODUCT  = TXT FILE";
}
function nofile(){
    errbox.innerHTML = "CHOOSE FILE";
}

const bak = document.querySelector(".back-to");
bak.addEventListener('click',() => {
    document.location.href = "profile.php";
})