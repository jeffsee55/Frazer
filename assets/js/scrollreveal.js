// JavaScript
window.sr = ScrollReveal();
sr.reveal('.reveal-right.reveal-rotate', {
    origin: 'right',
    viewFactor: 0.8,
    distance: '60px',
    duration: 1500,
    rotate: { x: 0, y: 0, z: 20 },
    mobile: false
});

sr.reveal('.reveal-right', {
    origin: 'right',
    viewFactor: 0.8,
    distance: '40px',
    duration: 1500,
    mobile: false
});

sr.reveal('.reveal-left.reveal-rotate', {
    origin: 'left',
    viewFactor: 0.8,
    distance: '60px',
    duration: 1500,
    rotate: { x: 0, y: 0, z: -20 },
    mobile: false
});

sr.reveal('.reveal-left', {
    origin: 'left',
    viewFactor: 0.8,
    distance: '50px',
    duration: 1500,
    mobile: false
});

sr.reveal('.reveal-center', {
    origin: 'bottom',
    viewFactor: 0.5,
    distance: '0px',
    duration: 1200,
});

sr.reveal('.reveal-bottom', {
    origin: 'bottom',
    viewFactor: 0.5,
    distance: '50px',
    duration: 1500,
    delay: 200,
}, 100);
