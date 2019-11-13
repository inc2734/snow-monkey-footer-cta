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

  const onCloseBtnClick = (event) => {
    document.removeEventListener('scroll', onScroll, false);
    setAriaHidden(wrapper, 'true');
    document.body.style['marginBottom'] = '';
    setHiddenCookie();
  };

  const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', onCloseBtnClick, false);
  }

  const observe = () => {
    const observerCallback = (entries) => {
      let boundingClientRectY = 0;
      entries.forEach(
        (entry) => {
          const oldAriaHidden = wrapper.getAttribute('aria-hidden');
          if (entry.rootBounds.height <= entry.boundingClientRect.y) {
            if ('true' !== oldAriaHidden) {
              wrapper.setAttribute('aria-hidden', 'true');
              addCustomEvent(wrapper, 'initFooterStickyNav');
            }
          } else {
            if ('false' !== oldAriaHidden) {
              wrapper.setAttribute('aria-hidden', 'false');
              addCustomEvent(wrapper, 'initFooterStickyNav');
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
    observer.observe(delayPoint);
  };

  const delayPoint = document.getElementById('footer-cta-delay');
  if (delayPoint && 'undefined' !== typeof IntersectionObserver) {
    observe();
  }
};

document.addEventListener( 'DOMContentLoaded', onDOMContentLoaded, false);
