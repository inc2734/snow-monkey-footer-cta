'use strict';

import Cookies from 'js-cookie';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const body = document.getElementById('body');
    const wrapper = document.getElementById('footer-sticky-nav');

    if (! wrapper) {
      return;
    }

    const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');

    closeBtn.addEventListener(
      'click',
      (event) => {
        wrapper.setAttribute('aria-hidden', 'true');
        body.style['marginBottom'] = '';

        Cookies.set(
          'snow-monkey-footer-cta-hidden',
          1,
          {
            expires: 1,
            path: '/',
          }
        );
      },
      false
    );
  },
  false
);
