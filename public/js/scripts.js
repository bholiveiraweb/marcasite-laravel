var btnToggle = document.getElementById('menu-toggle');

if (btnToggle) {
    btnToggle.addEventListener('click', function (event) {
        event.preventDefault();
        var wrapper = document.getElementById('wrapper');
        wrapper.classList.toggle("toggled");
    });
}