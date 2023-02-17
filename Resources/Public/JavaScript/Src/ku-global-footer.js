/* ========================================================================
 * Copyright 2022 Nanna Ellegaard
 * University of Copenhagen, FA Communications
 * ========================================================================*/

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    /**
     * Return if Bootstrap collapse is not present
     */
    if (typeof bootstrap.Collapse !== 'function') {
        return;
    }

    /**
     * Media query
     */
    const isMobile = () => {
        return window.matchMedia('(max-width: 767px)').matches;
    };

    /**
     * Collapse on mobile
     */
    const collapseFooter = () => {
        if (isMobile) {
            const collapseElementList = document.querySelectorAll('.footer-section-content .collapse');
            console.log(collapseElementList);
            const collapseList = [...collapseElementList].map(collapseEl => new bootstrap.Collapse(collapseEl));
        }
    };

    collapseFooter();

    ['orientationchange', 'resize'].forEach(debounce((e) => {
        window.addEventListener(e, collapseFooter);
    }, 150));

});
