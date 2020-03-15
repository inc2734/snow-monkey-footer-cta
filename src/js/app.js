'use strict';

import addCustomEvent from '@inc2734/add-custom-event';
import Cookies from 'js-cookie';

const onDOMContentLoaded = () => {
  const wrapper = document.getElementById('footer-sticky-nav');
  if (! wrapper) {
    return;
  }

  const setHiddenCookie = () => {
    const getPath = () => {
      if (typeof snow_monkey.home_url === 'undefined') {
        return '';
      }
      const dummy = document.createElement('a');
      dummy.href  = snow_monkey.home_url;
      const pathname = dummy.pathname + '/';
      return pathname.replace('//', '/');
    };

    Cookies.set(
      'snow-monkey-footer-cta-hidden',
      1,
      {
        expires: 1,
        path: getPath(),
      }
    );
  };

  const show = () => {
    wrapper.setAttribute('aria-hidden', 'false');
    addCustomEvent(wrapper, 'initFooterStickyNav');
  };

  const hide = () => {
    wrapper.setAttribute('aria-hidden', 'true');
    addCustomEvent(wrapper, 'initFooterStickyNav');
  };

  if ('undefined' !== typeof IntersectionObserver) {
    const observerCallback = (entries) => {
      let boundingClientRectY = 0;
      entries.forEach(
        (entry) => {
          const oldAriaHidden = wrapper.getAttribute('aria-hidden');
          if (entry.rootBounds.height <= entry.boundingClientRect.y) {
            if ('true' !== oldAriaHidden) {
              hide();
            }
          } else {
            if ('false' !== oldAriaHidden) {
              show();
            }
          }
        }
      );
    };

    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: [0, 1],
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);

    const delayPoint = document.getElementById('footer-cta-delay');
    if (!! delayPoint) {
      observer.observe(delayPoint);
    }
  } else {
    show();
  }

  const onCloseBtnClick = (event) => {
    wrapper.setAttribute('aria-hidden', 'true');
    document.body.style['marginBottom'] = '';
    setHiddenCookie();

    if ('undefined' !== typeof observer) {
      observer.unobserve(delayPoint);
    }
  };

  const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', onCloseBtnClick, false);
  }
};

document.addEventListener( 'DOMContentLoaded', onDOMContentLoaded, false);
