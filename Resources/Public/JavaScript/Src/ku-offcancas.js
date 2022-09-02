/* ========================================================================
 * Copyright 2022
 * University of Copenhagen, FA Communications
 * ========================================================================*/

document.addEventListener('DOMContentLoaded', () => {
    'use strict'

    document.querySelector('#navbarSideCollapse').addEventListener('click', function () {
        document.querySelector('.navbar-toggler').classList.toggle('open');
        document.querySelector('.offcanvas-collapse').classList.toggle('open');
    })
});
