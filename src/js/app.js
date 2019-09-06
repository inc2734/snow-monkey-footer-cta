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

  const setAriaHidden = (element, value) => {
    element.setAttribute('aria-hidden', value);
  };

  const init = () => {
    const beforeAriaHidden = wrapper.getAttribute('aria-hidden');
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const afterAriaHidden = snow_monkey_footer_cta.delay <= scrollTop ? 'false' : 'true';

    if (beforeAriaHidden !== afterAriaHidden) {
      setAriaHidden(wrapper, afterAriaHidden);
      addCustomEvent(wrapper, 'initFooterStickyNav');
    }
  };

  const onScroll = () => {
    init();
  };

  const onCloseBtnClick = (event) => {
    document.removeEventListener('scroll', onScroll, false);
    setAriaHidden(wrapper, 'true');
    document.body.style['marginBottom'] = '';
    setHiddenCookie();
  };

  init();
  document.addEventListener('scroll', onScroll, false);

  const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', onCloseBtnClick, false);
  }
};

document.addEventListener( 'DOMContentLoaded', onDOMContentLoaded, false);
