// Initialize map function
function initMap() {
    // Sample coordinates (replace with actual data)
    var center = { lat: 0, lng: 0 };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: center
    });
    // Sample marker (replace with markers for rescue agencies)
    var marker = new google.maps.Marker({
        position: center,
        map: map,
        title: 'Rescue Agency'
    });
}

// Add event listener to dynamically update active navigation link
document.addEventListener('DOMContentLoaded', function () {
    var links = document.querySelectorAll('nav ul li a');
    links.forEach(function (link) {
        link.addEventListener('click', function () {
            links.forEach(function (l) {
                l.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});