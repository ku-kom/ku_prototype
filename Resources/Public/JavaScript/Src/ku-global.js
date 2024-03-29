/* eslint-disable no-redeclare */
/* ========================================================================
 * Copyright 2022
 * University of Copenhagen, FA Communications, Nanna Ellegaard.
 * ========================================================================*/

/**
 * Check OS reduced motion setting
 */
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

/**
 * Delay function init, e.g. on resizing or orientation change. Returns a function, that, as long as it continues to be invoked, will not be triggered. The function will be called after it stops being called for N milliseconds.
 * Usage: debounce(myFunction, 250)
 * @param {function to be passed in} func 
 * @param {debounce time in ms} wait 
 * @param {If `immediate` is passed, trigger the function on the leading edge, instead of the trailing} immediate 
 * @returns a function
 */
const debounce = (func, wait, immediate) => {
    let timeout;
    return function () {
        let context = this,
            args = arguments;
        let later = () => {
            timeout = null;
            if (!immediate)
                func.apply(context, args);
        };
        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow)
            func.apply(context, args);
    };
}

/**
 * A debounce is utilized when you only care about the final state. For example, waiting until a user stops typing to fetch typeahead search results. A throttle is best used when you want to handle all intermediate states but at a  controlled rate. For example, track the screen width as a user resizes the window and rearrange page content while it changes instead of waiting until the user has finished.
 * @param {function to be passed in} func 
 * @param {throttle time} wait 
 * @returns a function
 */
const throttle = (func, wait) => {
    let waiting = false;
    return function () {
        if (!waiting) {
            func.apply(this, arguments);
            waiting = true;
            setTimeout(function () {
                waiting = false;
            }, wait);
        }
    };
}

/**
 * Check if page has scrollbar and if so add css variable. Used for full width styling.
 */
const hasScrollbar = () => {
    let body = document.body;
    if (body) {
        if (window.innerWidth > body.clientWidth) {
            body.classList.add('has-scrollbar');
            body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
        } else {
            body.classList.remove('has-scrollbar');
        }
    }
}

// document.addEventListener('DOMContentLoaded', () => {

//   hasScrollbar();

//   window.addEventListener('orientationchange', debounce(function () {
//     hasScrollbar();
//   }, 250));

//   window.addEventListener('resize', debounce(function () {
//     hasScrollbar();
//   }, 250));
// });

/**
 * Link to open acoordion
 */

window.addEventListener('DOMContentLoaded', () => {
    'use strict';

    /**
     * Link to open accordion
     */
    const slideToOpenAccordion = () => {
        /**
         * Return if Bootstrap collapse is not present
         */
        if (typeof bootstrap.Collapse !== 'function') {
            return;
        }

        /**
         * Check for accessibility settings
         */
        if (reduceMotion.matches) {
            return;
        }
        if (window.location.hash !== '') {
            // Open accordions or collapsible elements based on the hash in the url
            let accordionExists = window.location.hash.indexOf('accordion-') >= 0 || window.location.hash.indexOf('collapse-') >= 0;
            if (accordionExists) {
                const accordionID = window.location.hash; // Variable includes hash (#).
                // Open accordion if it exists
                const collapsibleElement = document.querySelector(accordionID);
                if (collapsibleElement) {
                    new bootstrap.Collapse(collapsibleElement).show();
                    // Scroll to accordion
                    document.querySelector(accordionID).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        }
    }

    // slideToOpenAccordion();

    // window.addEventListener('orientationchange', debounce(function () {
    //     slideToOpenAccordion();
    // }, 150));

    // window.addEventListener('resize', debounce(function () {
    //     slideToOpenAccordion();
    // }, 150));
});
