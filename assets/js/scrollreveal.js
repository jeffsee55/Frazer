// JavaScript
window.sr = ScrollReveal();
sr.reveal('.reveal-right', {
    origin: 'right',
    distance: '150px',
    duration: 1500,
    rotate: { x: 0, y: 0, z: 60 },
});

sr.reveal('.reveal-center', {
    origin: 'bottom',
    distance: '0px',
    duration: 1200,
});

sr.reveal('.reveal-bottom', {
    origin: 'bottom',
    distance: '50px',
    duration: 1500,
}, 75);
