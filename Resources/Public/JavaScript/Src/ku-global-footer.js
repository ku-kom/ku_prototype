/* ========================================================================
 * Copyright 2022 Nanna Ellegaard
 * University of Copenhagen, FA Communications
 * ========================================================================*/

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const footerHeading = document.querySelectorAll('.footer-section-content .frame-header');

    if (!footerHeading) {
        /**
         * Break if element is not found
         */
        return;
    }

    const isMobile = () => {
        return window.matchMedia('(max-width: 767px)').matches;
    };

    /**
     * Set accessible attributes
     */
    const setAriaAttr = () => {
        footerHeading.forEach(el => {
            el.setAttribute('aria-expanded', isMobile() ? 'false' : 'true');
        });
    };

    /**
     * Reset styling
     */
    const resetFooter = () => {
        footerHeading.forEach(el => {
            el.nextElementSibling.style.removeProperty('height');
            el.nextElementSibling.classList.remove('active');
        });
    };


    const toggleFooter = () => {
        footerHeading.forEach(el => {
            el.addEventListener('click', (e) => {
                let that = e.currentTarget;
                let list = that.nextElementSibling;

                if (!list.classList.contains('active')) {
                    /**
                     * Slide down
                     */
                    list.classList.add('active');
                    list.style.height = 'auto';

                    let height = list.clientHeight + 'px';
                    list.style.height = '0';
                    setTimeout(() => {
                        list.style.height = height;
                    }, 0);
                    that.setAttribute('aria-expanded', 'true');

                } else {
                    /**
                     * Slide up
                     */
                    list.style.height = '0';
                    that.setAttribute('aria-expanded', 'false');

                    /**
                     * Remove the `active` class when the animation ends
                     */
                    list.addEventListener('transitionend', () => {
                        list.classList.remove('active');
                    }, {
                        once: true
                    });
                }
            });
        });
    }

    setAriaAttr();
    toggleFooter();

    ['orientationchange', 'resize'].forEach(debounce((e) => {
        window.addEventListener(e, resetFooter);
        window.addEventListener(e, setAriaAttr);
    }, 150));

});
