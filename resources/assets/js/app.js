try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.appView = require('./views/app');
window.homeView = require('./views/home');
window.demoView = require('./views/demo');
