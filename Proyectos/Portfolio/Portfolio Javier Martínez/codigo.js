var link1 = document.querySelector('a:nth-child(1)');
var link2 = document.querySelector('a:nth-child(2)');
var link3 = document.querySelector('a:nth-child(3)');

var section1 = document.querySelector('section:nth-child(2)');
var section2 = document.querySelector('section:nth-child(3)');
var section3 = document.querySelector('section:nth-child(4)');

    link1.addEventListener('click', function(e) {
        e.preventDefault();
        var active = document.querySelector('.active');
        active.classList.remove('active');
        this.classList.add('active');
    
        var sectionActive = document.querySelector('.activesection');
        sectionActive.classList.remove('activesection');
        section1.classList.add('activesection');
    });

    link2.addEventListener('click', function(e) {
        e.preventDefault();
        var active = document.querySelector('.active');
        active.classList.remove('active');
        this.classList.add('active');
    
        var sectionActive = document.querySelector('.activesection');
        sectionActive.classList.remove('activesection');
        section2.classList.add('activesection');
    }
    );

    link3.addEventListener('click', function(e) {
        e.preventDefault();
        var active = document.querySelector('.active');
        active.classList.remove('active');
        this.classList.add('active');
    
        var sectionActive = document.querySelector('.activesection');
        sectionActive.classList.remove('activesection');
        section3.classList.add('activesection');
    }
    );