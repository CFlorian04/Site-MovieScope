// sidebar submenu open close js code
let htmlcssArrow = document.querySelector(".htmlcss-arrow");
htmlcssArrow.onclick = function() {
    navLinks.classList.toggle("show1");
}
let moreArrow = document.querySelector(".more-arrow");
moreArrow.onclick = function() {
    navLinks.classList.toggle("show2");
}
let jsArrow = document.querySelector(".js-arrow");
jsArrow.onclick = function() {
    navLinks.classList.toggle("show3");
}
function Menu_film() {
    document.getElementById("table_film").setAttribute("style","display:block");
    document.getElementById("table_artiste").setAttribute("style","display:none");
    document.getElementById("table_genre").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}
function Menu_artiste() {
    document.getElementById("table_artiste").setAttribute("style","display:block");
    document.getElementById("table_film").setAttribute("style","display:none");
    document.getElementById("table_genre").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}
function Menu_genre() {
    document.getElementById("table_genre").setAttribute("style","display:block");
    document.getElementById("table_film").setAttribute("style","display:none");
    document.getElementById("table_artiste").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}
function Menu_internaute() {
    document.getElementById("table_internautes").setAttribute("style", "display:block");
    document.getElementById("table_film").setAttribute("style", "display:none");
    document.getElementById("table_artiste").setAttribute("style", "display:none");
    document.getElementById("table_genre").setAttribute("style", "display:none");
}