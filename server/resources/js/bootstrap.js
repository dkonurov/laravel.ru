/**
 * Babel kernel polyfill for full ES6 support
 */
import 'babel-polyfill';

/**
 * Knockout library
 */
import ko from 'knockout';
(global || window).ko = ko;


/**
 * Extended template engine
 */
import 'knockout.punches';
ko.punches.enableAll();

/**
 * Inview plugin
 */
import inview from "knockout-inview";
ko.bindingHandlers.inview = inview(ko);

/**
 * Validation support
 */
import 'knockout.validation/dist/knockout.validation';
import 'knockout.validation/localization/ru-RU';

ko.validation.configuration.errorMessageClass = "label error";
ko.validation.locale('ru-RU');


/**
 * Vendor libraries
 */
import router from './vendor/router';
window.router = router;

/**
 * Application styles
 */
import './../css/app.scss';

/**
 * Application kernel
 */
import Application from './Application';

/**
 * BOOTSTRAP
 */
(new Application())
    .ready(e => {
        document.body.classList.add('visible');
    });

