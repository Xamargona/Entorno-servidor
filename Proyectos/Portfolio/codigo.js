// Convertimos todos los navItems en buttons

let btns = document.querySelectorAll(".navItem");

btns.forEach(function(btn) {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("seccion1").style.visibility = "visible";
    });
})