/* ========================================================================
 * Copyright 2022
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

  function toggleFooter() {
    footerHeading.forEach(el => {
      el.addEventListener('click', (e) => {
        let that = e.currentTarget;
        let list = that.nextElementSibling;

        /**
         * Slide down
         */
        if (!list.classList.contains('active')) {
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

  window.addEventListener('resize', debounce(() => {
    resetFooter();
    setAriaAttr();
  }, 150));

  window.addEventListener('orientationchange', debounce(() => {
    resetFooter();
    setAriaAttr();
  }, 150));

});
/* eslint-disable no-redeclare */
/* ========================================================================
 * Copyright 2022
 * University of Copenhagen, FA Communications, Nanna Ellegaard.
 * ========================================================================*/

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

document.addEventListener('DOMContentLoaded', () => {

  hasScrollbar();

  window.addEventListener('orientationchange', debounce(function () {
    hasScrollbar();
  }, 250));

  window.addEventListener('resize', debounce(function () {
    hasScrollbar();
  }, 250));
});

/* ========================================================================
 * Copyright 2022
 * University of Copenhagen, FA Communications
 * ========================================================================*/

(function () {
  'use strict'

  window.addEventListener('DOMContentLoaded', function () {

    /**
     * Solution to set appropiate aria-axpanded states in menus.
     * 
     */

    function navbarPointerOver(element) {
      let toggle = document.querySelector('.navbar-toggler');
      if (window.getComputedStyle(toggle).display === 'none' && element.classList.contains('open') === false) {
        element.querySelector('.menu_arrow').setAttribute('aria-expanded', 'true');
      }
    }

    function navbarPointerLeave(element) {
      let toggle = document.querySelector('.navbar-toggler');
      if (window.getComputedStyle(toggle).display === 'none') {
        element.querySelector('.menu_arrow').setAttribute('aria-expanded', 'false');
      }
    }

    // Array.from(document.querySelectorAll('li.has-children')).forEach(function (element) {
    //   element.addEventListener('pointerover', (e) => {
    //     if (e.pointerType === "mouse") {
    //       navbarPointerOver(element);
    //     }
    //   });
    //   element.addEventListener('mouseenter', () => {
    //     if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
    //       navbarPointerOver(element);
    //     }
    //   });
    //   element.addEventListener('pointerleave', (e) => {
    //     if (e.pointerType === "mouse") {
    //       navbarPointerLeave(element);
    //     }
    //   });
    //   element.addEventListener('mouseleave', () => {
    //     if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
    //       navbarPointerLeave(element);
    //     }
    //   });
    // });

    // Array.from(document.querySelectorAll('.menubar li')).forEach(function (element) {
    //   element.addEventListener('click', (e) => {
    //     let listElement = element.parentElement;
    //     if (listElement.classList.contains('has-children')) {
    //       let listElementSiblings = listElement.parentElement.querySelectorAll('.menu_arrow');
    //       Array.from(listElementSiblings).forEach(function (listElementsSibling) {
    //         listElementsSibling.setAttribute('aria-expanded', 'false')
    //       });
    //       listElement.setAttribute('aria-expanded', 'true')
    //       listElement.querySelector('.menu_arrow').setAttribute('aria-expanded', 'true');
    //       e.stopImmediatePropagation();
    //       e.preventDefault();
    //       return false;
    //     }
    //   });
    // });

    // Toggle aria states for hamburger icon
    document.getElementById('navbarSideCollapse').addEventListener('click', (e) => {
      const btn = e.currentTarget;
      btn.setAttribute('aria-expanded', btn.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
    });

  });

})()

/* ========================================================================
 * Copyright 2022
 * University of Copenhagen, FA Communications
 * ========================================================================*/

(function () {
  'use strict'

  document.querySelector('#navbarSideCollapse').addEventListener('click', function () {
    document.querySelector('.navbar-toggler').classList.toggle('open');
    document.querySelector('.offcanvas-collapse').classList.toggle('open');
  })
})()
