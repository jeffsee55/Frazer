// JavaScript
window.sr = ScrollReveal();
sr.reveal('.reveal-right.reveal-rotate', {
    origin: 'right',
    viewFactor: 0.8,
    distance: '60px',
    mobile: false,
    duration: 1500,
    rotate: { x: 0, y: 0, z: 20 },
});

sr.reveal('.reveal-right', {
    origin: 'right',
    viewFactor: 0.8,
    distance: '40px',
    mobile: false,
    duration: 1500,
});

sr.reveal('.reveal-left.reveal-rotate', {
    origin: 'left',
    viewFactor: 0.8,
    distance: '60px',
    mobile: false,
    duration: 1500,
    rotate: { x: 0, y: 0, z: -20 },
});

sr.reveal('.reveal-left', {
    origin: 'left',
    viewFactor: 0.8,
    distance: '50px',
    mobile: false,
    duration: 1500,
});

sr.reveal('.reveal-center', {
    origin: 'bottom',
    viewFactor: 0.5,
    distance: '0px',
    mobile: false,
    duration: 1200,
});

sr.reveal('.reveal-bottom', {
    origin: 'bottom',
    viewFactor: 0.5,
    distance: '50px',
    mobile: false,
    duration: 1500,
}, 75);
