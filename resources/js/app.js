import './bootstrap';

//Home JS
import './home/main.js';
import './home/bootstrap-5.0.0-beta2.min.js';
import './home/glightbox.min.js';
import './home/tiny-slider.js';
import './home/wow.min.js';
import './home/polyfill.js';


//Dashboard JS
import './dashboard/main.js';
import './dashboard/modernizr.js';
import './dashboard/persianumber.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
