// al hacer click en un elemento a añadir la clase active

var links = document.querySelectorAll('a');
for (var i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function(e) {
        e.preventDefault();
        var active = document.querySelector('.active');
        active.classList.remove('active');
        this.classList.add('active');
    });
    }
