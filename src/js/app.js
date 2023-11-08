import addCustomEvent from '@inc2734/add-custom-event';
import Cookies from 'js-cookie';

const onDOMContentLoaded = () => {
  const wrapper = document.getElementById('footer-sticky-nav');
  if (! wrapper) {
    return;
  }

  const scrollTop = () => {
    return document.documentElement.scrollTop || document.body.scrollTop;
  };

  const throttle = (callback, delay) => {
    let time = Date.now();
    return (...args) => {
      if ((time + delay - Date.now()) < 0) {
        callback.apply(this, args);
        time = Date.now();
      }
    };
  };

  let ariaHidden = wrapper.getAttribute('aria-hidden');

  const show = () => {
    ariaHidden = 'false';
    wrapper.setAttribute('aria-hidden', ariaHidden);
    addCustomEvent(wrapper, 'initFooterStickyNav');
  };

  const hide = () => {
    ariaHidden = 'true';
    wrapper.setAttribute('aria-hidden', ariaHidden);
    addCustomEvent(wrapper, 'initFooterStickyNav');
  };

  const handleScroll = throttle(
    () => {
      if (snow_monkey_footer_cta.delay <= scrollTop()) {
        if ('false' !== ariaHidden) {
          show();
        }
      } else {
        if ('true' !== ariaHidden) {
          hide();
        }
      }
    },
    150
  );

  window.addEventListener('scroll', handleScroll, false);

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
    wrapper.parentNode.removeChild(wrapper);
    document.body.style['marginBottom'] = '';
    setHiddenCookie();
    window.removeEventListener('scroll', handleScroll, false);
  };

  const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', onCloseBtnClick, false);
  }
};

document.addEventListener( 'DOMContentLoaded', onDOMContentLoaded, false);
